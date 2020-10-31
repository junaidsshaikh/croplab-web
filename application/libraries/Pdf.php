<?php 

//require 'vendor/autoload.php';
//require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;

class Pdf extends Dompdf {
	
	public function __construct() {
		parent::__construct();
	}
	
}

//Add './vendor/autoload.php' in config.php at $config['composer_autoload'] to remove dompdf not found error