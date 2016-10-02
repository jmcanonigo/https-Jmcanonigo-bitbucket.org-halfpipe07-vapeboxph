<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH.'libraries/REST_Controller.php');

class Api extends REST_Controller {
 
	function __construct() {
		parent::__construct();
		$this->load->model('testers_model');
		$this->load->model('participants_model');
		$this->load->database();
	}
	 
	public function tester_get() {
		$this->response($this->testers_model->get_tester(), 200);
	}
	 
	//quantity = add, subtract
	public function tester_post() {
		$this->response($this->testers_model->inventory($this->post('id'), $this->post('quantity')), 200);
	}

	//api/participant/id/3
	//api/participant/email/halfpipe07%40yahoo.ca
	public function participant_get() {
        if(!!urldecode($this->get('id'))) {
        	$data = $this->participants_model->get_participants_by_id($this->get('id'));
        } else if(!!urldecode($this->get('email')) ) {
        	$data = $this->participants_model->get_participants_by_email(urldecode($this->get('email')));
        } 

        $this->response($data, 200);
	}

	//POST api/participant
	public function participant_post() {
		if(null !== $this->post('id')) {
			$id = $this->post('id');
	        $prize = $this->post('prize');
			$this->response($this->participants_model->update_participants($id, $prize), 201);
		} else if (null !== $this->post('email')) {
			$fname = $this->post('fname');
	        $lname = $this->post('lname');
	        $email = $this->post('email');
	        $mobile = $this->post('mobile');
	        $this->response($this->participants_model->add_participants($fname, $lname, $email, $mobile), 201);
		}
	}

}