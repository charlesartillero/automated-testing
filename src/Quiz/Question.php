<?php

namespace App\Quiz;

class Question
{
    protected $question;
    protected $solution;
    /**
     * @var mixed
     */
    protected $answer;


    public function __construct($question, $solution)
    {
        $this->solution = $solution;
        $this->question = $question;
    }

    public function answer($answer): bool
    {
        $this->answer = $answer;

        return $this->isCorrect();
    }

    public function isCorrect(): bool
    {
        return $this->answer === $this->solution;
    }

    public function isAnswered(): bool
    {
        return isset($this->answer);
    }
}