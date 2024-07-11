<?php

namespace App\Quiz;

class Quiz
{

    protected QuestionsCollection $questions;

    function __construct()
    {
        $this->questions = new QuestionsCollection();
    }

    public function addQuestion($question)
    {
        $this->questions->add($question);
    }

    public function countQuestions(): int
    {
        return $this->questions->count();
    }


    public function nextQuestion()
    {
        return $this->questions->next();
    }

    public function grade()
    {

        if (! $this->isDone()) {
            throw new \Exception('Finish first all the questions!');
        }

        return ($this->questions->countScore() / $this->questions->count() + 1) * 100;
    }

    public function isDone()
    {
        return $this->questions->isAllFinish();
    }


}