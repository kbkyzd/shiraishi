<?php

namespace tsumugi\Social;

use shiraishi\User;

trait HasChat
{
    /**
     * @param \shiraishi\User $recipient
     * @return \shiraishi\Conversation|null
     */
    public function hasAConversationWith(User $recipient)
    {
        if ($this->id === $recipient->id) {
            return null;
        }

        foreach ($this->conversations as $conversation) {
            if ($conversation->participants->pluck('id')->contains($recipient->id)) {
                return $conversation;
            }
        }
    }
}
