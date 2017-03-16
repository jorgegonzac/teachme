<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateProfileRequest;
use App\User;
use App\Lesson;
use View;

class ProfileController extends Controller
{
	/**
     * Display the profile data
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
		$totalLessons = Lesson::all()->count();
		$takenLessons = $user->lessons()->count();
		$progressPercentage = ($takenLessons/$totalLessons) * 100 ;

		return View::make('users.users.profile', ['user' => $user, 'totalLessons' => $totalLessons, 'takenLessons' => $takenLessons, 'progressPercentage' => $progressPercentage]);
    }

	/**
	 * Updates the profile data
	 *
	 * @param  \App\Http\Requests\UpdateProfileRequest  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(UpdateProfileRequest $request)
	{
		// retrieve user
		$user = Auth::user();

		// check if img was uploaded
		if ($request->hasFile('profile_img')) {
			$newfilename = str_random(10) . $user->id . '.' .$request->file('profile_img')->extension();
			$path = $request->profile_img->storeAs('uploads/users', $newfilename, 'public');

			$user->profile_img = $path;
		}

		// store new data
		$user->first_name = $request->first_name;
		$user->last_name = $request->last_name;
		$user->save();

		return redirect()->to('profile')->with('success', 'Your profile has been updated!');
	}

}
