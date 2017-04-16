<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends MY_Controller {

	public function __construct() 
	{
		parent::__construct();
		$this->load->model('student_model');
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

		$this->form_validation->set_rules('student_id', 'Student ID', 'trim|required|numeric|is_unique[student.student_id]', ['required' => '%s cannot be empty.', 'is_unique' => '%s already exists!']);
		$this->form_validation->set_rules('course_id', 'Course', 'trim|required|is_numeric');
		$this->form_validation->set_rules('course_curriculum_id', 'Curriculum', 'trim|required|is_numeric');
		$this->form_validation->set_rules('student_firstname', 'First Name', 'trim|required', ['required' => '%s cannot be empty.']);
		$this->form_validation->set_rules('student_middlename', 'Middle Name', 'trim|required', ['required' => '%s cannot be empty.']);
		$this->form_validation->set_rules('student_lastname', 'Last Name', 'trim|required', ['required' => '%s cannot be empty.']);

		$this->load->model('course_model');

		$data['courses'] 			= $this->course_model->get();
		$data['action_url'] 		= site_url('student/add');

		$nav['crumbs'] = array(
			[
				'name' 			=> 'Home',
				'url'			=> site_url(),
				'is_active'		=> false
			],
			[
				'name' 			=> 'Student',
				'url'			=> site_url('student'),
				'is_active'		=> false
			],
			[
				'name'			=> 'Add Student',
				'url'			=> '',
				'is_active'		=> true
			]
		);

		if($this->form_validation->run() == FALSE)
		{
			$this->load->view('inc/header_view');
			$this->load->view('inc/breadcrumbs', $nav);
			$this->load->view('student/student_add', $data);
			$this->load->view('inc/footer_view');
		}
		else
		{	
			$student = new student_model();
			$student->student_id 				= $this->input->post('student_id');
			$student->course_id					= $this->input->post('course_id');
			$student->course_curriculum_id		= $this->input->post('course_curriculum_id');
			$student->student_firstname 		= $this->input->post('student_firstname');
			$student->student_middlename 		= $this->input->post('student_middlename');
			$student->student_lastname 			= $this->input->post('student_lastname');

			$student->save();

			$redirect_url = 'student/view';
			redirect($redirect_url);
		}
	}
	#-------------------------------------------------------------------------------------------------#
	/**
	 *
	 * @param int $student_id
	 * @return void
	*/
	public function update($student_id) 
	{

		$this->load->library('form_validation');

		$this->form_validation->set_rules('student_id', 'Student ID', 'trim|required|numeric', ['required' => '%s cannot be empty.']);
		$this->form_validation->set_rules('course_id', 'Course', 'trim|required|is_numeric');
		$this->form_validation->set_rules('course_curriculum_id', 'Curriculum', 'trim|required|is_numeric');
		$this->form_validation->set_rules('student_firstname', 'First Name', 'trim|required', ['required' => '%s cannot be empty.']);
		$this->form_validation->set_rules('student_middlename', 'Middle Name', 'trim|required', ['required' => '%s cannot be empty.']);
		$this->form_validation->set_rules('student_lastname', 'Last Name', 'trim|required', ['required' => '%s cannot be empty.']);

		$this->load->model('course_model');

		$data['student'] 			= $this->student_model->get($student_id);
		$data['courses'] 			= $this->course_model->get();
		$data['action_url'] 		= site_url('student/update/') . $student_id;
		$data['back_url']			= site_url('student/view');

		$nav['crumbs'] = array(
			[
				'name' 			=> 'Home',
				'url'			=> site_url(),
				'is_active'		=> false
			],
			[
				'name' 			=> 'Student',
				'url'			=> site_url('student'),
				'is_active'		=> false
			],
			[
				'name'			=> 'Update [' . $data['student']['student_id'] . ' : ' . $data['student']['student_lastname'] . ', ' . $data['student']['student_firstname'] . ' ' . $data['student']['student_middlename'] . ']',
				'url'			=> '',
				'is_active'		=> true
			]
		);

		if(is_null($data['student']))
		{
			page404(site_url('student'));
		}
		else
		{
			if($this->form_validation->run() == FALSE)
			{
				$this->load->view('inc/header_view');
				$this->load->view('inc/breadcrumbs', $nav);
				$this->load->view('student/student_update', $data);
				$this->load->view('inc/footer_view');
			}
			else
			{	
				$student = new student_model();
				$student->student_id 				= $student_id;
				$student->course_id					= $this->input->post('course_id');
				$student->course_curriculum_id		= $this->input->post('course_curriculum_id');
				$student->student_firstname 		= $this->input->post('student_firstname');
				$student->student_middlename 		= $this->input->post('student_middlename');
				$student->student_lastname 			= $this->input->post('student_lastname');

				$student->save();
				$redirect_url = 'student/view';
				redirect($redirect_url);
			}
		}
	}
	#-------------------------------------------------------------------------------------------------#
	/**
	 *
	 * @param str $what
	 * @param int $student_id
	*/
	public function view($what = null, $student_id = null) 
	{

		if($what == 'curriculum' && $student_id)
		{
			if(!$this->student_model->student_exists($student_id))
			{
				page404();
			}
			else
			{	
				$this->__view_curriculum($student_id);	
			}
			
		}
		elseif($what == 'mycurriculum')
		{
			$student_id = $this->session->username;
			if(!$this->student_model->student_exists($student_id))
			{
				page404();
			}
			else
			{
				$this->__view_curriculum($student_id);
			}
			
		}
		elseif($what == 'enrolled' && $student_id)
		{
			if(!$this->student_model->student_exists($student_id))
			{
				page404();
			}
			else
			{
				$this->__view_currently_enrolled_subjects($student_id);
			}
			
		}
		else
		{
			$this->load->model('course_model');
			$this->load->library('pagination');

			$data['courses'] 				= $this->course_model->get();
			$data['students'] 				= $this->student_model->get_all_students();
			$data['update_url']				= site_url('student/update/');
			$data['add_url']				= site_url('student/add');

			$config['base_url'] 			= base_url() . '/student/view/';
			$config['total_rows'] 			= count($data['students']);
			$config['per_page'] 			= 30;
			$config['full_tag_open'] 		= "<ul class='pagination'>";
			$config['full_tag_close'] 		= "</ul>";
			$config['num_tag_open'] 		= "<li>";
			$config['num_tag_close'] 		= "</li>";
			$config['cur_tag_open'] 		= "<li class='active'><a onlick='javacsript:void(0)'>";
			$config['cur_tag_close'] 		= "</a></li>";
			$config['next_tag_open'] 		= "<li>";
			$config['next_tag_close'] 		= "</li>";
			$config['prev_tag_open'] 		= "<li>";
			$config['prev_tag_close'] 		= "</li>";
			$config['first_tag_open'] 		= "<li>";
			$config['first_tag_close'] 		= "</li>";
			$config['last_tag_open'] 		= "<li>";
			$config['last_tag_close'] 		= "</li>";
			$config['num_links'] 			= 4;

			$this->pagination->initialize($config);

			$data['students'] = $this->student_model->get_all_students($config['per_page'], $this->uri->segment(3));

			$nav['crumbs'] = array(
				[
					'name' 			=> 'Home',
					'url'			=> site_url(),
					'is_active'		=> false
				],
				[
					'name' 			=> 'Students',
					'url'			=> site_url('student'),
					'is_active'		=> true
				]
			);

			$this->load->view('inc/header_view');
			$this->load->view('inc/breadcrumbs', $nav);
			$this->load->view('student/student_view', $data);
			$this->load->view('inc/footer_view');
		}
	}
	#-------------------------------------------------------------------------------------------------#
		/**
	 *
	 * @param int $student_id
	 *
	*/
	private function __view_curriculum($student_id)
	{

		$this->load->model('student_subject_model');
		$this->load->model('subject_model');

		$student_id = (is_admin()) ? $student_id : get_curr_user()['username'];

		$data['subjects'] 			= $this->student_model->get_student_curriculum($student_id);
		$data['student']			= $this->student_model->get($student_id);
		$data['total_units_earned'] = $this->student_subject_model->get_student_total_units($student_id);
		$data['total_units']		= $this->curriculum_model->get_total_units_per_year($data['student']['course_curriculum_id']);

		$total_units = 0;

		foreach($data['total_units'] as $key => $value)
		{
			$total_units += $value['total_units'];
		}

		$data['student_year']		= STANDINGS[$this->student_model->get_student_standing($student_id)];
		$data['total_units'] 		= $total_units;
		$data['percentage'] 		= ($total_units > 0) ? sprintf("%0.2f", ($data['total_units_earned'] / $total_units) * 100) : 0;
		$data['user_type']			= $this->session->user_type;


		foreach($data['subjects'] as &$subject)
		{
			if(!unserialize($subject['prerequisite']))
				break;

			$prerequisites = unserialize($subject['prerequisite']);
			foreach($prerequisites as &$prerequisite)
			{
				if($prerequisite == 'None')
					break;

				if($this->subject_model->is_standing_prerequisite($prerequisite))
				{
					$prerequisite = STANDINGS[$prerequisite];
					break;
				}
					
				$subject_data 				= $this->subject_model->get_by(['subject_id' => $prerequisite]);
				$prerequisite 				= $subject_data['course_code'];
			}

			$subject['prerequisite'] 		= serialize($prerequisites);
			$subject['student_can_get'] 	= $this->subject_model->student_can_get_subject($student_id, $subject['course_curriculum_id'], $subject['subject_id']);

			$subject_remarks 				= $this->student_subject_model->get_student_remarks($student_id, $subject['subject_id']);
			
			$subject['subject_remarks'] = $subject_remarks;
		}

		# equivalent to = student/update_remarks/130365/1/;
		$data['update_url'] = site_url("student/update_remarks/{$student_id}/{$data['subjects'][0]['course_curriculum_id']}");
		$other_subjects['subjects'] = $this->student_subject_model->get_other_subjects_taken($student_id);

		if(is_admin())
		{
			$nav['crumbs'] = array(
				[
					'name' 			=> 'Home',
					'url'			=> site_url(),
					'is_active'		=> false
				],
				[
					'name' 			=> 'Students',
					'url'			=> site_url('student'),
					'is_active'		=> false
				],
				[
					'name' 			=> $data['student']['student_id'] . ' : ' . $data['student']['student_lastname'] . ', ' . $data['student']['student_firstname'] . ' ' . $data['student']['student_middlename'] . ' [' . $data['student_year'] . ']',
					'url'			=> '',
					'is_active'		=> true
				]
			);
		}
		elseif(is_student())
		{
			$nav['crumbs'] = array(
				[
					'name' 			=> 'Home',
					'url'			=> site_url(),
					'is_active'		=> false
				],
				[
					'name' 			=> 'My Curriculum',
					'url'			=> '',
					'is_active'		=> true
				]
			);
		}

		$this->load->view('inc/header_view');
		$this->load->view('inc/breadcrumbs', $nav);
		$this->load->view('student/student_view_curriculum', $data);;
		$this->load->view('student/student_other_subjects_taken', $other_subjects);
		$this->load->view('inc/footer_view');
	}
	#-------------------------------------------------------------------------------------------------#

	private function __view_currently_enrolled_subjects($student_id)
	{
		$this->load->model('student_subject_model');
		$this->load->model('subject_model');

		$student_id = (is_admin()) ? $student_id : get_curr_user()['username'];

		$data['subjects'] 			= $this->student_model->get_student_curriculum($student_id, ['student_subjects.currently_enrolled' => true]);
		$data['student']			= $this->student_model->get($student_id);

		foreach($data['subjects'] as &$subject)
		{
			$prerequisites = unserialize($subject['prerequisite']);
			foreach($prerequisites as &$prerequisite)
			{
				if($prerequisite == 'None')
					break;

				if($this->subject_model->is_standing_prerequisite($prerequisite))
				{
					$prerequisite = STANDINGS[$prerequisite];
					break;
				}

				$subject_data 				= $this->subject_model->get_by(['subject_id' => $prerequisite]);
				$prerequisite 				= $subject_data['course_code'];
			}

			$subject['prerequisite'] 		= serialize($prerequisites);
		}

		if(is_admin())
		{
			$nav['crumbs'] = array(
				[
				'name' 			=> 'Home',
				'url'			=> site_url(),
				'is_active'		=> false
				],
				[
				'name' 			=> 'Students',
				'url'			=> site_url('Student'),
				'is_active'		=> false
				],
				[
				'name' 			=> $data['student']['student_id'] . ' : ' . $data['student']['student_lastname'] . ', ' . $data['student']['student_firstname'] . ' ' . $data['student']['student_middlename'],
				'url'			=> site_url('student/view/curriculum/') . $data['student']['student_id'],
				'is_active'		=> false
				],
				[
				'name'			=> 'Currently Enrolled Subjects',
				'url'			=> '#',
				'is_active'		=> true
				]

				);
		}
		elseif(is_student())
		{
			$nav['crumbs'] = array(
				[
				'name' 			=> 'Home',
				'url'			=> site_url(),
				'is_active'		=> false
				],
				[
				'name' 			=> 'My Curriculum',
				'url'			=> site_url('student/view/mycurriculum'),
				'is_active'		=> false,
				],
				[
				'name'			=> 'My Enrolled Subjects',
				'url'			=> '',
				'is_active'		=> true
				]
				);
		}

		$this->load->view('inc/header_view');
		$this->load->view('inc/breadcrumbs', $nav);
		$this->load->view('student/student_view_enrolled', $data);
		$this->load->view('inc/footer_view');
	}
	#-------------------------------------------------------------------------------------------------#
	public function search()
	{
		$this->load->library('pagination');
		$this->load->model('course_model');

		$search = ($this->input->post('search')) ? $this->input->post('search') : null;
		$search = ($this->uri->segment(3)) ? $this->uri->segment(3) : $search;

		$config['base_url'] 			= site_url("student/search/$search");
		$config['total_rows'] 			= $this->student_model->get_total_students($search);
		$config['per_page'] 			= 30;
		$config['full_tag_open'] 		= "<ul class='pagination'>";
		$config['full_tag_close'] 		= "</ul>";
		$config['num_tag_open'] 		= "<li>";
		$config['num_tag_close'] 		= "</li>";
		$config['cur_tag_open'] 		= "<li class='active'><a onlick='javacsript:void(0)'>";
		$config['cur_tag_close'] 		= "</a></li>";
		$config['next_tag_open'] 		= "<li>";
		$config['next_tag_close'] 		= "</li>";
		$config['prev_tag_open'] 		= "<li>";
		$config['prev_tag_close'] 		= "</li>";
		$config['first_tag_open'] 		= "<li>";
		$config['first_tag_close'] 		= "</li>";
		$config['last_tag_open'] 		= "<li>";
		$config['last_tag_close'] 		= "</li>";
		$config['num_links'] 			= 4;

		$offset = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0; 

		$this->pagination->initialize($config);

		$data['students'] = $this->student_model->search($search, $config['per_page'], $offset);
		$data['courses'] = $this->course_model->get();
		$data['update_url']			= site_url('student/update/');
		$data['add_url']			= site_url('student/add');


		$nav['crumbs'] = array(
			[
			'name' 			=> 'Home',
			'url'			=> site_url(),
			'is_active'		=> false
			],
			[
			'name' 			=> 'Students',
			'url'			=> site_url('student'),
			'is_active'		=> false
			],
			[
				'name'		=> 'Search result(s) for: '. $search,
				'url'		=> '',
				'is_active' => true
			]
			);

		$this->load->view('inc/header_view');
		$this->load->view('inc/breadcrumbs', $nav);
		$this->load->view('student/student_view', $data);
		$this->load->view('inc/footer_view');
	}
	#-------------------------------------------------------------------------------------------------#
	/**
	 * 
	 * @return void
	 * Ajax call for viewing remarks
	*/
	public function view_remarks()
	{
		$this->load->model('student_subject_model');
		$student_id = $this->input->post('student_id');
		$subject_id = $this->input->post('subject_id');

		$remarks = $this->student_subject_model->get_student_remarks($student_id, $subject_id);

		$table = "<table class='table table-hover table-striped'>";
		$table .= "<tr class='success'>";
		$table .= "<td>Date Added</td>";
		$table .= "<td>Remarks</td>";
		$table .= "</tr>";

		if($remarks = unserialize($remarks))
		{
			foreach($remarks as $remark)
			{
				$table .= "<tr>";
				$table .= "<td>{$remark['date_added']}</td>";
				$table .= "<td>{$remark['subject_remarks']}</td>";
				$table .= "</tr>";
			}
		}
		else
		{
			$table .= "<td colspan='2'>Unavailable</td>";
		}

		$table .= "</table>";

		$result['data'] = $table;

		$this->output->set_content_type('application_json');
		$this->output->set_output(json_encode($result));

	}
	#-------------------------------------------------------------------------------------------------#
	/**
	 *
	 * @param int $student_id
	 * 
	 * @return void
	 * Print student's program of study.
	*/
	public function print_pos($student_id = null)
	{


		$student_id = is_student() ? get_curr_user('username') : $student_id;

		$this->load->model('student_subject_model');
		$this->load->model('subject_model');

		$data['subjects'] 			= $this->student_model->get_student_curriculum($student_id);
		$data['student']			= $this->student_model->get($student_id);
		
		foreach($data['subjects'] as &$subject)
		{

			if(!unserialize($subject['prerequisite']))
				break;

			$prerequisites = unserialize($subject['prerequisite']);

			foreach($prerequisites as &$prerequisite)
			{
				if($prerequisite == 'None')
					break;

				if($this->subject_model->is_standing_prerequisite($prerequisite))
				{
					$prerequisite = STANDINGS[$prerequisite];
					break;
				}

				$subject_data 				= $this->subject_model->get_by(['subject_id' => $prerequisite]);
				$prerequisite 				= $subject_data['course_code'];
			}

			$subject['prerequisite'] 		= serialize($prerequisites);

			$subject_remarks 				= $this->student_subject_model->get_student_remarks($student_id, $subject['subject_id']);
			$subject['student_can_get'] 	= $this->subject_model->student_can_get_subject($student_id, $subject['course_curriculum_id'], $subject['subject_id']);
			$subject['student_passed'] 		= ($subject_remarks) ? $this->subject_model->remarks_passed($subject_remarks) : false;
		}

		# equivalent to = student/update_remarks/130365/1/;
		
		$this->load->view('inc/header_view');
		$this->load->view('student/student_print_program_of_study', $data);;
		$this->load->view('inc/footer_view');
	}

	#-------------------------------------------------------------------------------------------------#
	/**
	 *
	 * @return void
	 * Enroll student to a subject through AJAX request.
	*/
	public function student_enroll()
	{
		$student_id 		= $this->input->post('student_id');
		$subjects_to_enroll = $this->input->post('enroll_subjects[]');

		foreach($subjects_to_enroll as $subject_id)
		{
			$data_found = $this->db->select('*')
				->from('student_subjects')
				->where('student_id', $student_id)
				->where('subject_id', $subject_id)
				->get()
				->num_rows();

			if($data_found)
			{
				$this->db->update('student_subjects',
					[
						'currently_enrolled' => true
					],
					[
						'student_id' => $student_id,
						'subject_id' => $subject_id
					]
				);
			}
			else
			{
				$this->db->insert('student_subjects', [
					'student_id' => $student_id,
					'subject_id' => $subject_id,
					'currently_enrolled' => true
				]);
			}
		}

		$result = ['success' => 0];

		if($this->db->affected_rows() > 0)
			$result = ['success' => 1];
		if($result['success'])
			$this->session->set_flashdata('message', 'Successfully enrolled.');
		else
			$this->session->set_flashdata('message', 'An error occured while enrolling.');
		
		$this->output->set_content_type('application_json');
		$this->output->set_output(json_encode($result));
	}
	#-------------------------------------------------------------------------------------------------#
	/**
	 * @return void
	 * 
	 * Set student's remarks through AJAX request
	*/
	public function set_remarks()
	{
		$this->load->model('student_subject_model');

		$enrolled_subjects 			= $this->input->post('enrolled_subjects[]');
		$set_remarks 				= $this->input->post('set_remarks');
		$student_id 				= $this->input->post('student_id');

		foreach($enrolled_subjects as $subject_id)
		{
			$previous_remarks		= $this->student_subject_model->get_student_remarks($student_id, $subject_id);

			$remarks = (unserialize($previous_remarks)) ? unserialize($previous_remarks) : array();

			$remarks[] = [
				'date_added'		=> date('m-d-Y'),
				'subject_remarks'	=> $set_remarks
			];

			$remarks = serialize($remarks);
			$remarks = base64_encode($remarks);

			$this->db->update('student_subjects', 
				['currently_enrolled' => 0,'subject_remarks' => $remarks], //set
				['student_id' => $student_id, 'subject_id' => $subject_id] // where
			);	
		}

		$flash_message = "Successfully updated student remarks for Student ID [$student_id]";
		$this->session->set_flashdata('message', $flash_message);
	}
	#-------------------------------------------------------------------------------------------------#
}