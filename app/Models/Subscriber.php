<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Subscriber extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'child_name',
        'phone',
    ];

    public function messageLists() {
        return $this->belongsToMany(MessageList::class, 'list_subscriber');
    }

    public function canPublish(): bool {
        return MessageList::where('phone_owner', $this->phone)->count() > 0;
    }
}
