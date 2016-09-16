<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mail extends CI_Controller {

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
	public function send_mail() {

	    $this->load->helper('url');

	    if (!isset($_POST['email']) || !isset($_POST['message']) || !isset($_POST['name']) ){
	      //redirect if no parameter e-mail
	      redirect(site_url('contact'));
	    };

	    //load email helper
	    $this->load->helper('email');
	    //load email library
	    $this->load->library('email');
	    
	    //read parameters from $_POST using input class
	    $name = $_POST['name'];
	    $email = $this->input->post('email',true);
	    $mobile = $_POST['mobile'];
	    $msg = $_POST['message'];
	  
	    // check is email addrress valid or not
	    if (valid_email($email)){  
	      // compose email
	      $this->email->from($email, $name);
	      $this->email->to($email); 
	      $this->email->subject('[Redlist Inquiry] ' . $name);

	      $composed = "Name: " . $name . "\n";
	      $composed = "Mobile: " . $mobile . "\n";
	      $composed = "Message: " . $msg . "\n";

	      $this->email->message($composed);  
	      
	      // try send mail ant if not able print debug
	      if ( ! $this->email->send())
	      {
	        $data['message'] ="Email not sent \n".$this->email->print_debugger();
	        $data['type'] = "danger";
	        $data['title'] = "Contact Us";

		    $this->load->view('templates/header', $data);
	        $this->load->view('pages/contact-us', $data);
	        $this->load->view('templates/footer', $data);

	      }
	         // successful message
	        $data['message'] ="Email was successfully sent to Redlist. We'll notify you in 24-48 hours.";
	        $data['type'] = "success";
	        $data['title'] = "Contact Us";
	      
		    $this->load->view('templates/header', $data);
	        $this->load->view('pages/contact-us', $data);
	        $this->load->view('templates/footer', $data);

	    } else {

	      	$data['message'] ="Email address ($email) is not correct. Please <a href=".site_url('contact').">try again</a>";
	      	$data['type'] = "danger";
	      	$data['title'] = "Contact Us";
	      
		    $this->load->view('templates/header', $data);
	        $this->load->view('pages/contact-us', $data);
	        $this->load->view('templates/footer', $data);

	    }

	  }
}
