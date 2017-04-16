<?php

class MY_Controller extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();

		if(!is_logged_in())
		{
			$this->session->set_flashdata('error_message', 'You must be logged in.');
			redirect('home/login');
		}
	}
	#-------------------------------------------------------------------------------------------------#
}