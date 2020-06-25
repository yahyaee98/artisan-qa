<?php

namespace App\Data\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string title
 */
class Answer extends Model
{
    protected $fillable = [
        'title'
    ];

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }
}
