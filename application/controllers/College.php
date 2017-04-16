<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class College extends MY_Controller {

	public function __construct() 
	{
		parent::__construct();
		$this->load->model('college_model');
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
		$this->form_validation->set_rules('college_abbrev', 'College Abbreviation', 'trim|required|is_unique[college.college_abbrev]', ['is_unique' => '%s already exists!', 'required' => '%s cannot be empty.']);
		$this->form_validation->set_rules('college_name', 'College Name', 'trim|required[is_unique[college.college_name]', ['is_unique' => '%s already exist!', 'required' => '%s cannot be empty.']);

		$nav['crumbs'] = array(
			[
				'name' 			=> 'Home',
				'url'			=> site_url(),
				'is_active'		=> false
			],
			[
				'name' 			=> 'College',
				'url'			=> site_url('college'),
				'is_active'		=> false
			],
			[
				'name'			=> 'Add College',
				'url'			=> '',
				'is_active'		=> true
			]
		);


		if($this->form_validation->run() == FALSE)
		{
			$data['action_url'] = site_url('college/add');
			$data['back_url']	= site_url('college');
			
			$this->load->view('inc/header_view');
			$this->load->view('inc/breadcrumbs', $nav);
			$this->load->view('college/college_add', $data);
			$this->load->view('inc/footer_view');
		}
		else
		{	
			$college 						= new college_model();
			$college->college_name 			= $this->input->post('college_name');
			$college->college_abbrev 		= $this->input->post('college_abbrev');

			$college->save();

			$redirect_url = 'college/view';
			redirect($redirect_url);
		}
	}
	#-------------------------------------------------------------------------------------------------#
	/**
	 *
	 * @param int $college_id
	 * 
	*/
	public function update($college_id) 
	{	
		$this->load->library('form_validation');
		$data['college'] 					= $this->college_model->get($college_id);
		$data['action_url'] 				= site_url('college/update/') . $college_id;
		$data['back_url']					= site_url('college');

		$this->form_validation->set_rules('college_abbrev', 'College Abbreviation', 'trim|required', ['required' => '%s cannot be empty.']);
		$this->form_validation->set_rules('college_name', 'College Name', 'trim|required', ['required' => '%s cannot be empty.']);

		$nav['crumbs'] = array(
			[
				'name' 			=> 'Home',
				'url'			=> site_url(),
				'is_active'		=> false
			],
			[
				'name' 			=> 'College',
				'url'			=> site_url('college'),
				'is_active'		=> false
			],
			[
				'name'			=> 'Update [' . $data['college']['college_name'] . ']',
				'url'			=> '',
				'is_active'		=> true
			]
		);

		if(is_null($data['college']))
		{
			page404();
		}
		else
		{
			if($this->form_validation->run() == FALSE)
			{
				$this->load->view('inc/header_view');
				$this->load->view('inc/breadcrumbs', $nav);
				$this->load->view('college/college_update', $data);
				$this->load->view('inc/footer_view');
			}
			else
			{	
				$college 						= new college_model();
				$college->college_id			= $college_id;
				$college->college_name 			= $this->input->post('college_name');
				$college->college_abbrev 		= $this->input->post('college_abbrev');

				$college->save();

				$redirect_url 	= 'college/view';
				redirect($redirect_url);
			}
		}
		
	}
	#-------------------------------------------------------------------------------------------------#
	public function view() 
	{

		$data['colleges'] 					= $this->college_model->get();
		$data['add_url'] 					= site_url('college/add');
		$data['update_url'] 				= site_url('college/update/');

		$nav['crumbs'] = array(
			[
				'name' 			=> 'Home',
				'url'			=> site_url(),
				'is_active'		=> false
			],
			[
				'name' 			=> 'College',
				'url'			=> site_url('college'),
				'is_active'		=> true
			]
		);

		$this->load->view('inc/header_view');
		$this->load->view('inc/breadcrumbs', $nav);
		$this->load->view('college/college_view', $data);
		$this->load->view('inc/footer_view');
	}
	#-------------------------------------------------------------------------------------------------#
}
