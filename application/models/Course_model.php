<?php

class Course_model extends MY_model {
	const DB_TABLE = 'course';
	const DB_TABLE_PK = 'course_id';


	/**
	 *
	 * @var int $course_id
	 *
	*/
	public $course_id;

	/**
	 *
	 * @var int $department_id
	 *
	*/

	public $department_id;

	/**
	 *
	 * @var str $course_name
	 *
	*/
	public $course_name;

	/**
	 *
	 * @var str $course_abbrev
	 *
	*/
	public $course_abbrev;
	
}