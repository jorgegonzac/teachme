<?php
namespace App;


use Carbon\Carbon;
use Illuminate\Database\Connection;

class ActivationRepository
{
	/**
	 * db instance
	 *
	 * @var \Illuminate\Database\Connection
	 */
    protected $db;

	/**
	 * table name where activations are stored
	 *
	 * @var string
	 */
    protected $table = 'user_activations';

	/**
	 * Constructor
	 * 
	 * @param Connection $db [description]
	 */
    public function __construct(Connection $db)
    {
        $this->db = $db;
    }

	/**
	 * Generates a unique token
	 *
	 * @return hash
	 */
    protected function getToken()
    {
        return hash_hmac('sha256', str_random(40), config('app.key'));
    }

	/**
	 * Creates activation using given user
	 *
	 * @param  \App\User $user
	 * @return hash
	 */
    public function createActivation($user)
    {
        $activation = $this->getActivation($user);

        if (!$activation) {
            return $this->createToken($user);
        }

        return $this->regenerateToken($user);
    }

	/**
	 * Regenerates toke for given token
	 *
	 * @param  \App\User $user
	 * @return hash
	 */
    private function regenerateToken($user)
    {
        $token = $this->getToken();

        $this->db->table($table)->where('user_id', $user->id)->update([
            'token' => $token,
            'created_at' => new Carbon()
        ]);

        return $token;
    }

	/**
	 * Creates token for given user
	 *
	 * @param  \App\User $user
	 * @return hash
	 */
    private function createToken($user)
    {
        $token = $this->getToken();

        $this->db->table($this->table)->insert([
            'user_id' => $user->id,
            'token' => $token,
            'created_at' => new Carbon()
        ]);

        return $token;
    }

	/**
	 * Returns activation using given user
	 *
	 * @param  \App\User $user
	 * @return
	 */
    public function getActivation($user)
    {
        return $this->db->table($this->table)->where('user_id', $user->id)->first();
    }


	/**
	 * Returns activation using given token
	 *
	 * @param  [type] $token
	 * @return
	 */
    public function getActivationByToken($token)
    {
        return $this->db->table($this->table)->where('token', $token)->first();
    }

	/**
	 * Deletes given activation
	 *
	 * @param  [type] $token
	 * @return boolean
	 */
    public function deleteActivation($token)
    {
        $this->db->table($this->table)->where('token', $token)->delete();
    }
}
