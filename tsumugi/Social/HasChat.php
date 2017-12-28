<?php

namespace tsumugi\Social;

use shiraishi\User;

trait HasChat
{
    /**
     * @param \shiraishi\User $recipient
     * @return \shiraishi\Chat|null
     */
    public function hasAConversationWith(User $recipient)
    {
        if ($this->id === $recipient->id) {
            return null;
        }

        foreach ($this->conversations as $chat) {
            if ($chat->participants->pluck('id')->contains($recipient->id)) {
                return $chat;
            }
        }
    }
}
