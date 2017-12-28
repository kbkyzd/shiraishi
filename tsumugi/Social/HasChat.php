<?php

namespace tsumugi\Social;

use shiraishi\User;
use shiraishi\Conversation;

trait HasChat
{
    /**
     * @param \shiraishi\User $recipient
     * @return \shiraishi\Conversation|null matching conversation for the recipient mapping
     */
    public function hasAConversationWith(User $recipient)
    {
        if ($this->id === $recipient->id) {
            return;
        }

        foreach ($this->conversations as $conversation) {
            if ($conversation->participants->pluck('id')->contains($recipient->id)) {
                return $conversation;
            }
        }
    }

    /**
     * Create a new conversation if there isn't one already.
     *
     * @param \shiraishi\User $recipient
     * @return \shiraishi\Conversation
     */
    public function createNewConversation(User $recipient)
    {
        /** @var Conversation $newConversation */
        $newConversation = $this->conversations()->create([
            'name' => "{$this->email}:{$recipient->email}",
        ]);

        // Attach user to respective pivot
        $newConversation->participants()->attach($recipient);

        return $newConversation;
    }
}
