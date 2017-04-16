<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subject extends MY_Controller {

	public function __construct() 
	{
		parent::__construct();
		$this->load->model('subject_model');
	}
	#-------------------------------------------------------------------------------------------------#
	public function index() 
	{
		$this->view();
	}
	#-------------------------------------------------------------------------------------------------#

	public function view()
	{
		$this->load->model('subject_model');

		$data['subjects'] = $this->subject_model->get();

		foreach($data['subjects'] as &$subject)
		{
			$sem_offered = $this->subject_model->get_semester_offered($subject['subject_id']);

			foreach($sem_offered as &$s)
				$s = SEMESTER[$s];

			$subject['semester_offered'] = implode(', ', $sem_offered);
		}

		$this->load->view('inc/header_view');
		$this->load->view('subject/subject_view', $data);
		$this->load->view('inc/footer_view');
	}

	/**
	 *
	 * @param int $curriculum
	 * @return void
	 * Add a subject on a curriculum.
	*/
	public function add($curriculum_id) 
	{
		$this->load->library('form_validation');
		$this->load->model('curriculum_model');

		$this->form_validation->set_rules('course_code', 'Course Code', 'trim|required', ['required' => '%s cannot be empty.']);
		$this->form_validation->set_rules('descriptive_title', 'Descriptive Title', 'trim|required', ['required' => '%s cannot be empty.']);
		$this->form_validation->set_rules('credit_units', 'Credit Units', 'trim|required|numeric|greater_than_equal_to[0]', ['required' => '%s cannot be empty.', 'numeric' => '%s should be a valid number.']);
		$this->form_validation->set_rules('subject_year', 'Subject Year', 'trim|required|numeric');
		$this->form_validation->set_rules('semester_offered', 'Semester Offered', 'trim|required|numeric');
		$this->form_validation->set_rules('prerequisite[]', 'Pre-requisite', 'required', ['required' => 'You must choose a %s.']);

		$data['all_subjects']			= $this->subject_model->get();
		$data['curriculum'] 			= $this->curriculum_model->get($curriculum_id);
		$data['curriculum_subjects'] 	= $this->curriculum_model->get_curriculum_subjects($curriculum_id, 'subjects.course_code');
		$data['action_url'] 			= site_url('subject/add/') . $curriculum_id;
		$data['back_url'] 				= site_url("curriculum/view/subjects/{$curriculum_id}");

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
				'name'			=> 'Add Subject to Curriculum',
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
				$this->load->view('subject/subject_add', $data);
				$this->load->view('inc/footer_view');
			}
			else
			{

				$prerequisites = array('None');
				if(is_string($this->input->post('prerequisite[]')) && !empty($this->input->post('prerequisite[]')))
				{

					$prerequisites = explode(',', $this->input->post('prerequisite[]'));
					foreach($prerequisites as &$subject_prerequisite)
					{
						$subject = $this->subject_model->get_by(['course_code' => $subject_prerequisite]);
						if(!is_null($subject))
							$subject_prerequisite = $subject['subject_id'];
					}
				}

				$subject = new subject_model();

				$subject->course_curriculum_id 				= $curriculum_id;
				$subject->course_code 						= $this->input->post('course_code');
				$subject->descriptive_title 				= $this->input->post('descriptive_title');
				$subject->credit_units 						= $this->input->post('credit_units');
				$subject->subject_year 						= $this->input->post('subject_year');
				$subject->semester_offered 					= $this->input->post('semester_offered');
				$subject->prerequisite 						= $this->input->post('prerequisite');
				$subject->date_added						= date('Y-m-d H:i:s');

				if(!empty($subject->prerequisite))
					$subject->prerequisite 					= serialize($subject->prerequisite);
				else
					$subject->prerequisite 					= serialize(array('None'));

				$subject->save();

				$redirect_url = site_url("curriculum/view/subjects/{$curriculum_id}");
				redirect($redirect_url);
			}
		}
	}
	#-------------------------------------------------------------------------------------------------#
	/**
	 *
	 * @param int $curriculum_id
	 * @param int $subject_id
	 * @return void
	 * Update subject details in a curriculum.
	*/
	public function update($curriculum_id, $subject_id) 
	{
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('course_code', 'Course Code', 'trim|required');
		$this->form_validation->set_rules('descriptive_title', 'Descriptive Title', 'trim|required');
		$this->form_validation->set_rules('credit_units', 'Credit Units', 'trim|required|numeric|greater_than_equal_to[0]');
		$this->form_validation->set_rules('subject_year', 'Subject Year', 'trim|required|numeric');
		$this->form_validation->set_rules('semester_offered', 'Semester Offered', 'trim|required|numeric');
		$this->form_validation->set_rules('prerequisite[]', 'Pre-requisite', 'trim|required');

		$this->load->model('curriculum_model');

		$data['subject'] 			 = $this->subject_model->get_subject_data($curriculum_id, $subject_id);
		$data['curriculum_subjects'] = $this->curriculum_model->get_curriculum_subjects($curriculum_id, 'subjects.course_code');
		$data['action_url'] 		 = site_url('subject/update/') . $curriculum_id . "/" . $subject_id;
		$data['back_url'] 			 = site_url("curriculum/view/subjects/{$curriculum_id}");

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
				'name'			=> 'Update Subject in this Curriculum',
				'url'			=> '',
				'is_active'		=> true
			]
		);

		if(is_null($data['subject']))
		{
			page404(site_url('curriculum'));
		}
		else
		{
			$prereqs 				 = unserialize($data['subject']['prerequisite']);
			foreach($prereqs as &$prereq)
			{
				if($prereq == 'None')
					break;
				if($this->subject_model->is_standing_prerequisite($prereq))
					break;
				
				$subject_data = $this->subject_model->get($prereq);
				$prereq = $subject_data['course_code'];
			}

			$data['subject']['prerequisite'] = serialize($prereqs);

			if($this->form_validation->run() == FALSE)
			{
				$this->load->view('inc/header_view');
				$this->load->view('inc/breadcrumbs', $nav);
				$this->load->view('subject/subject_update', $data);
				$this->load->view('inc/footer_view');
			}
			else
			{

				$prerequisites = array('None');
				if(!empty($this->input->post('prerequisite[]')))
				{

					$prerequisites = $this->input->post('prerequisite[]');
					foreach($prerequisites as &$subject_prerequisite)
					{
						$subject = $this->subject_model->get_by(['course_code' => $subject_prerequisite]);
						if(!is_null($subject))
							$subject_prerequisite = $subject['subject_id'];
					}
				}

				$subject = new subject_model();
				$subject->subject_id 							= $subject_id;
				$subject->course_curriculum_id 					= $curriculum_id;
				$subject->course_code 							= $this->input->post('course_code');
				$subject->descriptive_title 					= $this->input->post('descriptive_title');
				$subject->credit_units 							= $this->input->post('credit_units');
				$subject->subject_year 							= $this->input->post('subject_year');
				$subject->semester_offered 						= $this->input->post('semester_offered');
				$subject->prerequisite 							= serialize($prerequisites);
				$subject->save();

				$redirect_url = 'curriculum/view/subjects/' . $curriculum_id;
				redirect($redirect_url);
			}
		}
	}
	#-------------------------------------------------------------------------------------------------#
}
