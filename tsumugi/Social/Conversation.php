<?php

namespace tsumugi\Social;

use shiraishi\User;

class Conversation
{
    /**
     * @param \shiraishi\User $from
     * @param \shiraishi\User $to
     * @return \shiraishi\Chat|null
     */
    public function hasAConversationWith(User $from, User $to)
    {
        if ($from->id === $to->id) {
            return;
        }

        foreach ($from->conversations as $chat) {
            if ($chat->participants->pluck('id')->contains($to->id)) {
                return $chat;
            }
        }
    }
}
