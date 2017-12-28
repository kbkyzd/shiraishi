<?php

namespace shiraishi\Api\Controllers;

use shiraishi\Chat;
use shiraishi\User;
use Illuminate\Http\Request;
use Dingo\Api\Routing\Helpers;
use tsumugi\Foundation\Pagination;
use shiraishi\Http\Controllers\Controller;
use shiraishi\Transformers\ChatTransformer;

class ChatController extends Controller
{
    use Helpers, Pagination;

    /**
     * @var \shiraishi\User
     */
    protected $user;

    public function __construct(Request $request)
    {
        $this->user = $request->user('api');

        $this->perPage = $this->limit($request->limit, 1, 20);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Dingo\Api\Http\Response
     */
    public function index()
    {
        return $this->response->array($this->user->conversations);
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
        if (! $chat = $this->user->hasAConversationWith($recipient)) {
            $chat = $this->user->createNewConversation($recipient);
        }

        $message = $chat->messages()->create([
            'sender_id' => $this->user->id,
            'body'      => $request->message,
        ]);

        return $message;
    }

    /**
     * Display the specified resource.
     *
     * @param \shiraishi\User $recipient
     * @return \Illuminate\Http\Response
     */
    public function show(User $recipient)
    {
        $conversation = $this->user->hasAConversationWith($recipient);

        if (! $conversation) {
            return $this->response->errorNotFound("No available messages with {$recipient->name} (id: {$recipient->id})");
        }

        $messages = $conversation->messages()
                                 ->paginate($this->perPage);

        return $this->response->paginator($messages, new ChatTransformer());
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
