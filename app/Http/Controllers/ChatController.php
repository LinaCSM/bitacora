<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class ChatController extends Controller
{
    var $pusher;
    var $chatChannel;

    public function __construct()
    {
        $this->pusher       =   App::make('pusher');
        $this->chatChannel  =   'chat';
    }

    /**
     * Mostrar la vista de chats
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $chatChannel = $this->chatChannel;

        return view('chat.index', compact('chatChannel'));
    }

    /**
     * Generar el nuevo mensaje
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $message = [
            'message'   => e($request->message),
            'username'  => "Ivonne",
            'timestamp' => date('Y-m-d H:i:s')
        ];

        try {
            $this->pusher->trigger($this->chatChannel, 'new-message', $message);
            return response()->json(['status' => '1']);
        } catch (\Exception $e) {
            return response()->json(['status' => '0']);
        }
    }
}