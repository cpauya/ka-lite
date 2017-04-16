<?php

class College_model extends MY_model {
	const DB_TABLE = 'college';
	const DB_TABLE_PK = 'college_id';


	/**
	 *
	 * @var int $college_id
	 *
	*/
	public $college_id;
	
	/**
	 *
	 * @var str $college_name
	 *
	*/
	public $college_name;

	/**
	 *
	 * @var str $college_abbrev
	 *
	*/
	public $college_abbrev;
}