<?php

namespace App\Quiz;

use Countable;

class QuestionsCollection implements Countable
{

    protected array $questions = [];

    public function add(Question $question)
    {
        $this->questions[] = $question;
    }

    public function count(): int
    {
        return count($this->questions);
    }

    public function countScore() : int
    {
        return count($this->correctlyAnswered());
    }


    public function correctlyAnswered(): array
    {
        return array_filter($this->questions, fn($q) => $q->isCorrect());
    }

    public function next()
    {
        $question = current($this->questions);
        next($this->questions);

        return $question;
    }

    public function answeredQuestions(): array {
        return array_filter($this->questions, fn($q) => $q->isAnswered());
    }

    public function countAnswered(): int {
        return count($this->answeredQuestions());
    }


    public function isAllFinish(): bool
    {
        return $this->count() === $this->countAnswered();
    }

}