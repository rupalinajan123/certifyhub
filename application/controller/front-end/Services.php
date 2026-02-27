<?php
defined('BASEPATH') or exit('No direct script access allowed');
/*
	Class Name 		: 	Home
	Created By		: 	Deepak K
*/
class Services extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model( array('Masters_model','Front_service_model','Front_Products_model','Email_model') );
		
		$keys = array('product_id','package_id','quantity','prev_url','client_custom_fields_data','user_m_download_url'); // Delete front session
    	$this->session->unset_userdata($keys);
	}

	/**
	 * Created by Aayusha k
	 * @param       null
	 * @return    	mixed|string
	 * index page
	 */
	public function index($category_id = NULL,$sub_cat_id = NULL)
	{
		
			$this->load->library("pagination");
			$config 	= array();

			$sub_id 	= '';
			$cat_id 	= '';

			$base_url 	= base_url() . "services/";
			$cat_name ='';
			if(!empty($category_id) && is_numeric($category_id) ){
				$cat_name = get_name_by_id('categories','name',array('cat_id' =>$category_id));
				$base_url	=  base_url() . "services/".replace_space_with_dash($cat_name);
				$cat_id 	= $category_id;
				$this->session->set_userdata(array('cat_name'=> $cat_name,'cat_url'=>$base_url));
			}

			if(!empty($sub_cat_id) && is_numeric($sub_cat_id) ){
				$sub_cat_name = get_name_by_id('service_subcategory','name',array('id' =>$category_id));

				$base_url	.='/'.replace_space_with_dash($sub_cat_name);
				$sub_id 	= $sub_cat_id;
			}

			$config["base_url"] 	= $base_url;
			$config["total_rows"] 	= count($this->Front_service_model->get_count_services($cat_id, $sub_id));
			$config["per_page"] 	= 9;
			$config['use_page_numbers']  = TRUE;
			$config['page_query_string'] = TRUE; //?page=1 (False is off)
			$config["uri_segment"] 		 = 5;
			  
			$config['first_link'] 		= 'First';
			$config['first_tag_open'] 	= '<li class="page-item">';
			$config['first_tag_close'] 	= '</li>';
			
			$config['last_link'] 		= 'Last';
			$config['last_tag_open'] 	= '<li class="page-item">';
			$config['last_tag_close'] 	= '</li>';
			 
			$config['next_link'] 		= 'Next';
			$config['next_tag_open'] 	= '<li class="page-item">';
			$config['next_tag_close'] 	= '</li>';

			$config['prev_link'] 		= 'Prev';
			$config['prev_tag_open'] 	= '<li class="page-item">';
			$config['prev_tag_close'] 	= '</li>';

			$config['cur_tag_open'] 	= '<li class="page-item active">';
			$config['cur_tag_close'] 	= '</li>';

			$config['num_tag_open'] 	= '<li class="page-item">';
			$config['num_tag_close'] 	= '</li>';
			$this->pagination->initialize($config);
			$page = 0;

			$per_page = $this->input->get('per_page');
			if(!empty($per_page)){
				//$page = (int) ($_GET['per_page']) ? $_GET['per_page'] : 0;
				$page = (int) $this->input->get('per_page') ? $this->input->get('per_page'): 0;
			}

			if(!is_numeric($page)){
				redirect(base_url('services'));
			}

			$data["links"] = $this->pagination->create_links();
			$start = 0;

			
			if (!empty($page)) {
				$start = (($page - 1) * $config["per_page"]);
			}


			$breadcrumb = array();
			$breadcrumb['Home']         = base_url();
			if (!empty($cat_name)) {
				$breadcrumb[$cat_name]      = '';

			}else{
				$breadcrumb['Services'] = '';
				$this->session->set_userdata(array('cat_name'=> 'Services','cat_url'=>base_url().'services'));
			}

			$data['breadcrumb'] = $breadcrumb;
		
			$data['product_list'] 	= $this->Front_service_model->get_count_services($cat_id, $sub_id, $config["per_page"], $start);
			
			$data['cat_list'] 	= $this->Front_service_model->get_data(array('cat_id', 'name'), 'categories', array('is_active' => true, 'is_deleted' => false), '', 'display_order ASC');

			$data['cat_id'] 	= $cat_id;
			$data['sub_cat'] 	= $sub_cat_id;
			$data['title'] 		= 'Services - SPOCHUB';

			$data['subview'] 	= $this->load->view('front/services/index', $data, true);
			$this->load->view('front/include/main', $data);
		
	}

	/**
	 * Created by Aayusha K
	 * @param      null
	 * @return    	mixed|string
	 * Service listing page
	 */
	public function details($service_name = NULL,$service_id = NULL)
	{
		if (empty($service_id) || !is_numeric($service_id)) {
			$this->session->set_flashdata('error', 'Please select service first.');
			redirect(base_url() . 'services');exit();
		}
		$data 	= $this->Front_service_model->services_details($service_id);
		//Get product package details by id
		if (empty($data['services'])) {
			$this->session->set_flashdata('error', 'Services not found in database.');
			redirect(base_url() . 'services');
		}

		$s_name = $data['services']['service_name'];
		$seo_name = replace_space_with_dash($s_name);

		if ($service_name != $seo_name) {
			redirect(base_url().'service/'.$seo_name.'/'.$service_id);
			die();
		}

		$cat_name    = $this->session->userdata('cat_name') ? $this->session->userdata('cat_name') : NULL;
		$cat_url    = $this->session->userdata('cat_url') ? $this->session->userdata('cat_url') : NULL;

		$breadcrumb['Home']         = base_url();
		$breadcrumb[$cat_name]      = $cat_url;
		$breadcrumb[$s_name]        = '';  
        $data['breadcrumb']         = $breadcrumb;

                /*Social media share links. 
        Added by : Aayusha k*/
        $service_name = $seo_name;
        $data['email_share'] 	 = $this->email_share($service_name,$service_id);
        $data['twitter_share'] 	 = $this->twitter_share($service_name,$service_id);
        $data['facebook_share']  = $this->facebook_share($service_name,$service_id);
        $data['linkedin_share']	 = $this->linkedin_share($service_name,$service_id);
       // $data[''] 	 = $this->($product_name,$product_id); copy to clipboard

		$data['products_review'] 	 = array();
		$data['products_top_review'] = array();
		$data['title'] 				= 'Services Details - SPOCHUB';
		$data['subview'] 			= $this->load->view('front/services/views/view', $data, true);
		$this->load->view('front/include/main', $data);
	}
	/**
	 * Deepak K
	 * function client lead/enquiry
	 * @param       null
	 * @return    	mixed
	 */
	public function lead_enquiry()
	{	
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
		{
			$user_data = array();
			if (is_login() == true) {
				if ($this->session->userdata('user_type') == 'partner') {
					$sql = "SELECT user_id as id,first_name,last_name,email,phone_no as phone FROM users WHERE user_id='".$this->session->userdata('user_id')."' AND is_deleted = FALSE AND email_verify=true;";
				}
				if ($this->session->userdata('user_type') == 'client') {
					$sql = "SELECT id,first_name,last_name,email,phone FROM client WHERE id='".$this->session->userdata('user_id')."' AND is_deleted = FALSE AND email_verify=true;";
				}
				if ($this->session->userdata('user_type') == 'client' || $this->session->userdata('user_type') == 'partner') {
					$user_data = $this->Product_model->get_query($sql);
					if (!empty($user_data)) {
						$user_data = $user_data[0];
					}
				}
			}
			$data['user_data']  = $user_data;

			$data['service_id'] = $this->input->get('service_id',false);
			$data['service_type'] = $this->input->get('service_type',NULL);
			$data['title']	    =	'Enquiry';
			if ($this->input->get('service_type') == 'Lead') {
				$data['title']	=	'Lead';
			}
			$this->load->view('front/services/views/lead_form', $data);
		}else{
			die('No direct script access allowed');
		}
	}
	/* Aayusha Kapadni
	 * function client lead/enquiry
	 * @param       null
	 * @return    	mixed
	 */
	public function save_lead_enquiry()
	{
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
		{
		$this->form_validation->set_rules('phone','phone', 'trim|required');
		/*if($this->input->post('product_type') =='Lead'){
			$this->form_validation->set_rules('phone','phone', 'trim|required|is_unique[product_leads.phone]');
		}*/			
		if ($this->form_validation->run() == FALSE) {
			$message = array('status'=>false,'message'=>validation_errors());

		}else {
			$user_type 	= NULL;
			$type 		= 'Non Register';
			if ($this->session->userdata('user_type') == 'client' || $this->session->userdata('user_type') == 'partner') {
				$user_type = $this->session->userdata('user_type');
				$type = $this->input->post('user_id') ? 'Register' : 'Non Register';
			}	
			$insert = array(
				'service_id' 	=>  $this->input->post('service_id'),
				'first_name' 	=>  $this->input->post('first_name'),
				'last_name' 	=>  $this->input->post('last_name'),
				'email' 		=>  $this->input->post('email'),
				'phone' 		=>  trim($this->input->post('phone')),
				'service_type' 	=>  $this->input->post('service_type'),
				'user_type' 	=>  $user_type,
				'type' 			=>  $type,
				'created_on' 	=> current_date(),
			);
			
    		$this->db->insert('services_leads', $insert);
    		/***************** Service Mail ***********************/
    		$admin_mail = email_by_admin_role('spochubadmin');	

    		$contacts_data 	= $this->Front_Products_model->get_contact_of_lead($this->input->post('service_id'),'services');

			$service_name 	= $contacts_data['service_name'];
			$email_ids = array();
			if (!empty($contacts_data['contacts_data'])) {
				$emails = json_decode($contacts_data['contacts_data'],true);
				foreach ($emails as $email ) {
					$email_ids[] = array('email' =>$email['email'],'full_name' =>$email['name'] );
				}

			}

			$client_name 	= $this->input->post('first_name').' '.$this->input->post('last_name');
			$product_type 	= 'Lead';
			
			$arr = array(
						'body'		=>array(
							"{LeadOREnquiry}" 		=>$product_type,
							"{SERVICE_NAME}"		=>$service_name,
							"{CLIENT_NAME}"			=>$client_name,
							"{CLIENT_EMAIL}"		=>$this->input->post('email'),
							"{CLIENT_PHONE}"		=>$this->input->post('phone'),
						),
						'subject'	=>array("{SERVICE_NAME}" =>$service_name,"{LeadOREnquiry}" =>$product_type)
					);

			$mail_data= get_email_body('service_enquiry',$arr);
			if (!empty($email_ids)) {
				$this->Email_model->send_mail($mail_data['subject'], $mail_data['body'],$email_ids,$mail_data['from_mail'],'',$admin_mail);
			}else{
				$this->Email_model->send_mail($mail_data['subject'], $mail_data['body'],$admin_mail,$mail_data['from_mail'],$client_name);
			}
			//Email log
			email_activity_logs($mail_data['subject'],$mail_data['body'],json_encode($admin_mail),$this->input->post('service_id'));
			/***************** Service Mail ***********************/
			$message = array('status'=>true,'message'=>'Lead Submitted Successfully.');
		}
		echo json_encode($message);die();
		}else{
			die('No direct script access allowed');
		}
	}
	
	function lead_enquiry_is_unique($service_id,$service_type)
    {
    	if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
		{
    	$sql 	= "SELECT * from services_leads WHERE  phone = '".$this->input->post('phone')."' AND service_type = '".$service_type."' AND  service_id = ".$service_id;

		$result 	= $this->db->query($sql);
		$result_count = $result->num_rows();
		if ($result_count > 0) {
		
			echo  'false';
		}else{
			echo  'true';
		}
		}else{
			die('No direct script access allowed');
		}
    }

	/*Share link on social media*/
	public function facebook_share($service_name,$id)
	{
		$facebook_share_url = "https://www.facebook.com/sharer/sharer.php?u=".base_url("service/".$service_name."/".$id);
		return $facebook_share_url;
	}
	public function twitter_share($service_name,$id)
	{
		$twitter_share_url = "https://twitter.com/share?url=".base_url("service/".$service_name."/".$id)."&text=[".$service_name."]&via=[via]&hashtags=[hashtags]";
		return $twitter_share_url;
	}
	public function linkedin_share($service_name,$id)
	{
		$linkedin_share_url = "https://www.linkedin.com/shareArticle?mini=true&url=".base_url("service/".$service_name."/".$id);
		return $linkedin_share_url;
	}

	public function email_share($service_name,$id)
	{
		$email_share_url = "mailto:info@example.com?&subject=&cc=&bcc=&body=".base_url("service/".$service_name."/".$id)."%0A";
		return $email_share_url;
	}
/*eof share link of social media*/    

}

