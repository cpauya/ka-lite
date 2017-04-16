<?php

class MY_Model extends CI_Model {
	const DB_TABLE = 'abstract';
	const DB_TABLE_PK = 'abstract';



	/**
	 *
	 * Create Record.
	 *
	**/

	protected function insert() {
		$this->db->insert($this::DB_TABLE, $this);
		$this->{$this::DB_TABLE_PK} = $this->db->insert_id();
	}
	#-------------------------------------------------------------------------------------------------#
	/**
	 *
	 * Update Record.
	 *
	**/

	protected function update() {
		$this->db->update($this::DB_TABLE, $this, array($this::DB_TABLE_PK => $this->{$this::DB_TABLE_PK}));
	}
	#-------------------------------------------------------------------------------------------------#
	/**
	 *
	 * Delete Record.
	 *
	**/

	public function delete() {
		$this->db->delete($this::DB_TABLE, array(
			$this::DB_TABLE_PK => $this->{$this::DB_TABLE_PK},
			));
		unset($this->{$this::DB_TABLE_PK});
	}
	#-------------------------------------------------------------------------------------------------#
	/**
	 *
	 * Save Record.
	 *
	**/
	public function save() {
		if(isset($this->{$this::DB_TABLE_PK})) {
			$this->update();
		} else {
			$this->insert();
		}
	}
	#-------------------------------------------------------------------------------------------------#
	/**
	 * @param int $id
	 * @param int $limit
	 * @param int $offset
	**/
	#-------------------------------------------------------------------------------------------------#
	public function get($id = null, $limit = 0, $offset = 0) {

		if($id && $limit) 
		{
			$query = $this->db->get_where($this::DB_TABLE, [$this::DB_TABLE_PK => $id], $limit, $offset);

			return ($query->num_rows() > 0) ? $query->row_array() : null;
		} 
		elseif ($id) 
		{
			$query = $this->db->get_where($this::DB_TABLE, [$this::DB_TABLE_PK => $id], 1);
			return ($query->num_rows() > 0) ? $query->row_array() : null;
		} 
		else 
		{
			$query = $this->db->get($this::DB_TABLE, $limit, $offset);
		}

		return ($query->num_rows() > 0) ? $query->result_array() : null;
	}
	#-------------------------------------------------------------------------------------------------#
	/**
	 * @param mixed $fields
	 * @param int $limit
	 * @param int $offset
	**/

	public function get_by($fields, $all_rows = false, $limit = 0, $offset = 0) {

		$limit = ($all_rows) ? $limit : 1;
		$query = $this->db->get_where($this::DB_TABLE, $fields, $limit);

		if($all_rows)
			return ($query->num_rows() > 0) ? $query->result_array() : null;
		else
			return ($query->num_rows() > 0) ? $query->row_array() : null;
	}
	#-------------------------------------------------------------------------------------------------#
	/**
	 * @param mixed $fields
	 * @param str $field_to_return
	 * @param int $offset
	**/
	public function get_by_return($fields, $field_to_return, $limit = 0, $offset = 0) {
		$result = $this->get_by($fields, 1);
		return isset($result[$field_to_return]) ? $result[$field_to_return] : null;
	}
	#-------------------------------------------------------------------------------------------------#
}