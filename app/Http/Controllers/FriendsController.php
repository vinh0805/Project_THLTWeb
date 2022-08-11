<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Friend;
use App\Models\LikePost;
use App\Models\Notification;
use App\Models\Post;
use App\Models\User;
use App\Repositories\UserRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class FriendsController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
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

    public function authLogin()
    {
        if (Session::get('sUser')) {
            return redirect('me');
        } else {
            return redirect('login')->send();
        }
    }

    public function sendRequest(Request $request)
    {
        $from = @Session::get('sUser')['id'];
        $to = $request->get('to');

        $from_user = @Session::get('sUser');
        $to_user = User::find($to);
        if (!isset($from_user) || !isset($to_user)) {
            return response()->json([
                'success' => false,
                'msg' => 'Wrong user data!'
            ]);
        }

        $request_old = Friend::where([
            'from' => $from,
            'to' => $to
        ])
            ->whereNotIn('status', [2, 3])
            ->get();
        if (count($request_old)) {
            return response()->json([
                'success' => false,
                'msg' => 'You sent request before!'
            ]);
        }

        try {
            $friend = new Friend([
                'from' => $from,
                'to' => $to,
                'status' => 0,
            ]);
            $friend->save();

            // Notify
            $content = @$from_user['name'] . ' want to be your friend';
            $newNotification = new Notification([
                'fuser_id' => $from,
                'user_id' => $to,
                'type' => 1,
                'content' => $content
            ]);
            $newNotification->save();

            return response()->json([
                'success' => true,
                'msg' => 'Send request successfully!'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'msg' => 'Cannot send request!'
            ]);
        }
    }

    public function delete(Request $request)
    {
        $from = @Session::get('sUser')['id'];
        $to = $request->get('to');

        $from_user = @Session::get('sUser');
        $to_user = User::find($to);
        if (!isset($from_user) || !isset($to_user)) {
            return response()->json([
                'success' => false,
                'msg' => 'Wrong user data!'
            ]);
        }

        $request_old = Friend::where([
            'from' => $from,
            'to' => $to
        ])
            ->whereNotIn('status', [2, 3])
            ->orWhere([
                'from' => $to,
                'to' => $from
            ])
            ->whereNotIn('status', [2, 3])
            ->first();
        if (!@$request_old) {
            return response()->json([
                'success' => false,
                'msg' => 'Wrong request data!'
            ]);
        }
        $request_old['status'] = 3;
        $request_old->save();
        return response()->json([
            'success' => true,
            'msg' => 'Deleted!'
        ]);
    }

    public function reply(Request $request)
    {
        $from = $request->get('from');
        $to = @Session::get('sUser')['id'];
        $accept = $request->get('accept');

        $from_user = User::find($from);
        $to_user = User::find($to);
        if (!isset($from_user) || !isset($to_user)) {
            return response()->json([
                'success' => false,
                'msg' => 'Wrong user data!'
            ]);
        }
        $request_old = Friend::where([
            'from' => $from,
            'to' => $to
        ])
            ->where('status', 0)
            ->first();
        if (!@$request_old) {
            return response()->json([
                'success' => false,
                'msg' => 'Wrong user data!'
            ]);
        }

        $request_old['status'] = $accept;
        $request_old->save();
        $response_msg = $accept ? 'Accepted!' : 'Declined!';

        // Notify
        $content = @$to_user['name'] . ' accepted to your friend request.';
        $newNotification = new Notification([
            'fuser_id' => $to,
            'user_id' => $from,
            'type' => 1,
            'content' => $content
        ]);
        $newNotification->save();

        return response()->json([
            'success' => true,
            'msg' => $response_msg
        ]);
    }
}

