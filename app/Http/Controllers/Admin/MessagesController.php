<?php


namespace App\Http\Controllers\Admin;


use App\Events\NewMessage;
use App\Http\Controllers\Controller;
use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class MessagesController extends Controller
{

    public function history($chat_id)
    {
        $messages = Message::where('chat_id', $chat_id)->orderBy('id', 'asc')->get();

        return View::make('admin.messages.history', compact('messages'));
    }

    public function store(Request $request)
    {
        $message = Message::create([
            'user_id' => auth()->id(),
            'chat_id' => $request->get('chat_id'),
            'text' => $request->get('text')
        ]);

        broadcast(new NewMessage($message))->toOthers();

        return View::make('admin.messages.history', ['messages' => [$message]]);
    }
}
