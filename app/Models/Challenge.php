<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    use HasFactory;
    protected $fillable = [
        'content',
        'challenge_date',
        'is_challenge',
        'user_id',
        'room_id',
        'path',
    ];
}
