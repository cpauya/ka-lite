<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	#-------------------------------------------------------------------------------------------------#
	public function index()
	{

		if(is_admin())
		{
			$this->admin();
		}
		else
		{
			$this->student();
		}
		
	}
	#-------------------------------------------------------------------------------------------------#
	public function admin()
	{
		$this->load->model('college_model');
		$this->load->model('department_model');
		$this->load->model('course_model');
		$this->load->model('curriculum_model');

		$data['title'] = "Dashboard";
		$nav['crumbs'] = array(
			[
				'name'		=> 'Home',
				'url'		=> '',
				'is_active' => true
			]
		);

		$this->load->view('inc/header_view', $data);
		$this->load->view('inc/breadcrumbs', $nav);

		$data['colleges'] 			= $this->college_model->get();
		$data['departments'] 		= $this->department_model->get();
		$data['courses'] 			= $this->course_model->get();
		$data['curriculums']		= $this->curriculum_model->get();

		$this->load->view('admin/admin_dashboard', $data);
		$this->load->view('inc/footer_view');
	}
	#-------------------------------------------------------------------------------------------------#
	public function student()
	{
		$data['title'] = 'Dashboard';
		$nav['crumbs'] = array(
			[
				'name'		=> 'Home',
				'url'		=> '',
				'is_active' => true
			]
		);
		$this->load->view('inc/header_view', $data);
		$this->load->view('inc/breadcrumbs', $nav);
		$this->load->view('student/student_dashboard');
		$this->load->view('inc/footer_view');
	}
	#-------------------------------------------------------------------------------------------------#
	public function add_user()
	{
		$this->load->library('form_validation');

		$data['user_level'] 	= get_user_info()['user_level'];
		$data['back_url'] 		= site_url('dashboard/manage_users');

		$this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[users.username]', ['is_unique' => '%s already exists!', 'required' => '%s cannot be empty.']);
		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required', ['required' => '%s cannot be empty.']);
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required', ['required' => '%s cannot be empty.']);
		$this->form_validation->set_rules('password', 'Password', 'trim|required', ['required' => '%s cannot be empty.']);
		$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required', ['required' => '%s cannot be empty.']);

		$nav['crumbs'] = array(
			[
				'name'		=> 'Home',
				'url'		=> site_url(),
				'is_active' => false
			],
			[
				'name'		=> 'Dashboard',
				'url'		=> site_url('dashboard'),
				'is_active'	=> false
			],
			[
				'name'		=> 'Manage Users',
				'url'		=> site_url('dashboard/manage_users'),
				'is_active'	=> false
			],
			[
				'name'		=> 'Add User',
				'url'		=> '',
				'is_active'	=> true
			]
		);

		if($this->form_validation->run() == FALSE)
		{
			$this->load->view('inc/header_view');
			$this->load->view('inc/breadcrumbs', $nav);
			$this->load->view('manage_users/add_user', $data);
			$this->load->view('inc/footer_view');
		}
		else
		{
			$this->load->model('user_model');

			$username 			= $this->input->post('username');
			$user_type			= $this->input->post('user_type');
			$first_name			= $this->input->post('first_name');
			$last_name			= $this->input->post('last_name');
			$password 			= $this->input->post('password');
			$confirm_password 	= $this->input->post('confirm_password');

			$user_exists = $this->user_model->get_by(['username' => $username]);

			if($password == $confirm_password && !$user_exists) 
			{
				$this->load->model('usermeta_model');
				
				$password = SALT_PREFIX . $password . SALT_SUFFIX;
				$password = hash('sha512', $password);

				$user = new user_model();

				$user->username 		= $username;
				$user->password 		= $password;
				$user->user_registered 	= date('Y-m-d H:i:s');
				$user->save();

				$user_meta = new usermeta_model($user->user_id);
				$user_meta->set_user_role($user_type);
				$user_meta->set_user_info([
					'first_name' 	=> $first_name,
					'last_name' 	=> $last_name
				]);

				$user_meta->insert_user_meta();

				$data['success_message'] = "Successfully added user.";

				$this->load->view('inc/header_view');
				$this->load->view('manage_users/add_user', $data);
				$this->load->view('inc/footer_view');
			}
			else
			{
				$data['title']						= "Register";

				if($password !== $confirm_password)
					$data['error_message'][] 		= "Passwords do not match!";

				$this->load->view('inc/header_view', $data);
				$this->load->view('manage_users/add_user', $data);
				$this->load->view('inc/footer_view');
			}
		}
	}
	#-------------------------------------------------------------------------------------------------#
	public function update_user($user_id = null)
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required', ['required' => '%s cannot be empty.']);
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required', ['required' => '%s cannot be empty.']);

		$this->load->model('user_model');
		$this->load->model('usermeta_model');

		$user_id = empty($user_id) ? get_curr_user()['user_id'] : $user_id;

		$data['update_self'] = ($user_id == get_curr_user()['user_id']) ? true : false;
		$data['back_url'] = is_admin() ? site_url('dashboard/manage_users') : site_url('student/view/mycurriculum');

		$nav['crumbs'] = array(
			[
				'name'		=> 'Home',
				'url'		=> site_url(),
				'is_active' => false
			],
			[
				'name'		=> is_admin() ? 'Dashboard' : 'My Curriculum',
				'url'		=> is_student() ? site_url('student/view/mycurriculum') : site_url('dashboard'),
				'is_active'	=> false
			]
		);

		if(is_admin())
		{
			$nav['crumbs'][] = [
				'name'			=> 'Manage Users',
				'url'			=> site_url('dashboard/manage_users'),
				'is_active'		=> false
			];
		}

		$user 				= new user_model($user_id);
		$user_meta 			= new usermeta_model($user->user_id);

		$user_credentials 	= $user->get($user_id);
		$user_meta 			= $user_meta->get_user_meta();

		$data['user'] 		= (object) $user_credentials;
		$data['user_meta'] 	= (object) $user_meta;



		if($this->form_validation->run() == FALSE)
		{
			$nav['crumbs'][] = [
				'name'		=> 'Update [' . $user_meta['first_name'] . ' ' . $user_meta['last_name'] . ']',
				'url'		=> '',
				'is_active'	=> true
			];

			$this->load->view('inc/header_view');
			$this->load->view('inc/breadcrumbs', $nav);
			//if user is trying to update another user of the same level or greater than him
			if($data['update_self'] == false && $user_meta['user_level'] >= get_user_info('user_level'))
			{
				$this->load->view('manage_users/update_error');
			}
			else
			{
				$this->load->view('manage_users/update_user', $data);				
			}

			$this->load->view('inc/footer_view');
		}
		else
		{
			$old = $this->user_model->get($user_id);

			$user = new user_model($user_id);
			$user_meta = new usermeta_model($user->user_id);
			$old_meta = $user_meta->get_user_meta();

			$user->username = $old['username'];
			$user->user_registered = $old['user_registered'];

			if(!empty($this->input->post('new_password')))
			{
				$current_password = SALT_PREFIX . $this->input->post('current_password') . SALT_SUFFIX;
				$current_password = hash('sha512', $current_password);

				if($current_password == $old['password'])
				{
					$password = $this->input->post('new_password');
					$password = SALT_PREFIX . $password . SALT_SUFFIX;
					$password = hash('sha512', $password);

					$user->password = $password;	
				}
				else
				{
					$user->password = $old['password'];
					$data['error_message'][] = 'Invalid password!';
				}
				
			}
			else
			{
				$user->password = $old['password'];
			}

			$user_meta->set_user_info([
					'first_name' 	=> $this->input->post('first_name'),
					'last_name' 	=> $this->input->post('last_name')
			]);

			if($data['update_self'])
			{

				$user_meta->user_role 				= $old_meta['user_role'];
				$user_meta->user_role_description 	= $old_meta['user_role_description'];
				$user_meta->user_level			 	= $old_meta['user_level'];
				$user_meta->set_user_capabilities();

				$user->save();
				$user_meta->insert_user_meta();

				$user = (array) $user;
				unset($user['password']);

				set_curr_user($user);
				set_user_info($user_meta->get_user_meta());

				$this->session->set_flashdata('success_message', 'Successfully updated!');
			}
			else
			{
				$user_meta->set_user_role($this->input->post('user_type'));
				$user->save();
				$user_meta->insert_user_meta();

				$this->session->set_flashdata('success_message', 'Successfully updated!');		
			}

			$user_meta 	= new usermeta_model($user_id);

			$data['user'] = (object) $this->user_model->get($user_id);

			$data['user_meta'] = (object) $user_meta->get_user_meta();

			$nav['crumbs'][] = [
				'name'		=> 'Update [' . $data['user_meta']->first_name . ' ' . $data['user_meta']->last_name . ']',
				'url'		=> '',
				'is_active'	=> true
			];

			$this->load->view('inc/header_view');
			$this->load->view('inc/breadcrumbs', $nav);
			$this->load->view('manage_users/update_user', $data);
			$this->load->view('inc/footer_view');
		}

	}
	#-------------------------------------------------------------------------------------------------#
	public function manage_users()
	{
		$this->load->model('user_model');
		$this->load->model('usermeta_model');

		$data['users'] = $this->user_model->get_users();
		
		foreach($data['users'] as &$user)
		{
			$user['user_role_description'] = $this->usermeta_model->get_user_meta($user['user_id'], 'user_role_description');
		}

		$nav['crumbs'] = array(
			[
				'name'		=> 'Home',
				'url'		=> site_url(),
				'is_active' => false
			],
			[
				'name'		=> 'Dashboard',
				'url'		=> site_url('dashboard'),
				'is_active'	=> false
			],
			[
				'name'		=> 'Manage Users',
				'url'		=> '',
				'is_active'	=> true
			]
		);

		$this->load->view('inc/header_view');
		$this->load->view('inc/breadcrumbs', $nav);
		$this->load->view('manage_users/users_view', $data);
		$this->load->view('inc/footer_view');
	}
	#-------------------------------------------------------------------------------------------------#
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('login');
		die;
	}
	#-------------------------------------------------------------------------------------------------#
}
