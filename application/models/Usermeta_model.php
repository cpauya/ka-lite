<?php

class Usermeta_model extends MY_model {
	const DB_TABLE = 'users_meta';
	const DB_TABLE_PK = 'umeta_id';


	/**
	 *
	 * @var int $umeta_id
	 *
	*/
	public $umeta_id;
	
	/**
	 *
	 * @var int $user_id
	 *
	*/
	public $user_id;

	/**
	 *
	 * @var str $meta_key
	 *
	*/
	public $meta_key;

	/**
	 *
	 * @var str $meta_value
	 *
	*/
	public $meta_value;

	public $user_role;

	public $user_role_description;

	public $user_level;

	protected $user_capabilities;

	protected $user_info;

	protected $user_meta_data;

	public function __construct($user_id = '')
	{
		if(!empty($user_id))
			$this->user_id = $user_id;
	}
	#-------------------------------------------------------------------------------------------------#
	public function get_user_meta($user_id = '', $meta_key = null)
	{
		if(!empty($user_id))
			$this->user_id = $user_id;

		$all_rows = true;
		$user_meta = array();

		if($data = parent::get_by(['user_id' => $this->user_id], $all_rows))
		{
			foreach($data as $key => $field)
			{
				$user_meta[$field['meta_key']] = $field['meta_value'];
			}

			if(isset($user_meta['user_capabilities']))
				$user_meta['user_capabilities'] = unserialize($user_meta['user_capabilities']);
		}

		if(!is_null($meta_key))
		{
			return isset($user_meta[$meta_key]) ? $user_meta[$meta_key] : "";
		}
		
		return $user_meta;
	}
	#-------------------------------------------------------------------------------------------------#
	public function set_user_role($role)
	{
		$role_description = [
			'super_admin' 		=> 'Super Admin', 
			'dean' 				=> 'Dean', 
			'program_head' 		=> 'Program Head',
			'student' 			=> 'Student'
		];

		$user_level = [
			'super_admin' 		=> 5,
			'dean'		  		=> 4,
			'program_head' 		=> 3,
			'student'			=> 1
		];

		$this->user_role 				= $role;
		$this->user_role_description 	= $role_description[$role];
		$this->user_level			 	= $user_level[$role];

		$this->set_user_capabilities();
	}
	#-------------------------------------------------------------------------------------------------#
	public function set_user_capabilities()
	{
		if($this->user_role == '')
			return;

		if($this->user_role == 'super_admin')
		{
			$can_do = [
				'create_new_super_admin',
				'create_new_dean',
				'create_new_program_head',
				'create_new_student',
				'update_super_admin',
				'update_dean',
				'update_program_head',
				'update_student'
			];	
		}

		if($this->user_role == 'dean')
		{
			$can_do = [
				'create_new_program_head',
				'create_new_student',
				'update_program_head',
				'update_student'
			];
		}

		if($this->user_role == 'program_head')
		{
			$can_do = [
				'create_new_student',
				'update_student'
			];
		}

		if($this->user_role == 'student')
		{
			$can_do = [
				'view_curriculum'
			];
		}

		$this->user_capabilities = serialize($can_do);
	}
	#-------------------------------------------------------------------------------------------------#
	public function set_user_info($user_info = array())
	{
		if(empty($user_info))
		{
			$user_info['first_name'] = '';
			$user_info['last_name'] = '';
		}

		$this->user_info = $user_info;
	}
	#-------------------------------------------------------------------------------------------------#
	public function insert_user_meta()
	{
		$this->user_meta_data = $this->get_user_meta();

		$meta_data = array();

		$meta_data['user_role'] = $this->user_role;
		$meta_data['user_role_description'] = $this->user_role_description;
		$meta_data['user_level'] = $this->user_level;
		$meta_data['user_capabilities'] = $this->user_capabilities;

		foreach($this->user_info as $key => $value)
		{
			$meta_data[$key] = $value;
		}

		foreach($meta_data as $key => $value)
		{
			$this->update_user_meta($this->user_id, $key, $value);
		}
	}
	#-------------------------------------------------------------------------------------------------#
	public function update_user_meta($user_id = null, $key, $value = null)
	{
		if(empty($user_id))
		{
			$this->user_id = $user_id;
		}
		
		if(isset($this->user_meta_data[$key]))
		{
			$this->db->update('users_meta', 
				['meta_value' => $value], 
				['user_id' => $user_id, 'meta_key' => $key
			]);
		}
		else
		{
			$this->db->insert('users_meta', [
				'user_id' 		=> $user_id,
				'meta_key' 		=> $key,
				'meta_value' 	=> $value
			]);
		}
		
	}
	#-------------------------------------------------------------------------------------------------#
}