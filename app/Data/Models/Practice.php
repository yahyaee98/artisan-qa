<?php

namespace App\Data\Models;

use Illuminate\Database\Eloquent\Model;

class Practice extends Model
{
    protected $fillable = [
        'was_correct',
        'user_id',
        'question_id',
    ];

    protected $casts = [
        'was_correct' => 'boolean',
    ];
}
