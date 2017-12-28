<?php

namespace shiraishi\Api\Controllers;

use shiraishi\User;
use Illuminate\Http\Request;
use Dingo\Api\Routing\Helpers;
use tsumugi\Foundation\Pagination;
use shiraishi\Http\Controllers\Controller;
use shiraishi\Transformers\ChatTransformer;
use shiraishi\Transformers\ConversationTransformer;

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

        $this->perPage = $this->limit($request->limit ?? 5, 1, 20);
    }

    /**
     * Display a listing of the resource.
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
     * Store a newly created resource in storage.
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

    protected function excludeSelf($from, $to)
    {
        if ($from === $to) {
            return $this->response->errorBadRequest("That's your account! You can't send/receive messages to yourself :(");
        }
    }
}
