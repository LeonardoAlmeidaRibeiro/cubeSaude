<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GlucoseMeasurement extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'value', 'measurement_type', 'notes', 'measured_at'
    ];

    protected $casts = [
        'measured_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
