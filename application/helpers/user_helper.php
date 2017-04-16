<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('set_curr_user'))
{
	function set_curr_user($user_details)
	{
		$CI =& get_instance();

		$user_details['is_logged_in'] = true;

		$CI->session->set_userdata('current_user', $user_details);
	}	
}

if(!function_exists('get_curr_user'))
{
	function get_curr_user($k = null)
	{
		$CI =& get_instance();

		$current_user = array();

		if($session_data = $CI->session->userdata('current_user'))
		{
			foreach($session_data as $key => $value)
			{
				$current_user[$key] = $value;
			}
		}

		return isset($current_user[$k]) ? $current_user[$k] : $current_user;
	}
}

if(!function_exists('get_user_info'))
{
	function get_user_info($k = null)
	{
		$CI =& get_instance();
		
		$user_meta = array();

		if($session_data = $CI->session->userdata('user_meta'))
		{
			foreach($session_data as $key => $value)
			{
				$user_meta[$key] = $value;
			}
		}

		return (empty($k)) ? $user_meta : $user_meta[$k];
	}
}

if(!function_exists('set_user_info'))
{
	function set_user_info($user_info)
	{
		$CI =& get_instance();
		$CI->session->set_userdata('user_meta', $user_info);
	}
}

if(!function_exists('is_admin'))
{
	function is_admin()
	{
		$user = get_user_info();

		if(!empty($user))
		{
			if(in_array($user['user_role'], array_keys(ADMIN_ROLES)))
				return true;
		}

		return false;
	}
}

if(!function_exists('is_student'))
{
	function is_student()
	{
		$user = get_user_info();

		if(!empty($user))
		{
			if(in_array($user['user_role'], array_keys(STUDENT_ROLES)))
				return true;
		}

		return false;
	}
}

if(!function_exists('is_dean'))
{
	function is_dean()
	{
		$user = get_user_info();

		if(!empty($user))
		{
			return $user['user_role'] == 'dean';
		}

		return false;
	}
}

if(!function_exists('is_super_admin'))
{
	function is_super_admin()
	{
		$user = get_user_info();

		if(!empty($user))
		{
			return $user['user_role'] == 'super_admin';
		}

		return false;
	}
}

if(!function_exists('is_logged_in'))
{
	function is_logged_in()
	{
		$user = get_curr_user();

		return isset($user['is_logged_in']);
	}
}

if(!function_exists('user_can'))
{
	function user_can($capability)
	{
		if(in_array($capability, get_user_info()['user_capabilities']))
			return true;

		return false;
	}
}