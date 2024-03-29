<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateLessonRequest;
use App\Http\Requests\EditLessonRequest;
use App\Lesson;
use Validator;
use View;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lessons = Lesson::all();

		return View::make('lessons.index', ['lessons' => $lessons]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('lessons.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\CreateLessonRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateLessonRequest $request)
    {
        $lesson = Lesson::create($request->all());

		return redirect()->back()->with('success', 'The lesson was created successfuly');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lesson = Lesson::findOrFail($id);

		return View::make('lessons.show', ['lesson' => $lesson]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$lesson = Lesson::findOrFail($id);

		return View::make('lessons.edit', ['lesson' => $lesson]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\EditLessonRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditLessonRequest $request, $id)
    {
        $lesson = Lesson::findOrFail($id);

		$lesson->fill($request->all());
		$lesson->save();

		return redirect()->back()->with('success', 'The lesson was successfuly updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Lesson::destroy($id);

		return redirect()->back()->with('success', 'The lesson was destroyed successfuly');
    }
}
