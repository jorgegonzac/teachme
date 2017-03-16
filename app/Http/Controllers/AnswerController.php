<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateAnswerRequest;
use View;
use App\Question;
use App\Answer;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  int  $test_id
     * @param  int  $question_id
     * @return \Illuminate\Http\Response
     */
    public function index($test_id, $question_id)
    {
		$question = Question::findOrFail($question_id);

		return View::make('tests.questions.answers.index', ['question' => $question]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  int  $test_id
     * @param  int  $question_id
     * @return \Illuminate\Http\Response
     */
    public function create($test_id, $question_id)
    {
		$question = Question::findOrFail($question_id);

		return View::make('tests.questions.answers.create', ['question' => $question]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CreateAnswerRequest  $request
     * @param  int  $test_id
     * @param  int  $question_id
     * @return \Illuminate\Http\Response
     */
    public function store(CreateAnswerRequest $request, $test_id, $question_id)
    {
		$data = $request->all();

		if ($request->has('is_valid')) {
			$data['is_valid'] = true;
		} else {
			$data['is_valid'] = false;
		}

		$answer = Answer::create($data);
		$answer->question_id = $question_id;
		$answer->save();

		return redirect()->back()->with('success', 'The answer was created successfuly');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $test_id
     * @param  int  $question_id
     * @param  int  $answer_id
     * @return \Illuminate\Http\Response
     */
    public function show($test_id, $question_id, $answer_id)
    {
        $answer = Answer::findOrFail($answer_id);

		return View::make('tests.questions.answers.show', ['answer' => $answer]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $test_id
     * @param  int  $question_id
     * @param  int  $answer_id
     * @return \Illuminate\Http\Response
     */
    public function edit($test_id, $question_id, $answer_id)
    {
		$answer = Answer::where('question_id', $question_id)->where('id', $answer_id)->firstOrFail();

		return View::make('tests.questions.answers.edit', ['answer' => $answer]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CreateAnswerRequest  $request
     * @param  int  $test_id
     * @param  int  $question_id
     * @param  int  $answer_id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateAnswerRequest $request, $test_id, $question_id, $answer_id)
    {
		$answer = Answer::where('question_id', $question_id)->where('id', $answer_id)->firstOrFail();

		$data = $request->all();

		if ($request->has('is_valid')) {
			$data['is_valid'] = true;
		} else {
			$data['is_valid'] = false;
		}

		$answer->fill($data);
		$answer->save();

		return redirect()->back()->with('success', 'The answer was updated successfuly');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $test_id
     * @param  int  $question_id
     * @param  int  $answer_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($test_id, $question_id, $answer_id)
    {
        $answer = Answer::where('question_id', $question_id)->where('id', $answer_id)->firstOrFail();

		Answer::destroy($answer_id);
		return redirect()->back()->with('success', 'The answer was destroyed successfuly');
    }
}
