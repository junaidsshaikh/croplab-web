<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Feedback_model', 'feedback');
	}

	
	public function index()
	{
		$data['content_title'] 	= "About";	// page title
		$data['main_content'] 	= 'contact/contact';	// page
		$this->load->view('innerpages/template', $data);
		
	}
	
	public function send_feedback() {
		
		   
	    $name       = $this->input->post('name');
	    $mobile      = $this->input->post('mobile');
	    $message    = $this->input->post('message');
	    
	    $data = [
			'name'				=> $name,
			'mobile_number'			=> $mobile,
			'message'			=> $message,
			'ip_address'		=> $_SERVER['SERVER_ADDR'],
			'status'			=> "1",
		];
		
		$result = $this->feedback->save($data);
		if($result) {
			$this->session->set_flashdata('success_message', "Your feedback is sent successfully.");
			redirect("contact/contact");
		} else {
			$this->session->set_flashdata('error_message', "Something went wrong. Please try again!");
			redirect("contact/contact");
		}
	}
	
}
