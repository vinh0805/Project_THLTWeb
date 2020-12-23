<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function authLogin()
    {
        if (Session::get('sUser')) {
            return redirect('home');
        } else {
            return redirect('login')->send();
        }
    }

    public function login()
    {
        return view('login');
    }

    public function loginConfirm(Request $request)
    {
        $user = $this->userRepository->findUserByEmail($request['email']);
        if (isset($user)) {
            if ($user->password == md5($request['password'])) {
                Session::put('sUser', $user);
                return redirect('home');
            }
        }
        return redirect('/login')->with('message', 'Wrong account or password!!');
    }

    public function logout()
    {
        Session::flush();
        return redirect('login');
    }

    public function signup()
    {
        return view('signup');
    }
}
