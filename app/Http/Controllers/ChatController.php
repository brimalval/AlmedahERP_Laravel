<?php

namespace App\Http\Controllers;

use App\Events\Message;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index() {
        return view('modules.communications.chat-demo');
    }

    public function send() {
        event(new Message(request('username'), request('message')));
        return ["success" => true];
    }
}
