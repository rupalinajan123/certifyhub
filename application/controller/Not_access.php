<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
	Class Name 		: 	Not_access
	Created By		: 	Deepak k
	Created Date 	: 	05-09-2019

*/
class Not_access extends CI_Controller 
{
	public function __construct()
	{
        parent::__construct();
        if (is_login() == false) {
        	redirect(base_url().'login');
        }

    }
    /**
	 * index function for use to if page not found
	 * Create Deepak k
	 * @param       null
	 * @return      mixed|string
	 */
	public function index()
	{
		$data['title'] 		= 'Access Denied';
		$this->output->set_status_header('403');
		$data['subview'] 	= $this->load->view('error/not_access',$data ,true);
		$this->load->view('include/main',$data);
		
	}

}


