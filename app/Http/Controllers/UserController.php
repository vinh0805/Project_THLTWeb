<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function authLogin()
    {
        if (Session::get('sUser')) {
            return redirect('me');
        } else {
            return redirect('login')->send();
        }
    }

    public function isAdmin()
    {
        $this->authLogin();
        $user = Session::get('sUser');
        if (isset($user->role)) {
            if ($user->role == 1)
                return 1;
        }
        return 0;
    }

    public function showProfile()
    {
        $this->authLogin();
        return view('users.screen14-profile')->with('user', Session::get('sUser'));
    }

    public function showUserInfo($userId)
    {
        $user = User::find($userId);
        if (isset($user)) {
            $postNumber = count(Post::where('user_id', '=', $user->id)->where('status', '=', '1')->get());
            $commentNumber = count(Comment::where('user_id', '=', $user->id)->get());
            return view('users.screen20-user-info')->with('user', $user)
                ->with('postNumber', $postNumber)->with('commentNumber', $commentNumber);
        } else return redirect('/');
    }

    public function createNewUser(Request $request)
    {
        $data = $request->all();
        $checkEmail = User::where('email', '=', $data['email'])->first();
        if (!isset($checkEmail)) {
            if (!isset($data['gender'])) {
                $data['gender'] = 1;
            }
            $user = new User([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => md5($data['password']),
                'gender' => $data['gender'],
                'role' => 0,
                'avatar' => 'defaultAvatar.png'
            ]);

            $user->save();
            Session::put('message', 'SIGN UP SUCCESSFULLY!');
            Session::put('sUser', $user);
            return redirect('/signup/success');
        } else {
            Session::put('message', 'THIS EMAIL IS USED BY ANOTHER USER!');
            return redirect('/signup');
        }
    }

    public function updateProfile(Request $request, $userId)
    {
        $this->authLogin();
        $user = $this->userRepository->find($userId);
        $data = $request->all();

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->gender = $data['gender'];
        $date = strtotime($data['datepicker']);
        $user->birthday = date('Y/m/d', $date);
        $user->address = $data['address'];

        $avatar = $request->file('avatar');
        if ($avatar) {
            $avatarName = $avatar->getClientOriginalName();
            $avatar->move('frontend/images/avatars', $avatarName);
            $data['avatar'] = $avatarName;
            $user->avatar = $data['avatar'];
        }

        $user->save();
        Session::put('sUser', $user);
        return redirect('me')->with('user', $user)
            ->with('message', 'UPDATE INFORMATION SUCCESSFULLY!');
    }

    public function changePassword()
    {
        $this->authLogin();
        return view('users.screen15-my-pass')->with('user', Session::get('sUser'));
    }

    public function updatePassword(Request $request, $userId)
    {
        $this->authLogin();
        $user = $this->userRepository->find($userId);
        if (isset($user)) {
            if (isset($user->password)) {
                if ($user->password == md5($request['password'])) {
                    $user->password = md5($request['new_password']);
                    $user->save();
                    Session::put('sUser', $user);
                    return redirect('me/password')->with('user', $user)
                        ->with('message', 'UPDATE PASSWORD SUCCESSFULLY!');
                }
            }
        }
        return redirect('me/password')
            ->with('message', 'CANNOT UPDATE PASSWORD!');
    }

    public function signupSuccess() {
        return view('users.signupSuccess');
    }
}

