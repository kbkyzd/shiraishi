<?php

namespace shiraishi;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    /**
     * Conversation the message belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function conversation()
    {
        return $this->belongsTo(Conversation::class, 'conversation_id');
    }

    /**
     * Sender of the message.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
}
