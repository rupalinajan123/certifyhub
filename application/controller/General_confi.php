<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
	Class Name 		: 	Document type Master
	Created By		: 	Deepak K
	Created Date 	: 	08-01-2020
*/   
class General_confi extends MY_Controller 
{
	public function __construct()
    {
    	parent::__construct();
      $this->load->model('masters_model');
    }

    /**
     * Create  Deepak K
     * @param       null
     * @return      mixed|string 
     */
    public function index()
    {

    	// $data['title'] = 'Document Type';
  		// $data['subview'] = $this->load->view('admin/master/document_type/index',$data ,true);
  		// $this->load->view('include/main',$data);
    }
  }