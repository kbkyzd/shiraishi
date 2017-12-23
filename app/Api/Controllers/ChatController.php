<?php

namespace shiraishi\Api\Controllers;

use shiraishi\Chat;
use shiraishi\User;
use Illuminate\Http\Request;
use shiraishi\Http\Controllers\Controller;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param $recipient
     * @return void
     */
    public function index($recipient)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param                          $recipient
     * @return void
     */
    public function store(Request $request, User $recipient)
    {
        /** @var \shiraishi\User $user */
        $user = auth()->user();

        if ($chat = $user->hasAConversationWith($recipient)) {
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \shiraishi\Chat $chat
     * @return \Illuminate\Http\Response
     */
    public function show(Chat $chat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \shiraishi\Chat          $chat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chat $chat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \shiraishi\Chat $chat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chat $chat)
    {
        //
    }
}
