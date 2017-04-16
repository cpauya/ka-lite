<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Curriculum extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('curriculum_model');
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
		$this->form_validation->set_rules('course_id', 'Course', 'trim|required|numeric');
		$this->form_validation->set_rules('curriculum_description', 'Curriculum Description', 'trim|required', ['required' => '%s cannot be empty.']);
		$this->form_validation->set_rules('curriculum_year', 'Curriculum Year', 'trim|required|numeric', ['required' => '%s cannot be empty.', 'numeric' => '%s must be a valid year!']);

		$nav['crumbs'] = array(
			[
				'name' 			=> 'Home',
				'url'			=> site_url(),
				'is_active'		=> false
			],
			[
				'name' 			=> 'Curriculum',
				'url'			=> site_url('curriculum'),
				'is_active'		=> false
			],
			[
				'name'			=> 'New Curriculum',
				'url'			=> '',
				'is_active'		=> true
			]
		);

		$curriculum_exists = $this->curriculum_model->curriculum_exists($this->input->post('curriculum_description'), $this->input->post('curriculum_year'));

		if($curriculum_exists)
				$data['error_message'][] = 'Curriculum already exists!';

		if($this->form_validation->run() == FALSE || $curriculum_exists)
		{
			$this->load->model('course_model');
			$data['courses'] = $this->course_model->get();
			$data['action_url'] = site_url('curriculum/add');
			$data['back_url']	= site_url('curriculum');

			

			$this->load->view('inc/header_view');
			$this->load->view('inc/breadcrumbs', $nav);
			$this->load->view('curriculum/curriculum_add', $data);
			$this->load->view('inc/footer_view');
		}
		else
		{	
			$curriculum = new curriculum_model();
			$curriculum->course_id 						= $this->input->post('course_id');
			$curriculum->curriculum_description 		= $this->input->post('curriculum_description');
			$curriculum->curriculum_year 				= $this->input->post('curriculum_year');

			$curriculum->save();

			$redirect_url = site_url('curriculum/view');
			redirect($redirect_url);
		}
	}
	#-------------------------------------------------------------------------------------------------#
	/**
	 *
	 * @param int $curriculum_id
	 * @return void
	*/
	public function update($curriculum_id)
	{
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('course_id', 'Course', 'trim|required');
		$this->form_validation->set_rules('curriculum_description', 'Curriculum Description', 'trim|required', ['required' => '%s cannot be empty.']);
		$this->form_validation->set_rules('curriculum_year', 'Curriculum Year', 'trim|required|numeric', ['required' => '%s cannot be empty.', 'numeric' => '%s must be a valid year!']);
		
		$this->load->model('course_model');

		$data['courses'] 		= $this->course_model->get();
		$data['curriculum'] 	= $this->curriculum_model->get($curriculum_id);
		$data['action_url'] 	= site_url('curriculum/update/') . $curriculum_id;
		$data['back_url']		= site_url('curriculum');

		$nav['crumbs'] = array(
			[
				'name' 			=> 'Home',
				'url'			=> site_url(),
				'is_active'		=> false
			],
			[
				'name' 			=> 'Curriculum',
				'url'			=> site_url('curriculum'),
				'is_active'		=> false
			],
			[
				'name'			=> 'Update [' . $data['curriculum']['curriculum_description'] . ' - ' . $data['curriculum']['curriculum_year'] . ']',
				'url'			=> '',
				'is_active'		=> true
			]
		);
		
		if(is_null($data['curriculum']))
		{
			page404();
		}
		else
		{
			if($this->form_validation->run() == FALSE)
			{
				$this->load->view('inc/header_view');
				$this->load->view('inc/breadcrumbs', $nav);
				$this->load->view('curriculum/curriculum_update', $data);
				$this->load->view('inc/footer_view');
			}
			else
			{	
				$curriculum = new curriculum_model();
				$curriculum->course_curriculum_id 			= $curriculum_id;
				$curriculum->course_id 						= $this->input->post('course_id');
				$curriculum->curriculum_description 		= $this->input->post('curriculum_description');
				$curriculum->curriculum_year 				= $this->input->post('curriculum_year');

				$curriculum->save();
				$redirect_url = 'curriculum/view';
				redirect($redirect_url);
			}
		}
	}
	#-------------------------------------------------------------------------------------------------#
	/**
	 *
	 * @param str $what
	 * @param int $course_curriculum_id
	 * @return void
	*/
	public function view($what = '', $course_curriculum_id = null)
	{

		$this->load->model('subject_model');
		$this->load->model('course_model');

		if($what == 'subjects' && !is_null($course_curriculum_id))
		{
			$this->load->model('curriculum_model');

			$data['subjects'] 						= $this->curriculum_model->get_curriculum_subjects($course_curriculum_id);
			$data['update_url'] 					= site_url('subject/update/');
			$data['add_subject_url'] 				= site_url('subject/add/');
			$data['user_type']						= $this->session->user_type;

			$curriculum_name = $data['subjects'][0]['curriculum_description'] . " - " . $data['subjects'][0]['curriculum_year'];

			if(is_null($data['subjects']))
			{
				page404(site_url('curriculum'));
			}
			else
			{
				foreach($data['subjects'] as &$subject)
				{
					$prerequisites = unserialize($subject['prerequisite']);

					if(!empty($prerequisites))
					{
						foreach($prerequisites as &$prereq)
						{
							$subject_data = $this->subject_model->get_by(['subject_id' => $prereq]);

							if(!is_null($subject_data))
							{
								$prereq = $subject_data['course_code'];
							}

							if($this->subject_model->is_standing_prerequisite($prereq))
							{
								$prereq = STANDINGS[$prereq];
							}
						}
					}
					
					$subject['prerequisite'] = serialize($prerequisites);
				}

				$nav['crumbs'] = array(
					[
						'name' 		=> 'Home', 
						'url' 		=> site_url(), 
						'is_active' => false
					],
					[
						'name' 		=> 'Curriculum', 
						'url'		=> site_url('curriculum'), 
						'is_active' => false
					],
					[
						'name' 		=> $curriculum_name,
						'url' 		=> '', 
						'is_active' => true
					]
				);

				$this->load->view('inc/header_view');
				$this->load->view('inc/breadcrumbs', $nav);
				$this->load->view('curriculum/curriculum_view_subjects', $data);
				$this->load->view('inc/footer_view');
			}
		}
		else
		{
			$data['courses'] 				= $this->course_model->get();
			$data['curriculums'] 			= $this->curriculum_model->get();
			$data['add_url']				= site_url('curriculum/add');
			$data['update_url']				= site_url('curriculum/update/');
			$data['manage_subjects_url']	= site_url('curriculum/view/subjects/');

			$nav['crumbs'] = array(
				[
					'name' 		=> 'Home', 
					'url' 		=> site_url(), 
					'is_active' => false
				],
				[
					'name' 		=> 'Curriculum', 
					'url'		=> '',
					'is_active' => true
				]
			);

			$this->load->view('inc/header_view');
			$this->load->view('inc/breadcrumbs', $nav);
			$this->load->view('curriculum/curriculum_view', $data);
			$this->load->view('inc/footer_view');
		}
	}
	#-------------------------------------------------------------------------------------------------#
	/**
	 * Gets curriculum through ajax request.
	 * @return void
	*/
	public function get_curriculum()
	{
		$course_id 		= $this->input->post('course_id');
		$curriculums 	= $this->curriculum_model->get_by(['course_id' => $course_id], true);

		$input_select = "<select id='inputCourseCurriculum' class='form-control' name='course_curriculum_id'>";

		if(!empty($curriculums))
		{
			foreach($curriculums as $curriculum)
			{
				$curriculum_id = $curriculum['course_curriculum_id'];
				$input_select .= "<option value='{$curriculum_id}'>{$curriculum['curriculum_description']} - {$curriculum['curriculum_year']}</option>";
			}
		}
		else
		{
			$input_select .= "<option value=''>Select Curriculum</option>";
		}
		

		
		$input_select .= "</select>";

		$data['select'] = $input_select;

		$this->output->set_content_type('application_json');
		$this->output->set_output(json_encode($data));
	}
	#-------------------------------------------------------------------------------------------------#
}
