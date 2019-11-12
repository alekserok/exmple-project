<?php


namespace App\Http\Controllers;


use App\Events\NewMessage;
use App\Message;
use App\Notifications\ChatCreated;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class MessageController extends Controller
{
    public function history($chat_id)
    {
        $messages = Message::where('chat_id', $chat_id)->get();
        return View::make('messages.history', compact('messages'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'text' => 'required_without:attachment',
            'chat_id' => 'required|exists:messages,chat_id',
            'attachment' => 'max:2000'
        ]);

        $text = strip_tags($request->get('text'));

        if ($request->hasFile('attachment')) {
            $path = $request->file('attachment')->store('chats/' . $request->get('chat_id'), 'public');
            $text = '<a download href="/storage/' . $path . '">' . $request->file('attachment')->getClientOriginalName() . '</a>';
        }

        $message = Message::create([
            'text' => $text,
            'chat_id' => $request->get('chat_id'),
            'user_id' => null
        ]);

        broadcast(new NewMessage($message))->toOthers();

        return $message;
    }

    public function create()
    {
        $id = Str::uuid();

        $message = Message::create([
            'text' => 'Welcome to SexyTime!',
            'chat_id' => $id,
            'user_id' => 1
        ]);

        $users = User::all();
        Notification::send($users, new ChatCreated($message));

        return $id;
    }
}
