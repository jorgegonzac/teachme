<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateTestRequest;
use App\Test;
use App\Lesson;
use View;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tests = Test::all();

		return View::make('tests.index', ['tests' => $tests]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$lessons = Lesson::all();

		return View::make('tests.create', ['lessons' => $lessons]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CreateTestRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTestRequest $request)
    {
        $test = Test::create($request->all());

		return redirect()->back()->with('success', 'The test was created successfuly');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		$test = Test::findOrFail($id);

		return View::make('tests.show', ['test' => $test]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$lessons = Lesson::all();
		$test = Test::findOrFail($id);

		return View::make('tests.edit', ['test' => $test, 'lessons' => $lessons]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CreateTestRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateTestRequest $request, $id)
    {
		$test = Test::findOrFail($id);

		$test->fill($request->all());
		$test->save();

		return redirect()->back()->with('success', 'The test was successfuly updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		Test::destroy($id);

		return redirect()->back()->with('success', 'The test was destroyed successfuly');
    }
}
