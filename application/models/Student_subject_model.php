<?php

class Student_subject_model extends MY_model {
	const DB_TABLE = 'student_subjects';
	const DB_TABLE_PK = 'student_id';


	/**
	 *
	 * @var int $course_id
	 *
	*/
	public $student_id;

	/**
	 *
	 * @var int $subject_id
	 *
	*/
	public $subject_id;

	/**
	 *
	 * @var str $subject_remarks
	 * 		base64_encoded
	*/
	public $subject_remarks;

	/**
	 *
	 * @var bool $currently_enrolled
	 *
	*/
	public $currently_enrolled = false;

	#-------------------------------------------------------------------------------------------------#
	/**
	 *
	 *	 Override Insert.
	 *
	**/
	protected function insert()
	{

		$this->db->insert($this::DB_TABLE, [
			'student_id'			=> $this->student_id,
			'subject_id'			=> $this->subject_id,
			'subject_remarks'		=> $this->subject_remarks,
			'currently_enrolled'	=> $this->currently_enrolled
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
		
		$this->db->update($this::DB_TABLE, 
			[
				'subject_remarks'		=> $this->subject_remarks,
				'currently_enrolled' 	=> $this->currently_enrolled
			], 
			[
				'student_id' 			=> $this->student_id, 
				'subject_id' 			=> $this->subject_id
			]
		);
	}
	#-------------------------------------------------------------------------------------------------#
	/**
	 *
	 *	 Override Save.
	 *
	**/
	public function save()
	{
		$result = parent::get_by(['student_id' => $this->student_id, 'subject_id' => $this->subject_id]);

		if(is_null($result) && is_null($result['subject_remarks']))
		{
			$this->insert();
		}
		else
		{
			$this->update();
		}
	}
	#-------------------------------------------------------------------------------------------------#
	/**
	 *
	 * @param int $student_id
	 * @param int $subject_id
	 *
	 * @return array $subject_remarks // serialized data
	 *
	 * Get student's remarks on a single subject.
	*/
	public function get_student_remarks($student_id, $subject_id = null)
	{
		if($subject_id)
		{
			$this->db->select('*')
					->from('student_subjects')
					->where([
						'student_id' => $student_id, 
						'subject_id' => $subject_id
					])
					->limit(1);
			$result = $this->db->get();
			$result = $result->row_array();

			if(!is_null($result['subject_remarks']))
				return base64_decode($result['subject_remarks']);

			return null;
		}
		else
		{
			$this->load->model('student_model');
			$this->load->model('curriculum_model');

			$student = $this->student_model->get($student_id);
			$student_course_curriculum = $student['course_curriculum_id'];
			$curriculum_subjects = $this->curriculum_model->get_curriculum_subjects($student_course_curriculum);

			$curriculum_subjects_id = array();

			foreach($curriculum_subjects as $curriculum_subject)
			{
				$curriculum_subjects_id[] = $curriculum_subject['subject_id'];
			}

			if(empty($curriculum_subjects_id))
				return null;

			$this->db->select('*')
				->from('student_subjects')
				->where('student_id', $student_id)
				->where_in('subject_id', $curriculum_subjects_id);

			$result = $this->db->get();
			$num_rows = $result->num_rows();
			$result = $result->result_array();

			if($num_rows <= 0)
				return null;

			foreach($result as &$student_remarks)
			{
				foreach($curriculum_subjects as $curriculum_subject)
				{
					if($curriculum_subject['subject_id'] == $student_remarks['subject_id'])
						$student_remarks['credit_units'] = $curriculum_subject['credit_units'];
				}
				$student_remarks['subject_remarks'] = base64_decode($student_remarks['subject_remarks']);
			}

			return $result;
		}
		
	}
	#-------------------------------------------------------------------------------------------------#
	/**
	 *
	 * @param int $student_id
	 * @return int
	 *
	 * Get student's total units earned.
	**/
	public function get_student_total_units($student_id = null)
	{
		$this->load->model('subject_model');

		if(is_null($student_id))
			$student_id = $this->student_id;

		$student_remarks = $this->get_student_remarks($student_id);
		$total_units = 0;

		if(is_null($student_remarks))
			return $total_units;

		foreach($student_remarks as $remarks)
		{
			if($remarks_array = unserialize($remarks['subject_remarks']))
			{
				if($this->subject_model->remarks_passed($remarks_array))
				{
					$total_units += $remarks['credit_units'];
				}
			}
			
		}
		return $total_units;
	}
	#-------------------------------------------------------------------------------------------------#
	/**
	 *
	 * @param int $student_id
	 * @return mixed array
	 *
	 * Get other subjects taken by student that are not in his/her curriculum.
	**/
	public function get_other_subjects_taken($student_id = null)
	{
		if(is_null($student_id))
			$student_id = $this->student_id;

		$this->load->model('curriculum_model');
		$this->load->model('student_model');

		$student_info = $this->student_model->get($student_id);
		$student_curriculum = $student_info['course_curriculum_id'];
		$curriculum_subjects = $this->curriculum_model->get_curriculum_subjects($student_curriculum);

		$curriculum_subjects_id = array();

		foreach($curriculum_subjects as $subject)
		{
			$curriculum_subjects_id[] = $subject['subject_id'];
		}

		//checks if there is no subjects in the curriculum
		if(empty($curriculum_subjects_id[0]))
			$curriculum_subjects_id[0] = 0;

		$this->db->select('student_subjects.*, subjects.course_code, subjects.descriptive_title, subjects.credit_units')
			->from('student_subjects')
			->join('subjects', 'student_subjects.subject_id = subjects.subject_id', 'left')
			->where('student_id', $student_id)
			->where_not_in('subjects.subject_id', $curriculum_subjects_id);

		$other_subjects = $this->db->get()->result_array();

		return $other_subjects;
	}
	#-------------------------------------------------------------------------------------------------#
}