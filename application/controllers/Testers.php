<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Testers extends CI_Controller {
 
	function __construct() {
		parent::__construct();
		$this->load->database();
	}
	 
	public function index() {
		echo "<h1>Welcome to the world of Codeigniter</h1>";
		die();
	}

}