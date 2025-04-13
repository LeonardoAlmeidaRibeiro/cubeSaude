<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'activity', 'duration', 'done_at'];

    protected $casts = [
        'done_at' => 'datetime',
    ];
}
