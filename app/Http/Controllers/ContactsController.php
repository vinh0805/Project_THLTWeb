<?php

namespace App\Http\Controllers;

use App\Events\NewMessage;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ContactsController extends Controller
{
    public function home()
    {
        $user = Session::get('sUser');
        if (isset($user)) {
            return view('chat');
        } else return redirect('home');
    }

    public function get()
    {
        $user = Session::get('sUser');
        if (isset($user)) {
            $contacts = User::where('id', '!=', $user->id)->get();
//            $contactsTo = DB::table('users')
//                ->join('messages', 'users.id', '=', 'messages.to')
//                ->select('users.*')->get();
//            $contacts = DB::table('users')
//                ->join('messages', 'users.id', '=', 'messages.from')
//                ->select('users.*')
//                ->orWhere($contactsTo)
//                ->where('id', '!=', $user->id)
//                ->get();
//            $to = Message::where('to', $user->id)->select('from')->get();
//            $contacts = User::where('id', 'messages.to')
//                ->orWhere('id', 'messages.from')
//                ->where('id', '!=', $user->id)->get();

            $unreadIds = Message::select(\DB::raw('`from` as sender_id, count(`from`) as messages_count'))
                ->where('to', '=', $user->id)
                ->where('read', '=', false)
                ->groupBy('from')
                ->get();

            $contacts = $contacts->map(function ($contact) use ($unreadIds) {
                $contactUnread = $unreadIds->where('sender_id', $contact->id)->first();

                $contact->unread = $contactUnread ? $contactUnread->messages_count : 0;

                return $contact;
            });

            return response()->json($contacts);
        }
    }

    public function getMessagesFor($id)
    {
        $user = Session::get('sUser');
        if (isset($user)) {
            Message::where('from', $id)->where('to', $user->id)->update(['read' => true]);

            $messages = Message::where(function ($q) use ($id, $user) {
                $q->where('from', '=', $user->id);
                $q->where('to', '=', $id);
            })->orWhere(function ($q) use ($id, $user) {
                $q->where('from', '=', $id);
                $q->where('to', '=', $user->id);
            })->get();

            return response()->json($messages);
        }
    }

    public function send(Request $request)
    {
        $user = Session::get('sUser');
        if (isset($user)) {
            $message = Message::create([
                'from' => $user->id,
                'to' => $request['contact_id'],
                'text' => $request['text']
            ]);

            broadcast(new NewMessage($message));

            return response()->json($message);

        }
    }
}
