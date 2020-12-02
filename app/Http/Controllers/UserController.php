<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
//use App\Models\Users;
//use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
//use Illuminate\Support\Facades\Mail;

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

    public function createNewUser(Request $request)
    {
        $data = $request->all();
        if (isset($data['gender'])) {
            $user = new Users([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => md5($data['password']),
                'gender' => $data['gender'],
                'role' => 0
            ]);
        } else {
            $user = new Users([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => md5($data['password']),
                'role' => 0
            ]);
        }

        $user->save();
        Session::put('message', 'Đăng ký thành công!');
        return redirect('login/');
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
        return redirect('me')->with('user', $user)->with('message', 'Cập nhật thông tin thành công!');
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
                    return redirect('me/password')->with('user', $user)->with('message', 'Cập nhật mật khẩu thành công!');
                }
            }
        }
        return redirect('me/password')->with('message', 'Cập nhật mật khẩu không thành công!');
    }

/*    public function showUserList()
    {
        $this->authLogin();
        if ($this->isAdmin()) {
            $allUser = $this->userRepository->getAll();
            return view('users.screen04-users')->with('user', Session::get('sUser'))->with('allUser', $allUser);
        } else return redirect('me');
    }

    public function editUser($userId)
    {
        $this->authLogin();
        if ($this->isAdmin()) {
            $editUser = $this->userRepository->find($userId);
            return view('users.screen05-add-edit-user')->with('editUser', $editUser)->with('user', Session::get('sUser'));
        } else return redirect('me');
    }

    public function updateUser(Request $request, $userId)
    {
        $this->authLogin();
        if ($this->isAdmin()) {
            $user = $this->userRepository->find($userId);
            $data = $request->all();

            $user->first_name = $data['first_name'];
            $user->last_name = $data['last_name'];
            $user->email = $data['email'];
            $user->gender = $data['gender'];
            $date = strtotime($data['datepicker']);
            $user->birthday = date('Y/m/d', $date);
            $user->address = $data['address'];

            $avatar = $request->file('avatar');
            if ($avatar) {
                $avatarName = $avatar->getClientOriginalName();
                $avatar->move('public/frontend/images/avatars', $avatarName);
                $data['avatar'] = $avatarName;
                $user->avatar = $data['avatar'];
            }
            $user->save();
            if ($user->id == Session::get('sUser')->id) {
                Session::put('sUser', $user);
            }
            return redirect('users/' . $userId . '/edit')->with('message', 'Cập nhật thông tin thành công!');
        } else return redirect('me');
    }

    public function deleteUser($userId)
    {
        $this->authLogin();
        if ($this->isAdmin()) {
            $deleteUser = $this->userRepository->find($userId);
            if (isset($deleteUser)) {
                $res = $this->userRepository->delete($userId);
                if ($res) {
                    response()->json([
                        'status' => '1',
                        'msg' => 'success'
                    ]);
                } else {
                    response()->json([
                        'status' => '0',
                        'msg' => 'fail'
                    ]);
                }
            }
            $allUser = $this->userRepository->getAll();
            return redirect('/users/lists')->with('user', Session::get('sUser'))->with('allUser', $allUser);
        } else return redirect('me');
    }

    public function addUser()
    {
        $this->authLogin();
        if ($this->isAdmin()) {
            return view('users.screen05-add-edit-user')->with('user', Session::get('sUser'));
        } else return redirect('me');
    }

    public function saveUser(Request $request)
    {
        $this->authLogin();
        if ($this->isAdmin()) {
            $data = $request->all();
            if (!isset($data['gender'])) {
                $data['gender'] = 1;
            }
            $date = strtotime($data['datepicker']);
            $password = Str::random(8) . 'A1';

            $user = new Users([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'password' => md5($password),
                'gender' => $data['gender'],
                'birthday' => date('Y/m/d', $date),
                'address' => $data['address'],
                'avatar' => ''
            ]);

            $avatar = $request->file('avatar');
            if ($avatar) {
                $avatarName = $avatar->getClientOriginalName();
                $avatar->move('public/frontend/images/avatars', $avatarName);
                $data['avatar'] = $avatarName;
                $user['avatar'] = $data['avatar'];
            }

            $dataMail = [
                'last_name' => $user['last_name'],
                'password' => $password,
                'enter' => "\n"
            ];
            Mail::send('mail-content', $dataMail, function ($message) use ($user) {
                $message->from('vinh.mt176912@gmail.com', 'Admin');
                $message->to($user['email'], 'User');
                $message->subject('Thư gửi mật khẩu trang quản lý thiết bị');
            });

            $user->save();
            Session::put('message', 'Cập nhật thông tin thành công!');
            $getUser = $this->userRepository->getLastAddedUser();
            return redirect('users/' . $getUser->id . '/edit')->with('user', Session::get('sUser'));
        } else return redirect('/me');
    }

    public function changeUserPassword($userId)
    {
        $this->authLogin();
        if ($this->isAdmin()) {
            $editUser = $this->userRepository->find($userId);
            if (isset($editUser)) {
                return view('users.screen07-change-pass')->with('user', Session::get('sUser'))->with('editUser', $editUser);
            }
            Session::put('message', 'User không tồn tại!');
        }
        return redirect('me');
    }

    public function updateUserPassword(Request $request, $userId)
    {
        $this->authLogin();
        if ($this->isAdmin()) {
            $user = $this->userRepository->find($userId);
            if (isset($user)) {
                $user->password = md5($request['new_password']);
                $user->save();
                return redirect('users/' . $user->id . '/password')->with('message', 'Cập nhật mật khẩu thành công!');
            }
            return redirect('users/' . $user->id . '/password')->with('message', 'Cập nhật mật khẩu không thành công!');
        } else return redirect('me');
    }

    public function changeUserRole($userId)
    {
        $this->authLogin();
        if ($this->isAdmin()) {
            $editUser = $this->userRepository->find($userId);
            if (isset($editUser)) {
                return view('users.screen08-change-role')->with('user', Session::get('sUser'))->with('editUser', $editUser);
            }
        }
        return redirect('me');
    }

    public function updateUserRole(Request $request, $userId)
    {
        $this->authLogin();
        if ($this->isAdmin()) {
            $user = $this->userRepository->find($userId);
            if (isset($user)) {
                $user->role = $request['role'];
                $user->save();
                return redirect('users/' . $user->id . '/role')->with('message', 'Cập nhật role thành công!');
            }
            Session::put('message', 'User không tồn tại!');
        }
        return redirect('me');
    }
*/
}

