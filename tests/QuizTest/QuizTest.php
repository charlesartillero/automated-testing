<?php

namespace QuizTest;

use App\Quiz\Question;
use App\Quiz\Quiz;
use PHPUnit\Framework\TestCase;

class QuizTest extends TestCase
{

    protected $quiz;

    protected function setUp(): void
    {
        $this->quiz = new Quiz();
    }

    public function test_it_correctly_tracks_the_number_of_total_questions()
    {


        $this->quiz->addQuestion(new Question('What is 2 + 2 ?', 4));

        $this->assertEquals(1, $this->quiz->countQuestions());

        $this->quiz->addQuestion(new Question('What is 2 + 2 ?', 4));

        $this->assertEquals(2, $this->quiz->countQuestions());
    }

    public function test_it_correctly_grades_a_perfect_quiz()
    {

        $this->quiz->addQuestion($question1 = new Question('What is 2 + 2 ?', 4));
        $this->quiz->addQuestion($question2 = new Question('What is 2 + 3 ?', 5));

        $question1->answer(4);
        $question2->answer(7);

        $this->assertNotEquals(100, $this->quiz->grade());

        $question2->answer(5);
        $this->assertEquals(100, $this->quiz->grade());
    }

    public function test_it_correctly_grades_a_failed_quiz()
    {
        $this->quiz->addQuestion($question1 = new Question('What is 2 + 2 ?', 4));
        $this->quiz->addQuestion($question2 = new Question('What is 2 + 3 ?', 5));

        $question1->answer(4);
        $question2->answer(7);

        $this->assertNotEquals(0, $this->quiz->grade());

        $question1->answer(5);
        $question2->answer(2);
        $this->assertEquals(0, $this->quiz->grade());


    }

    public function test_it_cannot_be_graded_until_all_questions_have_been_answered()
    {

        $this->quiz->addQuestion(new Question('What is 2 + 2 ?', 4));

        $this->expectException(\Exception::class);
        $this->quiz->grade();

        $this->quiz->nextQuestion()->answer(4);
        $this->quiz->grade();

        $this->assertTrue($this->quiz->isDone());
    }

    public function test_it_correctly_tracks_the_questions_in_the_queue()
    {
        $this->quiz->addQuestion($question1 = new Question('What is 2 + 2 ?', 4));
        $this->quiz->addQuestion($question2 = new Question('What is 2 + 3 ?', 5));

        $this->assertEquals($question1, $this->quiz->nextQuestion());
        $this->assertEquals($question2, $this->quiz->nextQuestion());
    }

    public function test_it_returns_false_when_no_questions_remaining_in_the_queue()
    {
        $this->quiz->addQuestion($question1 = new Question('What is 2 + 2 ?', 4));
        $this->quiz->addQuestion($question2 = new Question('What is 2 + 3 ?', 5));

        $this->assertEquals($question1, $this->quiz->nextQuestion());
        $this->assertEquals($question2, $this->quiz->nextQuestion());

        $this->assertFalse($this->quiz->nextQuestion());

    }

    public function test_it_knows_if_all_the_questions_have_been_answered()
    {
        $this->quiz->addQuestion($question1 = new Question('What is 2 + 2 ?', 4));
        $this->quiz->addQuestion($question2 = new Question('What is 2 + 3 ?', 5));

        $this->assertFalse($this->quiz->isDone());

        $question1->answer(4);
        $this->assertFalse($this->quiz->isDone());

        $question2->answer(5);
        $this->assertTrue($this->quiz->isDone());

    }

}

