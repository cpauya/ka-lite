<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');

		if(is_logged_in())
			redirect('dashboard');
	}

	#-------------------------------------------------------------------------------------------------#
	public function index() 
	{
		# add condition if not logged in display this

		$nav['crumbs'] = array(
			[
				'name'		=> 'Home',
				'url'		=> '',
				'is_active' => true
			]
		);

		$data['title'] = 'NDU Curriculum Monitoring';
		$this->load->view('inc/header_view', $data);
		$this->load->view('inc/breadcrumbs', $nav);
		$this->load->view('inc/content_view');
		$this->load->view('inc/footer_view');
	}
	#-------------------------------------------------------------------------------------------------#
	public function login() 
	{

		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		if($message = $this->session->flashdata('error_message'))
			$data['error_message'] = $message;

		$data['title'] = "Login";
		$nav['crumbs'] = array(
			[
				'name'	=> 'Home',
				'url'	=> base_url(),
				'is_active'	=> false
			],
			[
				'name'	=> 'Login',
				'url'	=> '',
				'is_active'	=> true
			]
		);

		if($this->form_validation->run() == FALSE) 
		{
			$this->load->view('inc/header_view', $data);
			$this->load->view('inc/breadcrumbs', $nav);
			$this->load->view('home/login_view');
			$this->load->view('inc/footer_view');
		} 
		else 
		{
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			$password = SALT_PREFIX . $password . SALT_SUFFIX;
			$password = hash('sha512', $password);

			$this->load->model('user_model');

			$user = $this->user_model->get_by([
				'username' 		=> $username,
				'password'		=> $password
			]);

			if(!is_null($user)) 
			{
				unset($user['password']);
				$this->load->model('usermeta_model');

				$user_meta = new usermeta_model($user['user_id']);

				set_curr_user($user);
				set_user_info($user_meta->get_user_meta());

				if(is_admin())
				{
					redirect('dashboard');
				}
				else
				{
					redirect('student/view/mycurriculum');
				}
			}
			else
			{
				$data['error_message'] 		= "Invalid username or password.";
				$data['title']				= "Login";
				$data['username'] 			= $username;

				$this->load->view('inc/header_view', $data);
				$this->load->view('home/login_view');
				$this->load->view('inc/footer_view');
			}
		}
	}
	#-------------------------------------------------------------------------------------------------#
	public function register()
	{
		$this->load->model('student_model');
		$this->load->model('user_model');
		
		$this->form_validation->set_rules('student_id', 'Student ID', 'trim|required|is_unique[users.username]', ['is_unique' => 'This student id already has an account.']);
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required');

		$data['title'] = "Register";
		$data['back_url'] = base_url();
		$nav['crumbs'] = array(
			[
				'name'	=> 'Home',
				'url'	=> base_url(),
				'is_active'	=> false
			],
			[
				'name'	=> 'Register',
				'url'	=> '',
				'is_active'	=> true
			]
		);

		if($this->form_validation->run() == FALSE) 
		{
			$this->load->view('inc/header_view', $data);
			$this->load->view('inc/breadcrumbs', $nav);
			$this->load->view('home/register_view');
			$this->load->view('inc/footer_view');
		} 
		else 
		{
			$student_id 		= $this->input->post('student_id');
			$password 			= $this->input->post('password');
			$confirm_password 	= $this->input->post('confirm_password');

			$student_exists 	= $this->student_model->student_exists($student_id);

			if($password == $confirm_password && $student_exists) 
			{
				$this->load->model('usermeta_model');
				
				$password = SALT_PREFIX . $password . SALT_SUFFIX;
				$password = hash('sha512', $password);

				$user = new user_model();

				$user->username 		= $student_id;
				$user->password 		= $password;
				$user->user_registered 	= date('Y-m-d H:i:s');
				$user->save();

				$student_data 		= $this->student_model->get($student_id);

				$user_meta = new usermeta_model($user->user_id);
				$user_meta->set_user_role('student');
				$user_meta->set_user_info([
					'first_name' => $student_data['student_firstname'], 
					'last_name' => $student_data['student_lastname']
				]);

				$user_meta->insert_user_meta();

				$data['title'] = "Registration success";
				$data['success_message'] = "Congratulations! You have successully created your account.";

				$this->load->view('inc/header_view', $data);
				$this->load->view('home/register_view', $data);
				$this->load->view('inc/footer_view');
			}
			else
			{
				$data['title']						= "Register";

				if($password !== $confirm_password)
					$data['error_message'][] 		= "Passwords do not match!";

				if(!$student_exists)
					$data['error_message'][]		= "Student ID has no curriculum at the moment.";

				$this->load->view('inc/header_view', $data);
				$this->load->view('home/register_view', $data);
				$this->load->view('inc/footer_view');
			}
		}
	}
	#-------------------------------------------------------------------------------------------------#
}