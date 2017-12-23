<?php

namespace shiraishi;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    /**
     * Participants of the conversation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function participants()
    {
        return $this->belongsToMany(User::class, 'conversation_participants', 'conversation_id', 'user_id');
    }

    /**
     * Messages in the conversation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages()
    {
        return $this->hasMany(Chat::class, 'conversation_id');
    }
}
