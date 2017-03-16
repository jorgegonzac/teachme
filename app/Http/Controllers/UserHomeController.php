<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\GradeTestRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Lesson;
use App\Test;
use App\Answer;

class UserHomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		// Retrieve today's lesson
		$lesson = Lesson::where('start_date', '<=', Carbon::today())->where('end_date', '>=', Carbon::tomorrow())->first();

		$takenTests = DB::table('user_test')
                     ->select('test_id')
                     ->where('user_id', '=', Auth::user()->id)
                     ->get();

        return view('users.users.home', ['lesson' => $lesson, 'takenTests' => $takenTests->pluck('test_id')->toArray()]);
    }

	/**
	 * Shows test of given lesson
	 *
	 * @param  int $lesson_id
	 * @param  int $test_id
	 * @return \Illuminate\Http\Response
	 */
	public function showTest($lesson_id, $test_id)
	{
		$test = Test::where('lesson_id', $lesson_id)->where('id', $test_id)->firstOrFail();

		return view('users.users.tests.show', ['test' => $test]);
	}

	/**
	 * Grades test
	 *
	 * @param  \App\Http\Requests\GradeTestRequest $request [description]
	 * @param  int $lesson_id
	 * @param  int $test_id
	 * @return \Illuminate\Http\Response
	 */
	public function gradeTest(GradeTestRequest $request, $lesson_id, $test_id)
	{
		$successMessage = 'Your test has been submited, thank you!';
		$user = Auth::user();
		$test = Test::findOrFail($test_id);
		$lesson = Lesson::findOrFail($lesson_id);

		if ($this->checkIfUserHasTakenTest($user->id, $test_id)) {
			return redirect()->back()->with('error', 'You have already taken this test.');
		}

		$accerts = 0;
		$totalQuestions = $test->questions->count();

		foreach ($request->questions as $question_id => $answer_id) {
			$answer = Answer::where('question_id', $question_id)->where('id', $answer_id)->first();

			if ($answer && $answer->is_valid) {
				$accerts++;
			}
		}

		$score = ($accerts / $totalQuestions) * 100;

		$test_user = $test->users()->attach($user->id, ['score' => $score, 'completed' => true]);

		if ($this->checkIfTestWasLastOne($lesson, $test, $user)) {
			$this->gradeLesson($lesson, $user);

			$successMessage = 'Congratz! You have finished all the tests for this lesson';
		}

		return redirect()->back()->with('success', $successMessage);
	}

	/**
	 * Grades lesson by getting average of all test scores
	 *
	 * @param  \App\Lesson $lesson
	 * @param  \App\User   $user
	 * @return float
	 */
	private function gradeLesson($lesson, $user)
	{
		$scores = $this->getTestScoresForLesson($lesson, $user);

		$lessonScore = $scores->sum() / $scores->count();

		$lesson->users()->attach($user->id, ['score' => $lessonScore, 'completed' => true]);

		return $lessonScore;
	}

	/**
	 * Get all the scores of given lesson
	 *
	 * @param  \App\Lesson $lesson
	 * @param  \App\User   $user
	 * @return \Illuminate\Support\Facades\DB
	 */
	private function getTestScoresForLesson($lesson, $user)
	{
		$scoresQuery = DB::table('user_test')
					 ->select('score')
					 ->where('user_id', '=', $user->id)
					 ->get();

		return $scoresQuery->pluck('score');
	}

	/**
	 * Checks if the given test was the last one to accomplish for given lesson
	 *
	 * @param  \App\Lesson $lesson
	 * @param  \App\Test   $test
	 * @param  \App\User   $user
	 * @return bool
	 */
	private function checkIfTestWasLastOne($lesson, $test, $user)
	{
		$missingTests = $this->getMissingTestsForThisLesson($user->id, $lesson);

		if ($missingTests->count() >= 1) {
			return false;
		}

		return true;
	}

	private function getMissingTestsForThisLesson($user_id, $lesson)
	{
		$totalTests = $lesson->tests->pluck('id');

		$row = DB::table('user_test')
					 ->select('test_id')
					 ->where('user_id', '=', $user_id)
					 ->get();

		$takenTests = $row->pluck('test_id')->toArray();

		$missingTests = $totalTests->diff($takenTests);

		return $missingTests;
	}

	/**
	 * Shows user grades
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function showGrades()
	{
		$tests = Auth::user()->tests;

		return view('users.users.grades', ['tests' => $tests]);
	}

	/**
	 * Checks if a user has already taken the given test
	 *
	 * @param  int $user_id
	 * @param  int $test_id
	 * @return bool
	 */
	private function checkIfUserHasTakenTest($user_id, $test_id)
	{
		$row = DB::table('user_test')
                     ->select(DB::raw('count(*)'))
                     ->where('user_id', '=', $user_id)
					 ->where('test_id', '=', $test_id)
                     ->first();

		if ($row->count >= 1) {
			return true;
		}

		return false;
	}
}
