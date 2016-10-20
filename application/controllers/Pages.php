<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

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

	public function view($page = 'home')
	{

		$data['title'] = ucwords(str_replace("-"," ",$page));

		if ( ! file_exists(APPPATH.'views/pages/'.$page.'.php'))
        {
                // Whoops, we don't have a page for that!
                show_404();
        } else if($page == 'wheel-of-juices-giveaway') {
        	$this->load->view('templates/header-base', $data);
        	$this->load->view('pages/'.$page, $data);
        	$this->load->view('templates/footer-base', $data);
        } else if(substr($page,0,4) == 'shop') {
        	$this->load->view('templates/header-shop', $data);
        	$this->load->view('pages/'.$page, $data);
        	$this->load->view('templates/footer-shop', $data);
        } else {
	        $this->load->view('templates/header', $data);
	        $this->load->view('pages/'.$page, $data);
	        $this->load->view('templates/footer', $data);
        }

	}
}
