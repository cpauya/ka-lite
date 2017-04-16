<?php

class User_model extends MY_model {
	const DB_TABLE = 'users';
	const DB_TABLE_PK = 'user_id';

	/**
	 *
	 * @var int $user_id
	 *
	*/
	public $user_id;

	/**
	 *
	 * @var str $username
	 *
	*/
	public $username;

	/**
	 *
	 * @var str $password
	 *
	*/
	public $password;

	public $user_registered;

	public function __construct($user_id = '')
	{
		if(!empty($user_id))
			$this->user_id = $user_id;
	}

	public function get_users()
	{
		$user_level = get_user_info()['user_level'];

		$this->db->select('*')
			->from('users')
			->join('users_meta', 'users.user_id = users_meta.user_id')
			->where('meta_key', 'user_level')
			->where('meta_value <', (int)$user_level)
			->order_by("meta_key = 'user_level'", 'DESC')
			->order_by('meta_value', 'DESC');

		$query = $this->db->get()->result_array();

		return $query;
	}
}