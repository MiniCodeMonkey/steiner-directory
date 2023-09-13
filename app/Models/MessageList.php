<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MessageList extends Model
{
    public function subscribers() {
        return $this->hasMany(Subscriber::class);
    }

    public function messages() {
        return $this->belongsToMany(Message::class);
    }
}