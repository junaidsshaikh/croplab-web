<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Downloads extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	
	public function index()
	{
		$data['content_title'] 	= "About";	// page title
		$data['main_content'] 	= 'downloads/downloads';	// page
		$this->load->view('innerpages/template', $data);
		
	}
	public function report()
	{	
		$data['uri']			=$this->uri->segment(3);
		$data['content_title'] 	= "About";	// page title
		$data['main_content'] 	= 'downloads/report_view';	// page
		$this->load->view('innerpages/template', $data);
		
	}
}
