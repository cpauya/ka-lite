<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	

if(!function_exists('page404'))
{
	function page404($previous_link = null)
	{
		$CI =& get_instance();
		$CI->output->set_status_header('404');	

		$nav['crumbs'] = array(
			[
				'name' 			=> 'Home',
				'url'			=> site_url(),
				'is_active'		=> false
			],
			[
				'name' 			=> 'Page Not Found',
				'url'			=> '',
				'is_active'		=> true
			]
		);

		$data['previous_link'] = is_null($previous_link) ? $previous_link : site_url($CI->uri->segment(1));

		$CI->load->view('inc/header_view');
		$CI->load->view('inc/breadcrumbs', $nav);
		$CI->load->view('errors/page_not_found', $data);
		$CI->load->view('inc/footer_view');
	}
}