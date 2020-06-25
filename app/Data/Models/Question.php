<?php

namespace App\Data\Models;

use App\Data\Collections\QuestionCollection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property string title
 */
class Question extends Model
{
    protected $fillable = [
        'title'
    ];

    protected $appends = [
        'answered_correctly'
    ];

    public function getAnsweredCorrectlyAttribute(): bool
    {
        return optional($this->practice)->was_correct === true;
    }

    public function answer(): HasOne
    {
        return $this->hasOne(Answer::class);
    }

    public function practice(): HasOne
    {
        return $this->hasOne(Practice::class)->latest('id');
    }

    public function newCollection(array $models = []): QuestionCollection
    {
        return new QuestionCollection($models);
    }
}
