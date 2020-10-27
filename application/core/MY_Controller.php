<?php 

class MY_Controller extends CI_Controller {

	public function __construct() {
		
		parent::__construct();
		//En=English,Hi=Hindi,Mr=Marathi,Gu=Gujarati
		
		$languages = array("En", "hi", "mr", "gu");
		
		if(in_array($this->uri->segment(1),$languages)){
			$this->load->language($this->uri->segment(1),$this->uri->segment(1));
		
		}else{
			$this->load->language('en','en');
		}
		
	}
	
	

}

?>