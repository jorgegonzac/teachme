<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Lesson;

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
		$lesson = Lesson::where('start_date', '>=', Carbon::today())->where('end_date', '<', Carbon::tomorrow())->first();
		return Carbon::today();
        return view('users.home', ['lesson' => $lesson]);
    }
}
