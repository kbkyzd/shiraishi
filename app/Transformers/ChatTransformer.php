<?php

namespace shiraishi\Transformers;

use shiraishi\Chat;
use League\Fractal\TransformerAbstract;

class ChatTransformer extends TransformerAbstract
{
    public function transform(Chat $chat)
    {
        return [
            'sender'       => [
                'id'   => $chat->sender->id,
                'name' => $chat->sender->name,
            ],
            'conversation' => [
                'id'      => $chat->id,
                'message' => $chat->body,
                'sent'    => (string) $chat->created_at,
            ],
        ];
    }
}
