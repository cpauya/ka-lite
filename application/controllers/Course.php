<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Course extends MY_Controller {

	public function __construct() 
	{
		parent::__construct();
		$this->load->model('course_model');
	}
	#-------------------------------------------------------------------------------------------------#
	public function index() 
	{
		$this->view();
	}
	#-------------------------------------------------------------------------------------------------#
	public function add() 
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('department_id', 'Department', 'trim|required|numeric');
		$this->form_validation->set_rules('course_name', 'Course Name', 'trim|required|is_unique[course.course_name]', ['required' => '%s cannot be empty.', 'is_unique' => '%s already exists!']);
		$this->form_validation->set_rules('course_abbrev', 'Course Abbreviation', 'trim|required|is_unique[course.course_abbrev]', ['required' => '%s cannot be empty.', 'is_unique' => '%s already exists!']);	

		$nav['crumbs'] = array(
			[
				'name' 			=> 'Home',
				'url'			=> site_url(),
				'is_active'		=> false
			],
			[
				'name' 			=> 'Course',
				'url'			=> site_url('course'),
				'is_active'		=> false
			],
			[
				'name'			=> 'Add Course',
				'url'			=> '',
				'is_active'		=> true
			]
		);	

		if($this->form_validation->run() == FALSE)
		{
			$this->load->model('department_model');

			$data['departments'] 				= $this->department_model->get();
			$data['action_url'] 				= site_url('course/add');
			$data['back_url']					= site_url('course');

			$this->load->view('inc/header_view');
			$this->load->view('inc/breadcrumbs', $nav);
			$this->load->view('course/course_add', $data);
			$this->load->view('inc/footer_view');
		}
		else
		{
			$course = new course_model();

			$course->department_id 				= $this->input->post('department_id');
			$course->course_name 				= $this->input->post('course_name');
			$course->course_abbrev 				= $this->input->post('course_abbrev');

			$course->save();
			$redirect_url = 'course/view';
			redirect($redirect_url);
		}
	}
	#-------------------------------------------------------------------------------------------------#
	/**
	 *
	 * @param int $course_id
	 * @return void
	*/
	public function update($course_id) 
	{
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('department_id', 'Department', 'trim|required|numeric');
		$this->form_validation->set_rules('course_name', 'Course Name', 'trim|required', ['required' => '%s cannot be empty.']);
		$this->form_validation->set_rules('course_abbrev', 'Course Abbreviation', 'trim|required', ['required' => '%s cannot be empty.']);
		

		$this->load->model('department_model');
		$data['departments'] 				= $this->department_model->get();
		$data['course'] 					= $this->course_model->get_by(['course_id' => $course_id]);
		$data['action_url']					= site_url('course/update/') . $course_id;
		$data['back_url']					= site_url('course');

		$nav['crumbs'] = array(
			[
				'name' 			=> 'Home',
				'url'			=> site_url(),
				'is_active'		=> false
			],
			[
				'name' 			=> 'Course',
				'url'			=> site_url('course'),
				'is_active'		=> false
			],
			[
				'name'			=> 'Update Course [' . $data['course']['course_name'] . ']',
				'url'			=> '',
				'is_active'		=> true
			]
		);

		if(is_null($data['course']))
		{
			page404();
		}
		else
		{
			if($this->form_validation->run() == FALSE)
			{
				$this->load->view('inc/header_view');
				$this->load->view('inc/breadcrumbs', $nav);
				$this->load->view('course/course_update', $data);
				$this->load->view('inc/footer_view');
			}
			else
			{
				$course = new course_model();
				$course->course_id = $course_id;
				$course->department_id 				= $this->input->post('department_id');
				$course->course_name 				= $this->input->post('course_name');
				$course->course_abbrev 				= $this->input->post('course_abbrev');

				$course->save();
				$redirect_url = 'course/view';
				redirect($redirect_url);
			}
		}
		
	}
	#-------------------------------------------------------------------------------------------------#
	public function view() 
	{
		$this->load->model('department_model');
		$data['departments'] 					= $this->department_model->get();
		$data['courses'] 						= $this->course_model->get();

		$nav['crumbs'] = array(
			[
				'name' 			=> 'Home',
				'url'			=> site_url(),
				'is_active'		=> false
			],
			[
				'name' 			=> 'Course',
				'url'			=> site_url('course'),
				'is_active'		=> true
			]
		);

		$this->load->view('inc/header_view');
		$this->load->view('inc/breadcrumbs', $nav);
		$this->load->view('course/course_view', $data);
		$this->load->view('inc/footer_view');
	}
	#-------------------------------------------------------------------------------------------------#
}
