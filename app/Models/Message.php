<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Jobs\SendMessageJob;

class Message extends Model
{
    public function messageList() {
        return $this->belongsTo(MessageList::class);
    }

    public function send() {
        $list = $this->messageList;

        $count = 0;
        foreach ($list->subscribers as $subscriber) {
            if ($subscriber->phone != $list->phone_owner) {
                SendMessageJob::dispatch($subscriber->phone, $this->message);
                $count++;
            }
        }

        SendMessageJob::dispatch($list->phone_owner, 'Beskeden er blevet send til ' . $count . ' modtagere');
    }
}
