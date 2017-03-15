<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateQuestionRequest;
use App\Test;
use App\Question;
use View;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($test_id)
    {
		$test = Test::findOrFail($test_id);

		return View::make('tests.questions.index', ['test' => $test]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param int $test_id
     * @return \Illuminate\Http\Response
     */
    public function create($test_id)
    {
		$test = Test::findOrFail($test_id);

		return View::make('tests.questions.create', ['test' => $test]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CreateQuestionRequest  $request
     * @param  int $test_id
     * @return \Illuminate\Http\Response
     */
    public function store(CreateQuestionRequest $request, $test_id)
    {
        $question = Question::create($request->all());
		$question->test_id = $test_id;
		$question->save();

		return redirect()->back()->with('success', 'The question was created successfuly');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $test_id
     * @param  int  $question
     * @return \Illuminate\Http\Response
     */
    public function show($test_id, $question_id)
    {
		$question = Question::where('test_id', $test_id)->where('id', $question_id)->firstOrFail();
		$test = Test::findOrFail($test_id);

		return View::make('tests.questions.show', ['question' => $question ,'test' => $test]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($test_id, $question_id)
    {
		$test = Test::findOrFail($test_id);
		$question = Question::where('test_id', $test_id)->where('id', $question_id)->firstOrFail();

		return View::make('tests.questions.edit', ['question' => $question ,'test' => $test]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CreateQuestionRequest  $request
     * @param  int  $test_id
     * @param  int  $question_id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateQuestionRequest $request, $test_id, $question_id)
    {
		$question = Question::findOrFail($question_id);

		$question->fill($request->all());
		$question->save();

		return redirect()->back()->with('success', 'The question was successfuly updated');
    }

    /**
     * Remove the specified resource from storage.
     *
	 * @param  int  $test_id
     * @param  int  $question_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($test_id, $question_id)
    {
		$question = Question::where('test_id', $test_id)->where('id', $question_id)->firstOrFail();

		Question::destroy($question_id);
		return redirect()->back()->with('success', 'The question was destroyed successfuly');
    }
}
