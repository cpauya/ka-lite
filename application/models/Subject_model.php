<?php

class Subject_model extends MY_model {
	const DB_TABLE = 'subjects';
	const DB_TABLE_PK = 'subject_id';

	const DB_LINK_TABLE = 'curriculum_subjects';

	# <-- Subjects Table

	/**
	 *
	 * @var int $subject_id
	 *
	*/
	public $subject_id;

	/**
	 *
	 * @var str $course_code
	 *
	*/
	public $course_code;

	/**
	 *
	 * @var str $descriptive_title
	 *
	*/
	public $descriptive_title;

	/**
	 *
	 * @var int $credit_units
	 *
	*/
	public $credit_units;

	# Subjects Table -->

	# <-- Curriculum_Subjects Table

	/**
	 *
	 * @var int $course_curriculum_id
	 *
	*/
	public $course_curriculum_id;

	/**
	 *
	 * @var int $subject_year
	 *
	*/
	public $subject_year;

	/**
	 *
	 * @var int $semester_offered
	 *
	*/
	public $semester_offered;

	/**
	 *
	 * @var str $prerequisite
	 * 			serialized
	 *
	*/
	public $prerequisite;

	public $date_added;
	# -->

	#-------------------------------------------------------------------------------------------------#
	/**
	 *
	 *	 Override Insert.
	 *
	**/
	protected function insert()
	{
		$this->db->insert($this::DB_TABLE, [
			'course_code' 				=> $this->course_code,
			'descriptive_title' 		=> $this->descriptive_title,
			'credit_units' 				=> $this->credit_units
		]);

		//$this->subject_id = $this->db->insert_id()
		$this->{$this::DB_TABLE_PK} = $this->db->insert_id();

		$this->db->insert($this::DB_LINK_TABLE, [
			'course_curriculum_id' 		=> $this->course_curriculum_id,
			'subject_id' 				=> $this->subject_id,
			'subject_year' 				=> $this->subject_year,
			'semester_offered' 			=> $this->semester_offered,
			'prerequisite' 				=> $this->prerequisite,
		]);
	}
	#-------------------------------------------------------------------------------------------------#
	/**
	 *
	 *	 Override Update.
	 *
	**/
	protected function update()
	{
		$subject_update = array(
			'course_code' 				=> $this->course_code,
			'descriptive_title' 		=> $this->descriptive_title,
			'credit_units' 				=> $this->credit_units
			);

		$curriculum_update = array(
			'course_curriculum_id' 		=> $this->course_curriculum_id,
			'subject_id' 				=> $this->subject_id,
			'subject_year' 				=> $this->subject_year,
			'semester_offered' 			=> $this->semester_offered,
			'prerequisite' 				=> $this->prerequisite
			);
		$this->db->update($this::DB_TABLE, $subject_update, array($this::DB_TABLE_PK => $this->{$this::DB_TABLE_PK}));

		$this->db->update($this::DB_LINK_TABLE, $curriculum_update, [
			'course_curriculum_id' 		=> $this->course_curriculum_id,
			'subject_id'				=> $this->subject_id
			]);
	}
	#-------------------------------------------------------------------------------------------------#
	/**
	 *
	 *	 Override Save.
	 *
	**/
	public function save()
	{
		//used for checking if the course_code is existing
		$result = $this->get_by(['course_code' => $this->course_code]);

		if(is_null($result) && (!(isset($this->subject_id) && isset($this->course_curriculum_id))))
		{
			$this->insert();
		}
		else
		{
			if(isset($result['subject_id']))
			{
				$this->subject_id = $result['subject_id'];
				//$sql = "SELECT course_curriculum_id, subject_id FROM curriculum_subjects WHERE course_curriculum_id = $this->course_curriculum_id AND subject_id = $this->subject_id";

				$this->db->select('course_curriculum_id, subject_id')
				->from('curriculum_subjects')
				->where('course_curriculum_id', $this->course_curriculum_id)
				->where('subject_id', $this->subject_id);

				$result = $this->db->get();
				$result = $result->row_array();

				# if the course code is already existing and the subject id is not in the curriculum, do not insert it to the subjects table anymore. just insert the other details.
				if(is_null($result))
				{
					$this->db->insert($this::DB_LINK_TABLE, [
						'course_curriculum_id'		=> $this->course_curriculum_id,
						'subject_id'				=> $this->subject_id,
						'subject_year'				=> $this->subject_year,
						'semester_offered'			=> $this->semester_offered,
						'prerequisite'				=> $this->prerequisite
						]);
				}
				else
				{
					#if the course code is already existing and the subject id is in the curriculum, update it.
					$this->update();
				}
			}
			else
			{
				#if there was a subject_id, we will set it.
				$this->update();
			}
		}
	}
	#-------------------------------------------------------------------------------------------------#
	/**
	 * Gets the list of semesters when a subject is offered.
	 * @param int $subject_id
	 * 
	 * @return array $subjects
	*/
	public function get_semester_offered($subject_id)
	{
		$this->db->select('semester_offered')
				->from('curriculum_subjects')
				->where('subject_id', $subject_id);

		$result = $this->db->get();
		$subjects = array();

		foreach($result->result_array() as $res)
		{
			$subjects[] = $res['semester_offered'];
		}

		sort($subjects);
		return $subjects;
	}

	#-------------------------------------------------------------------------------------------------#
	/**
	 *
	 * @param int $curriculum_id
	 * @param int $subject_id
	 * 
	 * @return mixed $result
	*/
	public function get_subject_data($curriculum_id = null, $subject_id = null)
	{

		if($subject_id && $curriculum_id)
		{
			$this->subject_id = $subject_id;
			$this->course_curriculum_id = $curriculum_id;
		}

		$this->db->select('*')
				->from('course_curriculum')
				->join('curriculum_subjects', 'course_curriculum.course_curriculum_id = curriculum_subjects.course_curriculum_id', 'left')
				->join('subjects', 'subjects.subject_id = curriculum_subjects.subject_id', 'left')
				->where('course_curriculum.course_curriculum_id', $this->course_curriculum_id)
				->where('subjects.subject_id', $this->subject_id)
				->order_by('curriculum_subjects.subject_year', 'asc')
				->order_by('curriculum_subjects.semester_offered', 'asc')
				->order_by('subjects.course_code', 'asc');

		$result = $this->db->get();
		
		return ($result->num_rows() > 0) ? $result->row_array() : '';
	}
	#-------------------------------------------------------------------------------------------------#
	/**
	 *
	 * @param int $course_curriculum_id
	 * @param int $subject_id
	 * 
	 * @return mixed $result
	*/
	public function get_subject_prerequisites($course_curriculum_id, $subject_id)
	{
		$this->db->select('*')
				->from('curriculum_subjects')
				->where('course_curriculum_id', $course_curriculum_id)
				->where('subject_id', $subject_id);

		$result = $this->db->get()->row_array();
		$result = unserialize($result['prerequisite']);

		return $result;
	}
	#-------------------------------------------------------------------------------------------------#
	/**
	 *
	 * @param int $student_id
	 * @param int $subject_id
	 * @param int $curriculum_id
	 * 
	 * @return bool
	*/
	public function student_can_get_subject($student_id, $curriculum_id = null, $subject_id = null)
	{
		$prerequisites = $this->get_subject_prerequisites($curriculum_id, $subject_id);

		$number_of_prerequisites 	= count($prerequisites);
		$subjects_passed 			= 0;
		$standing_prerequisite		= false;

		//first_year_standing, second_year_standing . . .
		$prerequisite_standing		= '';

		foreach($prerequisites as $prerequisite)
		{

			 #$prerequisite possible values
			/**
			  * None
			  * first_year_standing
			  * second_year_standing
			  * third_year_standing
			  * fourth_year_standing
			  * ITE 111A
			  * ITE 111B
			  * ITE 311
			  * ...
			***/


			# is the prerequisite None?
			if($prerequisite == 'None')
			{
				return true;
			}
			
			//$this->is_standing_prerequsite('ITE 111A') = false
			//$this->is_standing_prerequisite('third_year_standing') = true
			if($this->is_standing_prerequisite($prerequisite))
			{
				$standing_prerequisite = true;
				$prerequisite_standing = $prerequisite;
				break;
			}
		}

		if($standing_prerequisite)
		{
			$this->load->model('student_model');
			$student_standing = $this->student_model->get_student_standing($student_id);
			$standing_values = array(
				'first_year_standing' 	=> 1,
				'second_year_standing' 	=> 2,
				'third_year_standing' 	=> 3,
				'fourth_year_standing' 	=> 4,
				'fifth_year_standing' 	=> 5
			);
			
			if($standing_values[$student_standing] >= $standing_values[$prerequisite_standing])
				return true;

			return false;
		}
		else
		{
			//array(ITE 111A, ITE 111B)
			foreach($prerequisites as $prerequisite)
			{
				$subject_data = unserialize($this->student_subject_model->get_student_remarks($student_id, $prerequisite));

				# if no data was found -- no subject remarks for that subject
				if(!$subject_data)
					return false;

				if($this->remarks_passed($subject_data))
					$subjects_passed++;
			}

			if($subjects_passed == $number_of_prerequisites)
				return true;

			return false;
		}
	}
	#-------------------------------------------------------------------------------------------------#
	/**
	 *
	 * @param $str $prerequisite
	 * @return bool
	 * Checks if $prerequisite is a standing prerequisite.
	*/
	public function is_standing_prerequisite($prerequisite)
	{
		return strpos($prerequisite, 'standing');
	}
	#-------------------------------------------------------------------------------------------------#
	/**
	 *
	 * @param str $data
	 * @return bool
	 * Checks if subject remarks are passed.
	*/
	public function remarks_passed($data)
	{
		$remarks = '';

		if(!is_array($data))
			$data = unserialize($data);

		foreach($data as $d)
		{
			$remarks = $d['subject_remarks'];
		}

		if($remarks == 'Pass')
			return true;

		return false;
	}
	#-------------------------------------------------------------------------------------------------#
}