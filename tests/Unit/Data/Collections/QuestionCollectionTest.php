<?php

namespace Tests\Unit\Data\Collections;

use App\Data\Collections\QuestionCollection;
use App\Data\Models\Question;
use Mockery\MockInterface;
use Tests\TestCase;

class QuestionCollectionTest extends TestCase
{
    public function test_correct_answered_filter_works()
    {
        $collection = new QuestionCollection([
            \Mockery::mock(Question::class, function (MockInterface $mock) {
                $mock
                    ->shouldReceive('getAttribute')
                    ->with('answered_correctly')
                    ->andReturn(true);
            }),
            \Mockery::mock(Question::class, function (MockInterface $mock) {
                $mock
                    ->shouldReceive('getAttribute')
                    ->with('answered_correctly')
                    ->andReturn(false);
            }),
        ]);

        $this->assertCount(1, $collection->correctAnswered());
    }
}