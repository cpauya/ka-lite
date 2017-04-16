<?php

class Student_model extends MY_model {
	const DB_TABLE = 'student';
	const DB_TABLE_PK = 'student_id';

	/**
	 * 
	 * @var int $student_id
	 *
	*/
	public $student_id;

	/**
	 * 
	 * @var int $course_id
	 *
	*/
	public $course_id;

	/**
	 * 
	 * @var int $course_curriculum_id
	 *
	*/
	public $course_curriculum_id;

	/**
	 * 
	 * @var str $student_firstname
	 *
	*/

	public $student_firstname;

	/**
	 * 
	 * @var str $student_lastname
	 *
	*/
	public $student_lastname;

	/**
	 * 
	 * @var str $student_middlename
	 *
	*/
	public $student_middlename;


	/**
	 *
	 * @Override Save function.
	 *
	**/

	#-------------------------------------------------------------------------------------------------#
	public function save()
	{
		$result = parent::get($this->student_id);

		if(is_null($result))
		{
			parent::insert();
		}
		else
		{
			parent::update();
		}
	}
	#-------------------------------------------------------------------------------------------------#
	/**
	 *
	 * @param int $student_id
	 * @return mixed $result
	 *
	 * Get Student's Curriculum.
	**/
	public function get_student_curriculum($student_id = null, $where = null)
	{
		$student_details = parent::get($student_id);

		$this->db
		->select('
					student.*, 
					course.*, 
					subjects.*,
					course_curriculum.curriculum_description,
					course_curriculum.curriculum_year, 
					curriculum_subjects.prerequisite, 
					curriculum_subjects.course_curriculum_id, 
					curriculum_subjects.subject_year, 
					curriculum_subjects.semester_offered, 
					student_subjects.subject_remarks, 
					student_subjects.currently_enrolled
				')
		->from('student')
		->join('course', 'course.course_id = student.course_id', 'left')
		->join('course_curriculum', 'course_curriculum.course_id = course.course_id', 'left')
		->join('curriculum_subjects', 'course_curriculum.course_curriculum_id = curriculum_subjects.course_curriculum_id', 'left')
		->join('subjects', 'subjects.subject_id = curriculum_subjects.subject_id', 'left')
		->join('student_subjects','(subjects.subject_id = student_subjects.subject_id AND student.student_id = student_subjects.student_id)', 'left')
		->order_by('curriculum_subjects.subject_year, curriculum_subjects.semester_offered, curriculum_subjects.date_added');

		$this->db->where('course_curriculum.course_curriculum_id', $student_details['course_curriculum_id']);

		if(is_null($student_id))
			$this->db->where('student.student_id', $this->$student_id);
		else
			$this->db->where('student.student_id', $student_id);

		if(!is_null($where))
			$this->db->where($where);

		$result = $this->db->get();

		return $result->result_array();
	}
	#-------------------------------------------------------------------------------------------------#
	/**
	 *
	 * @param int $student_id
	 * @return bool
	 *
	 * Check if student exists in the database.
	**/
	public function student_exists($student_id = null)
	{
		if(is_null($student_id))
		{
			$student_id = $this->student_id;
		}

		$data = parent::get($student_id);

		return ($data) ? true : false;
	}
	#-------------------------------------------------------------------------------------------------#
	/**
	 *
	 * @param int $limit
	 * @param int $offset
	 * @return array 
	 *
	 * Get Student's Curriculum.
	**/
	public function get_all_students($limit = 0, $offset = 0)
	{
		return $this->db->select('*')
			->from('student')
			->order_by('student_lastname, student_firstname, student_middlename, student_id, course_id')
			->limit($limit, $offset)
			->get()
			->result_array();
	}
	#-------------------------------------------------------------------------------------------------#
	/**
	 *
	 * @param str $search
	 * @param int $limit
	 * @param int offset
	 * @return array
	 *
	 * Search function.
	**/
	public function search($search = null, $limit = 0, $offset = 0)
	{
		if(is_null($search) || $search == '')
		{
			return $this->get_all_students();
		}
		else
		{
			return $this->db->select('*')
			->from('student')
			->or_like('student_id', $search, 'after')
			->or_like('student_firstname', $search, 'after')
			->or_like('student_middlename', $search, 'after')
			->or_like('student_lastname', $search, 'after')
			->order_by('student_lastname, student_firstname, student_middlename, student_id, course_id')
			->limit($limit, $offset)
			->get()
			->result_array();
		}
	}
	#-------------------------------------------------------------------------------------------------#
	/**
	 *
	 * @param str $search
	 * @return int number_of_rows
	 *
	 * Get total number of students that matches $search
	**/
	public function get_total_students($search = null)
	{
		if(is_null($search) || $search == '')
			return $this->db->select('*')->from('student')->get()->num_rows();
		else
			return $this->db->select('*')
				->from('student')
				->or_like('student_id', $search, 'after')
				->or_like('student_firstname', $search, 'after')
				->or_like('student_middlename', $search, 'after')
				->or_like('student_lastname', $search, 'after')
				->get()
				->num_rows();
	}
	#-------------------------------------------------------------------------------------------------#
	public function get_student_standing($student_id)
	{
		$this->load->model('curriculum_model');
		$this->load->model('student_subject_model');

		$student_details 			= parent::get($student_id);

		$curriculum_id 				= $student_details['course_curriculum_id'];
		$student_total_units 		= $this->student_subject_model->get_student_total_units($student_id);
		$total_units_per_year 		= $this->curriculum_model->get_total_units_per_year($curriculum_id);

		$standing = array(
			1 => 'first_year_standing', 
			2 => 'second_year_standing', 
			3 => 'third_year_standing', 
			4 => 'fourth_year_standing', 
			5 => 'fifth_year_standing'
		);

		$year = 1;
		$units_required = 0;


		foreach($total_units_per_year as $key => $per_year)
		{
			//student_year increments everytime his / her units are greater than the subject_year units
			if($student_total_units >= $units_required)
				if(isset($per_year['subject_year']))
					$year = $per_year['subject_year'];

			//skip counting for 3rd year summer
			if($per_year['subject_year'] == 3 && $per_year['semester_offered'] == 3)
				continue;

			$units_required += $per_year['total_units'];
		}

		return $standing[$year];
	}
	#-------------------------------------------------------------------------------------------------#
}