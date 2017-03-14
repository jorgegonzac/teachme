<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$admin = User::create([
			'first_name' 	=> 'carlos',
			'last_name'	 	=> 'gomez',
			'email' 		=> 'carlos@mienvio.mx',
			'password'		=> 'carlos@mienvio.mx',
			'type'			=> 'admin',
		]);
    }
}
