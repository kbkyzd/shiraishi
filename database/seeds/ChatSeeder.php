<?php

use Illuminate\Database\Seeder;
use shiraishi\Chat;
use shiraishi\Conversation;
use shiraishi\ConversationParticipant;
use shiraishi\User;
use Faker\Factory as Faker;

class ChatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $sender = User::find(1);
        $receipent = User::find(2);

        $conversation = Conversation::create([
            'name' => "{$sender->email}:{$receipent->email}",
        ]);

        foreach (range(1, 10) as $i) {
            Chat::create([
                'sender_id'       => $faker->randomElement([$sender->id, $receipent->id]),
                'conversation_id' => $conversation->id,
                'body'            => $faker->sentence,
            ]);
        }

        ConversationParticipant::insert([
            [
                'user_id'         => $sender->id,
                'conversation_id' => 1,
            ],
            [
                'user_id'         => $receipent->id,
                'conversation_id' => 1,
            ],
        ]);
    }
}
