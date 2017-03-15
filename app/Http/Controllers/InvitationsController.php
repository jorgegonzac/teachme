<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateInvitationRequest;
use App\Events\InvitationWasCreated;
use App\Invitation;
use View;
use Session;

class InvitationsController extends Controller
{
	/**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('users.invite');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CreateInvitationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateInvitationRequest $request)
    {
		$invitation = Invitation::create([
			'email' => $request->email,
			'token' => $this->createToken()
		]);

		event(new InvitationWasCreated($invitation));

		return redirect()->back()->with('success', 'Invitation send successfuly');
    }

	/**
	 * Registers an invitation token and redirects to register site
	 *
	 * @param  hash $token
	 * @return redirect
	 */
	public function registerToken($token)
	{
		session(['teachme_register_token' => $token]);

		return redirect()->to('register');
	}

	/**
	 * Creates token
	 *
	 * @return hash
	 */
	protected function createToken()
    {
        return hash_hmac('sha256', str_random(40), config('app.key'));
    }
}
