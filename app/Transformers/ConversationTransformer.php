<?php

namespace shiraishi\Transformers;

use shiraishi\User;
use shiraishi\Conversation;
use League\Fractal\TransformerAbstract;

class ConversationTransformer extends TransformerAbstract
{
    /**
     * @var array
     */
    protected $defaultIncludes = [
        'participants',
    ];

    /**
     * @param \shiraishi\Conversation $conversation
     * @return array
     */
    public function transform(Conversation $conversation)
    {
        return [
            'ident'         => $conversation->name,
            'last_activity' => (string) $conversation->updated_at,
        ];
    }

    /**
     * Remove references to current user in participants.
     *
     * @param \Illuminate\Support\Collection $participants
     * @return \shiraishi\User
     */
    protected function removeSelf($participants)
    {
        $currentUser = auth('api')->user()->id;

        $filtered = $participants->reject(function ($value, $key) use ($currentUser) {
            return $value->id === $currentUser;
        });

        return $filtered->first();
    }

    /**
     * Include participants.
     *
     * @param \shiraishi\Conversation $conversation
     * @return \League\Fractal\Resource\Item
     */
    public function includeParticipants(Conversation $conversation)
    {
        $participants = $this->removeSelf($conversation->participants);

        return $this->item($participants, new ParticipantTransformer());
    }
}
