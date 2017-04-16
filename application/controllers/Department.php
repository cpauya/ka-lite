<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Department extends MY_Controller {

	public function __construct() 
	{
		parent::__construct();
		$this->load->model('department_model');
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
		$this->form_validation->set_rules('college_id', 'College', 'required|numeric', ['required' => '%s cannot be empty.']);
		$this->form_validation->set_rules('department_name', 'Department Name', 'trim|required|is_unique[department.department_name]', ['required' => '%s cannot be empty.', 'is_unique' => '%s already exists!']);

		$this->load->model('college_model');
		$data['colleges'] 			= $this->college_model->get();
		$data['action_url'] 		= site_url('department/add');
		$data['back_url']			= site_url('department');

		$nav['crumbs'] = array(
			[
				'name' 			=> 'Home',
				'url'			=> site_url(),
				'is_active'		=> false
			],
			[
				'name' 			=> 'Department',
				'url'			=> site_url('department'),
				'is_active'		=> false
			],
			[
				'name'			=> 'Add Department',
				'url'			=> '',
				'is_active'		=> true
			]
		);

		if($this->form_validation->run() == FALSE)
		{
			$this->load->view('inc/header_view');
			$this->load->view('inc/breadcrumbs', $nav);
			$this->load->view('department/department_add', $data);
			$this->load->view('inc/footer_view');
		}
		else
		{
			$department = new department_model();

			$department->college_id 		= $this->input->post('college_id');
			$department->department_name 	= $this->input->post('department_name');

			$department->save();
			$redirect_url = 'department/view';
			redirect($redirect_url);
		}
	}
	#-------------------------------------------------------------------------------------------------#
	/**
	 *
	 * @param int $department_id
	 * @return void
	*/
	public function update($department_id) 
	{
		$this->load->library('form_validation');
		$this->load->model('college_model');

		$this->form_validation->set_rules('college_id', 'College', 'required|numeric');
		$this->form_validation->set_rules('department_name', 'Department Name', 'trim|required', ['required' => '%s cannot be empty.']);

		$data['colleges'] 		= $this->college_model->get();
		$data['department'] 	= $this->department_model->get($department_id);
		$data['action_url'] 	= site_url('department/update/') . $department_id;
		$data['back_url']		= site_url('department');

		$nav['crumbs'] = array(
			[
				'name' 			=> 'Home',
				'url'			=> site_url(),
				'is_active'		=> false
			],
			[
				'name' 			=> 'Department',
				'url'			=> site_url('department'),
				'is_active'		=> false
			],
			[
				'name'			=> 'Update [' . $data['department']['department_name'] . ']',
				'url'			=> '',
				'is_active'		=> true
			]
		);

		if(is_null($data['department']))
		{
			page404();
		}	
		else
		{
			if($this->form_validation->run() == FALSE)
			{
				$this->load->view('inc/header_view');
				$this->load->view('inc/breadcrumbs', $nav);
				$this->load->view('department/department_update', $data);
				$this->load->view('inc/footer_view');
			}
			else
			{
				$department = new department_model();

				$department->department_id 				= $department_id;
				$department->college_id 				= $this->input->post('college_id');
				$department->department_name 			= $this->input->post('department_name');

				$department->save();
				$redirect_url = 'department/view';
				redirect($redirect_url);
			}
		}
	}
	#-------------------------------------------------------------------------------------------------#
	public function view() 
	{
		$this->load->model('college_model');

		$data['departments'] 			= $this->department_model->get();
		$data['colleges'] 				= $this->college_model->get();
		$data['update_url'] 			= site_url('department/update/');
		$data['add_url'] 				= site_url('department/add');

		$nav['crumbs'] = array(
			[
				'name' 			=> 'Home',
				'url'			=> site_url(),
				'is_active'		=> false
			],
			[
				'name' 			=> 'Department',
				'url'			=> site_url('department'),
				'is_active'		=> true
			]
		);

		$this->load->view('inc/header_view');
		$this->load->view('inc/breadcrumbs', $nav);
		$this->load->view('department/department_view', $data);
		$this->load->view('inc/footer_view');
	}
	#-------------------------------------------------------------------------------------------------#
}
