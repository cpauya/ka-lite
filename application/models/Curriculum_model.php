<?php

class Curriculum_model extends MY_model {
	const DB_TABLE = 'course_curriculum';
	const DB_TABLE_PK = 'course_curriculum_id';

	/**
	 *
	 * @var int $course_curriculum_id
	 *
	*/
	public $course_curriculum_id;

	/**
	 *
	 * @var int $course_id
	 *
	*/
	public $course_id;

	/**
	 *
	 * @var str $curriculum_description
	 *
	*/
	public $curriculum_description;

	/**
	 *
	 * @var int $curriculum_year
	 *
	*/
	public $curriculum_year;

	#-------------------------------------------------------------------------------------------------#
	public function curriculum_exists($curriculum_description, $curriculum_year) 
	{
		$exists = parent::get_by(['curriculum_description' => $curriculum_description, 'curriculum_year' => $curriculum_year]);
		
		return $exists ? true : false;
	}

	/**
	 *
	 * @param int $course_curriculum_id
	 * @return array $result
	 * Get curriculum subjects.
	*/
	public function get_curriculum_subjects($course_curriculum_id = null, $order_by = '')
	{
	
		$this->db->select('cc.course_curriculum_id, cc.course_id, cc.curriculum_description, cc.curriculum_year, subjects.*, cs.subject_year, cs.semester_offered, cs.prerequisite')
				->from('course_curriculum cc')
				->join('curriculum_subjects cs', 'cs.course_curriculum_id = cc.course_curriculum_id', 'left')
				->join('subjects', 'subjects.subject_id = cs.subject_id', 'left');

		if(is_null($course_curriculum_id))
			$this->db->where('cc.course_curriculum_id', $this->course_curriculum_id);
		else
			$this->db->where('cc.course_curriculum_id', $course_curriculum_id);

		if(!$order_by)
			$this->db->order_by('cs.subject_year, cs.semester_offered, cs.date_added');
		else
			$this->db->order_by($order_by);

		$result = $this->db->get();
		return $result->result_array();
	}
	#--------------------------------------------------------------------------------------------------#
	public function get_total_units_per_year($curriculum_id)
	{
		$this->db->select('curriculum_subjects.subject_year, curriculum_subjects.semester_offered, SUM(subjects.credit_units) as total_units')
				->from('course_curriculum')
				->join('curriculum_subjects', 'course_curriculum.course_curriculum_id = curriculum_subjects.course_curriculum_id', 'left')
				->join('subjects', 'subjects.subject_id = curriculum_subjects.subject_id', 'left')
				->where('course_curriculum.course_curriculum_id', $curriculum_id)
				->group_by('curriculum_subjects.subject_year, curriculum_subjects.semester_offered');
				#->group_by('curriculum_subjects.subject_year');

		$result = $this->db->get()->result_array();

		return $result;
	}
	#-------------------------------------------------------------------------------------------------#
}