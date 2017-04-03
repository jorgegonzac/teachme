<?php

namespace App\Listeners;

use App\Events\InvitationWasCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;

class SendInvitationEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  InvitationWasCreated  $event
     * @return void
     */
    public function handle(InvitationWasCreated $event)
    {
		$data['token'] = $event->invitation->token;
		$email = $event->invitation->email;
		$subject = 'Invite MOOC';
		$template = 'emails.invitation';

		Mail::send(
			$template,
			$data,
			function($message) use ($email, $subject) {
				$message->from('dev@mienvio.mx', 'Invite MOOC');
				$message->to($email)->subject($subject);
			}
		);
    }
}
