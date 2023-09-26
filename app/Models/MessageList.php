<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MessageList extends Model
{
    public function subscribers() {
        return $this->belongsToMany(Subscriber::class, 'list_subscriber');
    }

    public function messages() {
        return $this->hasMany(Message::class);
    }
}
