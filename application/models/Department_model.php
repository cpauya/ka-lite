<?php

class Department_model extends MY_model {
	const DB_TABLE = 'department';
	const DB_TABLE_PK = 'department_id';


	/**
	 *
	 * @var int $department_id
	 *
	*/
	public $department_id;
	
	/**
	 *
	 * @var int $college_id
	 *
	*/
	public $college_id;

	/**
	 *
	 * @var str $department_name
	 *
	*/
	public $department_name;
}