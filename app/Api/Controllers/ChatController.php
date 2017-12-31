<?php

namespace shiraishi\Api\Controllers;

use shiraishi\User;
use Illuminate\Http\Request;
use shiraishi\Transformers\ChatTransformer;
use shiraishi\Transformers\ConversationTransformer;
use shiraishi\Api\Controllers\BaseApiController as ApiController;

class ChatController extends ApiController
{
    /**
     * Set limit.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function __construct(Request $request)
    {
        $this->perPage = $this->limit($request->limit ?? 5, 1, 20);
    }

    /**
     * Display recent conversations.
     *
     * @return \Dingo\Api\Http\Response
     */
    public function index()
    {
        $conversations = $this->user->conversations()
                                    ->paginate($this->perPage);

        return $this->response->paginator($conversations, new ConversationTransformer());
    }

    /**
     * Send a new message to the specified recipient.
     *
     * @param \Illuminate\Http\Request $request
     * @param \shiraishi\User          $recipient
     * @return \Dingo\Api\Http\Response
     */
    public function store(Request $request, User $recipient)
    {
        $this->excludeSelf($this->user->id, $recipient->id);

        if (! $chat = $this->user->hasAConversationWith($recipient)) {
            $chat = $this->user->createNewConversation($recipient);
        }

        $message = $chat->messages()->create([
            'sender_id' => $this->user->id,
            'body'      => $request->message,
        ]);

        $conversation = $message->conversation;
        $conversation->updated_at = now();
        $conversation->save();

        return $this->response->item($message, new ChatTransformer());
    }

    /**
     * Display the specified resource.
     *
     * @param \shiraishi\User $recipient
     * @return \Illuminate\Http\Response
     */
    public function show(User $recipient)
    {
        $this->excludeSelf($this->user->id, $recipient->id);
        $conversation = $this->user->hasAConversationWith($recipient);

        if (! $conversation) {
            return $this->response->errorNotFound("No available messages with {$recipient->name} (id: {$recipient->id})");
        }

        $messages = $conversation->messages()
                                 ->paginate($this->perPage);

        return $this->response->paginator($messages, new ChatTransformer());
    }

    /**
     * @param int $from
     * @param int $to
     */
    protected function excludeSelf($from, $to)
    {
        if ($from === $to) {
            return $this->response->errorBadRequest("That's your account! You can't send/receive messages to yourself :(");
        }
    }
}
