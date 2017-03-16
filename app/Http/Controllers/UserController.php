<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use App\User;
use App\Lesson;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$users = User::OnlyUsers()->get();
		$totalLessons = Lesson::all()->count();

		return View::make('users.index', ['users' => $users, 'totalLessons' => $totalLessons]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProfileRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		//
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
		$totalLessons = Lesson::all()->count();
		$takenLessons = $user->lessons()->count();
		$progressPercentage = ($takenLessons/$totalLessons) * 100 ;

		return View::make('users.show', ['user' => $user, 'totalLessons' => $totalLessons, 'takenLessons' => $takenLessons, 'progressPercentage' => $progressPercentage]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
