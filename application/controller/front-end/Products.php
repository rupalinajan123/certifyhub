<?php
defined('BASEPATH') or exit('No direct script access allowed');
/*
	Class Name 		: 	Products
	Created By		: 	Deepak K
*/
class Products extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model( array('Front_Products_model','Email_model','Masters_model') );
		/*$keys = array('cat_name','cat_url'); // Delete front session
    	$this->session->unset_userdata($keys);*/
	}

	/**
	 * Created by Deepak k
	 * @param       null
	 * @return    	mixed|string
	 * Products listing page
	 */
	public function index($category_id = '')
	{
			$base_url = base_url() . "products";
			$cat_name = '';
			if ( !empty($category_id) && is_numeric($category_id) ) {

				$cat_name = get_name_by_id('categories','name',array('cat_id' =>$category_id));
				$base_url = base_url() . "products/" .replace_space_with_dash($cat_name);
				$this->session->set_userdata(array('cat_name'=> $cat_name,'cat_url'=>$base_url));
			}
 
			$this->load->library("pagination");
			$config = array();

			$total_rows 		= count($this->Front_Products_model->get_products_by_cat($category_id));

			$config["base_url"] 		= $base_url;
			$config["total_rows"] 		= $total_rows;
			$config["per_page"] 		= 4;
			$config['use_page_numbers'] = TRUE;
			$config['page_query_string'] = TRUE; //?page=1 (False is off)
			$config['query_string_segment'] = 'page';
			$config["uri_segment"] 		= 5;
			  
			$config['first_link'] 		= 'First';
			$config['first_tag_open'] 	= '<li class="page-item">';
			$config['first_tag_close'] 	= '</li>';
			
			$config['last_link'] 		= 'Last';
			$config['last_tag_open'] 	= '<li class="page-item">';
			$config['last_tag_close'] 	= '</li>';
			 
			$config['next_link'] 		= 'Next';
			$config['next_tag_open'] 	= '<li class="page-item">';
			$config['next_tag_close'] 	= '</li>';

			$config['prev_link'] 		= 'Previous';
			$config['prev_tag_open'] 	= '<li class="page-item">';
			$config['prev_tag_close'] 	= '</li>';

			$config['cur_tag_open'] 	= '<li class="page-item active"><a class="page-link" href="#">';
			$config['cur_tag_close'] 	= '</a></li>';

			$config['num_tag_open'] 	= '<li class="page-item">';
			$config['num_tag_close'] 	= '</li>';

			$config['attributes'] = array('class' => 'page-link');
			$this->pagination->initialize($config);
			
			$page = (int) ($this->input->get('page',false)) ? $this->input->get('page',false) : 0;
			$data["links"] = $this->pagination->create_links();
			$start = 0;
			if(!is_numeric($page)){
				redirect(base_url('products'));
				die();
			}
			if (!empty($page)) {
				$start = (($page - 1) * $config["per_page"]);
			}

			$breadcrumb = array();
			$breadcrumb['Home']             = base_url();
			if (!empty($cat_name)) {
				$breadcrumb[$cat_name]      = '';

			}else{
				$breadcrumb['Products'] = '';//base_url().'products';
				$this->session->set_userdata(array('cat_name'=> 'Products','cat_url'=>base_url().'products'));
			}
	
			$newest_product = $this->Front_Products_model->get_data(array('published_date'),'products', array('category_id'=>$category_id,'is_deleted' => false), '', '');	

			if(!empty($newest_product) || $newest_product == ''){
				$date    = date_converter($newest_product[0]['published_date'],'Y-m-d');
		        $current_date = date('Y-m-d');
		        $newdate = date("Y-m-d", strtotime ('+1 month' , strtotime($date)));
			}

			$data['product_list'] 	= $this->Front_Products_model->get_products_by_cat($category_id, $config["per_page"], $start);

			$data['cat_list'] 	    = $this->Front_Products_model->get_data(array('cat_id', 'name'), 'categories', array('is_active' => true, 'is_deleted' => false), '', 'display_order ASC');
            
           $cat_wise_prod = $this->Front_Products_model->get_category_wise_prod();	

        	if ($cat_wise_prod) {
        	   $data['cat_wise_prod'] = $cat_wise_prod;
        	}
			//echo"<pre>";print_r($data);die;
			

			$data['category_id'] 	= !empty($category_id) ? $category_id : '';
			$data['title'] 		    = 'Products - SPOCHUB';
			$data['subview'] 	    = $this->load->view('front/product/index', $data, true);
			$this->load->view('front/include/main', $data);
		
	}


	/**
	 * Created by Deepak k
	 * @param       null
	 * @return    	mixed|string
	 * Products details page
	 */
	public function details_old($product_name = null , $product_id = null)
	{
	    
	   // $_SESSION['callback_url']   = base_url().'product/'.$product_name.'/'.$product_id;
	    
	    // product/my-edu-product/539
	    
	   // $user_data = $_SESSION['user_data'];
	    
	   // print_r($_SESSION);exit;
	    
	   // if(empty($user_data)){
	       // redirect(base_url().'csc_connect/User.php');
	   // }
	    
		if (empty($product_id) || !is_numeric($product_id)) {
			$this->session->set_flashdata('error', 'Please select product first.');
			redirect(base_url() . 'products');exit();
		}
		$data 	= $this->Front_Products_model->get_package_details($product_id);
		//echo"<pre>";print_r($data); die;
		if (empty($data['products'])) {
			$this->session->set_flashdata('error', 'Product not found in database.');
			redirect(base_url());
			die();
		}
		$p_name   = $data['products']['product_name'];
		$seo_name = replace_space_with_dash($p_name);

		if ($product_name != $seo_name) {
			redirect(base_url().'product/'.$seo_name.'/'.$product_id);
			die();
		}

		$tracking_id = md5( time().config_item('encryption_key'));
						
	    $this->session->set_userdata(array('tracking_id'=> $tracking_id));
	
		referer_activity_logs($product_id,NULL,NULL,'add');

		$cat_name    = $this->session->userdata('cat_name') ? $this->session->userdata('cat_name') : NULL;
		$cat_url     = $this->session->userdata('cat_url') ? $this->session->userdata('cat_url') : NULL;

		$data['product_images']   = $product_images  = $this->Front_Products_model->get_data('*', 'product_images',array('product_id' =>$product_id));
		//print_r($product_images); die;

		$breadcrumb['Home']         = base_url();
		$breadcrumb[$cat_name]      = $cat_url;
		$breadcrumb[$p_name]        = ''; 
        $data['breadcrumb'] 		= $breadcrumb;
        //$data['package_type'] 		= $offer_data['package_type'];

        /*Social media share links. 
        Added by : Aayusha k*/
        $product_name = $seo_name;
        $data['email_share'] 	 = $this->email_share($product_name,$product_id);
        $data['twitter_share'] 	 = $this->twitter_share($product_name,$product_id);
        $data['facebook_share']  = $this->facebook_share($product_name,$product_id);
        $data['linkedin_share']	 = $this->linkedin_share($product_name,$product_id);
        $data['instagram_share']	 = $this->instagram_share($product_name,$product_id);
       // $data[''] 	 = $this->($product_name,$product_id); copy to clipboard
        
        $cat_wise_prod = $this->Front_Products_model->get_category_wise_prod();	

    	if ($cat_wise_prod) {
    	   $data['cat_wise_prod'] = $cat_wise_prod;
    	}
      
		$data['products_review'] 	 = $this->Front_Products_model->products_review($product_id);
		$data['products_top_review'] = $this->Front_Products_model->products_review($product_id,true);
		$data['title'] 				 = 'Product Details - SPOCHUB';
		$data['subview'] 			 = $this->load->view('front/product/product_details/view', $data, true);
		$this->load->view('front/include/main', $data);
	}
	public function details($product_id = null)
	{
	    
	   // $_SESSION['callback_url']   = base_url().'product/'.$product_name.'/'.$product_id;
	    
	    // product/my-edu-product/539
	    
	   // $user_data = $_SESSION['user_data'];
	    
	   // print_r($_SESSION);exit;
	    
	   // if(empty($user_data)){
	       // redirect(base_url().'csc_connect/User.php');
	   // }
	    
		if (empty($product_id) || !is_numeric($product_id)) {
			$this->session->set_flashdata('error', 'Please select product first.');
			redirect(base_url() . 'products');exit();
		}
		$data 	= $this->Front_Products_model->get_package_details($product_id);
		//echo"<pre>";print_r($data); die;
		if (empty($data['products'])) {
			$this->session->set_flashdata('error', 'Product not found in database.');
			redirect(base_url());
			die();
		}
		$p_name   = $data['products']['product_name'];
		$seo_name = replace_space_with_dash($p_name);

		// if ($product_name != $seo_name) {
		// 	redirect(base_url().'product/'.$seo_name.'/'.$product_id);
		// 	die();
		// }

		$tracking_id = md5( time().config_item('encryption_key'));
						
	    $this->session->set_userdata(array('tracking_id'=> $tracking_id));
	
		referer_activity_logs($product_id,NULL,NULL,'add');

		$cat_name    = $this->session->userdata('cat_name') ? $this->session->userdata('cat_name') : NULL;
		$cat_url     = $this->session->userdata('cat_url') ? $this->session->userdata('cat_url') : NULL;

		$data['product_images']   = $product_images  = $this->Front_Products_model->get_data('*', 'product_images',array('product_id' =>$product_id));
		//print_r($product_images); die;

		$breadcrumb['Home']         = base_url();
		$breadcrumb[$cat_name]      = $cat_url;
		$breadcrumb[$p_name]        = ''; 
        $data['breadcrumb'] 		= $breadcrumb;
        //$data['package_type'] 		= $offer_data['package_type'];

        /*Social media share links. 
        Added by : Aayusha k*/
        $product_name = $seo_name;
        $data['email_share'] 	 = $this->email_share($product_name,$product_id);
        $data['twitter_share'] 	 = $this->twitter_share($product_name,$product_id);
        $data['facebook_share']  = $this->facebook_share($product_name,$product_id);
        $data['linkedin_share']	 = $this->linkedin_share($product_name,$product_id);
        $data['instagram_share']	 = $this->instagram_share($product_name,$product_id);
       // $data[''] 	 = $this->($product_name,$product_id); copy to clipboard
        
        $cat_wise_prod = $this->Front_Products_model->get_category_wise_prod();	

    	if ($cat_wise_prod) {
    	   $data['cat_wise_prod'] = $cat_wise_prod;
    	}
      
		$data['products_review'] 	 = $this->Front_Products_model->products_review($product_id);
		$data['products_top_review'] = $this->Front_Products_model->products_review($product_id,true);
		$data['title'] 				 = 'Product Details - SPOCHUB';
		$data['subview'] 			 = $this->load->view('front/product/product_details/view', $data, true);
		$this->load->view('front/include/main', $data);
	}
	/**
	 * Aayusha Kapadni
	 * function client lead/enquiry
	 * @param       null
	 * @return    	mixed
	 */
	public function lead_enquiry()
	{	

		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
		{

			$data['product_id'] 	= $this->input->get('product_id',false);
			$data['product_type'] 	= $this->input->get('product_type',NULL);
			$action_type 			= $this->input->get('action_type',NULL);
			//print_r($action_type); die;
			if ($action_type == 'free_trial') {
				$data['title']	=	'Provide your details for free trial';
			}else if($action_type == 'enquiry'){
				$data['title']	=	'Enquiry';
			}
			else{
				$data['title']	 =	'Lead';
			}
			$data['action_type'] = $action_type;
			$this->load->view('front/product/product_details/product_lead', $data);
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
			$this->form_validation->set_rules('phone','phone', 'trim|required');
			$this->form_validation->set_rules('email','email', 'trim|required');
			
			if ($this->form_validation->run() == FALSE) {
				$message = array('status'=>false,'message'=>validation_errors());
			}
			else
			{ 	$action_type = $this->input->post('action_type');
				//check if lead/enquiry already submitted for same mobile no./product/type
			if($action_type=='free_trial'){

				$sql = "SELECT * from product_leads WHERE action_type = '".$this->input->post('action_type')."' AND email = '".$this->input->post('email')."' AND product_type = '".$this->input->post('product_type')."' AND  product_id = ".$this->input->post('product_id') ;
					$error = array('status'=>false,'message'=>'Email already submitted.');

				}else{
				$sql = "SELECT * from product_leads WHERE action_type = '".$this->input->post('action_type')."' AND phone = '".$this->input->post('phone')."' AND product_type = '".$this->input->post('product_type')."' AND  product_id = ".$this->input->post('product_id') ;
					$error = array('status'=>false,'message'=>'Phone number already submitted.');
				}
				$result = $this->db->query($sql);
				$result_count = $result->num_rows();
				if ($result_count > 0)
				{
					$message = $error;	
				}
				else{
						
					$insert = array(
						'product_id' 	=>  $this->input->post('product_id'),
						'first_name' 	=>  $this->input->post('first_name'),
						'last_name' 	=>  $this->input->post('last_name'),
						'email' 		=>  $this->input->post('email'),
						'phone' 		=>  $this->input->post('phone'),
						'product_type' 	=>  $this->input->post('product_type'),
						'action_type'	=> 	$action_type,
						'created_on' 	=> current_date(),
						'message' 		=> $this->input->post('message'),
						'whatsappchk' 	=> $this->input->post('whatsappcheck'),
					);	
						$this->db->insert('product_leads', $insert);
						user_activity_logs($action_type."is submited.",json_encode($insert));


		    		/***************** Product lead/enqury Mail ***********************/

		    		$admin_mail = email_by_admin_role('spochubadmin');	

					$contacts_data 	= $this->Front_Products_model->get_contact_of_lead($this->input->post('product_id'),'products');
					if($this->input->post('action_type') == 'lead')
		    		{
						$product_type 	= "Lead";
					}elseif($this->input->post('action_type') == 'free_trial'){
						$product_type 	= 'Free Trial';

						$free_trial_link = "";
						$free_trial_link = $this->Front_Products_model->get_free_trial_link($this->input->post('product_id'));
						$free_trial_link = $free_trial_link[0]['free_trial_link'];
					
					}else{
						$product_type 	= 'Enquiry';
					}
					$product_name 	= ucfirst($contacts_data['product_name']);
					$email_ids = array();
					if (!empty($contacts_data['contacts_data'])) {
						$emails = json_decode($contacts_data['contacts_data'],true);
						foreach ($emails as $email ) {
							$email_ids[] = array('email' =>$email['email'],'full_name' =>$email['name'] );
						}
					}
					$client_mail = $this->input->post('email');
					
					$client_name = $this->input->post('first_name').' '.$this->input->post('last_name');
					$html = "";
					if(!empty($free_trial_link)){
						$html ='<b>You can access Product by clicking on below Link:</b></br><a href="'.$free_trial_link.'">'.$free_trial_link.'</a><br><br>';
							
					}else{
						$html = 'You will receive the Product Access Link in a separate email.<br><br>';
					}
					$arr2 = array(
						'body'		=>array(
							"{PRODUCT_NAME}"		=>$product_name,
							"{FREE_TRIAL_URL}"		=>$html,),	
						);	

					$arr = array(
						'body'		=>array(
							"{LeadOREnquiry}" 		=>$product_type,
							"{PRODUCT_NAME}"		=>$product_name,
							"{CLIENT_NAME}"			=>$client_name,
							"{CLIENT_EMAIL}"		=>$this->input->post('email'),
							"{CLIENT_PHONE}"		=>$this->input->post('phone'),
						),
						'subject'	=>array("{PRODUCT_NAME}" =>$product_name,"{LeadOREnquiry}" =>$product_type)
					);
									
					/*Email sending For free trial admin & client*/
					if($this->input->post('action_type') == 'free_trial'){

						$mail_data  = get_email_body('free_trial_lead',$arr);	
						$mail_data2 = get_email_body('free_trial_enquiry',$arr2);

						$this->Email_model->send_mail($mail_data['subject'], $mail_data['body'],$admin_mail,$mail_data['from_mail'],'',$admin_mail);
						//Email log
						email_activity_logs($mail_data['subject'],$mail_data['body'],json_encode($admin_mail),'1','Admin');
						
						$this->Email_model->send_mail($mail_data2['subject'], $mail_data2['body'],$client_mail,$mail_data2['from_mail'],'',$client_name);
						//Email log
						email_activity_logs($mail_data2['subject'],$mail_data2['body'],$client_mail,NULL,'Client');
					
					}
					/*email sending for Lead or enquiry*/
					if($this->input->post('action_type') == 'lead' OR $this->input->post('action_type') == 'enquiry' )
		    		{
						$mail_data= get_email_body('product_lead',$arr);
					

					if (!empty($email_ids)) {
						//$this->Email_model->send_mail($mail_data['subject'], $mail_data['body'],$email_ids,$mail_data['from_mail'],'',$admin_mail);
					}else{

						//$this->Email_model->send_mail($mail_data['subject'], $mail_data['body'],$admin_mail,$mail_data['from_mail'],$client_name);
					}
					//Email log
					email_activity_logs($mail_data['subject'],$mail_data['body'],json_encode($admin_mail),$this->input->post('product_id'));
					}

					/***************** /Mail ***********************/

		    		if($this->input->post('action_type') == 'free_trial')
		    		{	
		    			$message = array('status'=>true,'message'=>'Enquiry for Free Trial Submitted Successfully.');
		    		}else if($this->input->post('action_type') == 'enquiry'){
		    			$message = array('status'=>true,'message'=>'Enquiry Submitted Successfully.');
		    		}else{
		    			$message = array('status'=>true,'message'=>'Lead Submitted Successfully.');
		    		}
				}
			}
		echo json_encode($message); die();
		}else{
			die('No direct script access allowed');
		}
	}

	public function lead_enquiry_is_unique($product_id,$product_type,$action_type)
    { 

    	if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
		{
	    	if($action_type =="free_trial"){
	    		$sql = "SELECT * from product_leads WHERE action_type = '".$action_type."' AND email = '".$this->input->post('email')."' AND product_type = '".$product_type."' AND  product_id = ".$product_id;
	    	}else{
	    	$sql = "SELECT * from product_leads WHERE action_type = '".$action_type."' AND phone = '".$this->input->post('phone')."' AND product_type = '".$product_type."' AND  product_id = ".$product_id;
	    	}

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

	/**
	 * Created by deepak K
	 * @param       $token
	 * @return    	mixed|string
	 *  Product summary page by 
	 */
	public function private_offer($token=NULL)
	{
		if (empty($token) ) {
			$this->session->set_flashdata('error', 'Please select product.');
			redirect(base_url() . 'products');exit();
		}

		$offer_data = $this->Front_Products_model->get_data('*', 'private_offers',array('token' =>$token));
		$offer_data = $offer_data[0];
		//print_r($offer_data);

		$start_date	= date('Y-m-d',strtotime($offer_data['start_date']));
		$end_date	= date('Y-m-d',strtotime($offer_data['end_date']));

		//Check start date and end date of private offer
		if($start_date <= date('Y-m-d') &&  $end_date >= date('Y-m-d') ){

			if (!empty($offer_data['converted_on'])) {
				$this->session->set_flashdata('error', 'You use maximum number of offer.');
				redirect(base_url() . 'products');exit();
			}
			
			$product_id = $offer_data['product_id'];
			$data 	= $this->Front_Products_model->get_package_details($product_id);
			$product_details = $this->Front_Products_model->get_data(array('product_name','id'), 'products',array('id' =>$product_id));				
			$data['product_details'] = (!empty($product_details) ? $product_details[0] : array());			
			$data['package_details'] = json_decode($offer_data['package_data'],true);	
			$data['product_id'] 		 = $product_id;
			$data['private_offer_id'] 	 = $offer_data['id'];
			$data['package_type'] 		 = $offer_data['package_type'];		
			$data['products_review'] 	 = $this->Front_Products_model->products_review($product_id);
			$data['products_top_review'] = $this->Front_Products_model->products_review($product_id,true);
			$data['title'] 				 = 'Product Details - SPOCHUB';
			$data['subview'] 			 = $this->load->view('front/product/product_details/view', $data, true);
			$this->load->view('front/include/main', $data);
		}else{
			$this->session->set_flashdata('error', 'Private offer is expired.');
			redirect(base_url() . 'home');exit();
		}

	}


	public function package_details()
	{
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
		{
			
			$package_id = $this->input->post('package_id');

			$package  = $this->Front_Products_model->get_data(array('d.id as package_id', 'd.package_name','d.implementation_amount','d.features_amount'), 'product_package_details d',array('d.id'=>$package_id,'d.is_deleted' =>false));

			$pkg_cost = '<b>Package Cost: </b>'. get_currency(number_format(($package[0]['implementation_amount']+$package[0]['features_amount']),2)).' /-';

			echo json_encode(array('status'=>true,'package_id' =>$package[0]['package_id'] ,'pkg_cost' => $pkg_cost ));

		}else{
			die('No direct script access allowed');
		}

	}

/*Share link on social media*/
	public function facebook_share($product_name,$product_id)
	{
		$facebook_share_url = "https://www.facebook.com/sharer/sharer.php?u=".base_url("product/".$product_name."/".$product_id);
		return $facebook_share_url;
	}
	public function twitter_share($product_name,$product_id)
	{
		$twitter_share_url = "https://twitter.com/share?url=".base_url("product/".$product_name."/".$product_id)."&text=".ucfirst($product_name)."&hashtags=SPOCHUB";
		return $twitter_share_url;
	}
	public function linkedin_share($product_name,$product_id)
	{
		$linkedin_share_url = "https://www.linkedin.com/shareArticle?mini=true&url=".base_url("product/".$product_name."/".$product_id);
		return $linkedin_share_url;
	}
	public function email_share($product_name,$product_id)
	{
		$email_share_url = "mailto:?&from=info@gstefile.com&subject=Check out ".ucfirst($product_name).' Product at SPOCHUB'."&body= Share Link : ".base_url("product/".$product_name."/".$product_id)."%0A";
		return $email_share_url;
	}
	public function instagram_share($product_name,$product_id)
	{
		$instagram_share_url = "https://www.instagram.com/?url=".base_url("product/".$product_name."/".$product_id);
		return $instagram_share_url;
	}
/*eof share link of social media*/

/* Show video on POPUP */
	public function show_video()
	{	
		$product_id	= $this->input->post('product_id');	
		$data 		= $this->Front_Products_model->get_package_details($product_id);
		$data['video'] = $data['products']['video'];
		$body = $this->load->view('front/product/video_popup', $data, true);
		echo json_encode(array('status' => true, 'body' => $body));
		die();
	}
	
	public function order_summary()
    {
        // echo'<pre>';print_r($data);echo'</pre>';//exit;
        $data['title'] 		= 'Order Summury';
		$cat_wise_prod = $this->Front_Products_model->get_category_wise_prod();	

    	if ($cat_wise_prod) {
    	   $data['cat_wise_prod'] = $cat_wise_prod;
    	}
        $data['subview'] 	= $this->load->view('front/product/order-summary', $data, true);
        $this->load->view('front/include/main', $data);
    }
    
    public function checkout_product()
    {
        $product_id = $_POST['product_id'];
        // echo $product_id;exit;
	    
	    if ((empty($product_id) || !is_numeric($product_id))) {
            $this->session->set_flashdata('error', 'Please select product first.');
            //redirect($site_url);exit();
			redirect(base_url());exit();
        }
        
        $product_details = $this->Masters_model->get_data(array('product_name','id','price','mrp','logo'), 'products',array('id' =>$product_id));
        
        $data['product_details'] 	= (!empty($product_details) ? $product_details[0] : array());
        
        $data['client_details'] 	= array();
		if(!empty($this->session->userdata('user_id')) && $this->session->userdata('user_type')=='client'){
		    
		    $select = array('concat(first_name,\' \',last_name) as name','company','phone','email','address1','countries.name as country_name','states.name as state_name');
			$joins 	= array(
					'countries'	=> 'countries.code = c.country',
					'states'	=> 'states.code = c.state and states.country = c.country'
					);
			$where 	= array('c.id'=> $this->session->userdata('user_id'), 'c.is_deleted'=> false);
			
			$client_details = $this->Masters_model->get_data($select,'client c',$where,$joins);
			$data['client_details'] = $client_details[0];
		}
        
        // echo'<pre>';print_r($data);echo'</pre>';//exit;
        $checkout 	= $this->load->view('front/product/checkout', $data, true);
        echo $checkout;exit;
    }
    
    public function checkout()
	{
	    $data               = [];
	    $prod_ids           = $this->input->post('hid_id');
		$data['price']      = $price = number_format($this->input->post('hid_price'), 2);
		$data['prod_qty']   = $prod_qty = $this->input->post('hid_qty');
		$data['proctor_test']= $proctor_test = number_format($this->input->post('hid_proctor_test'), 2);
		$data['video_based_course']= $video_based_course = number_format($this->input->post('hid_video_based_course'), 2);
		$data['practice_test']= $practice_test = number_format($this->input->post('hid_practice_test'), 2);
		$data['gst']        = $gst = $this->input->post('hid_gst');
		$data['gst_price']  = $gst_price = number_format($this->input->post('hid_gst_price'), 2);
		$data['sub_total']  = $sub_total = number_format($this->input->post('hid_sub_total'), 2);
		$data['total_due']  = $total_due = number_format($this->input->post('hid_total_due'), 2);
		
        // Additional Information
        $name       = $this->input->post('name');
        $phone      = $this->input->post('phone');
        $email      = $this->input->post('email');
        $age        = $this->input->post('age');
        $id_nummber = $this->input->post('id_nummber');
        $address    = $this->input->post('address');
        $client_id  = $this->input->post('session_user_id');
        $session_array['order_num'] = $order_num  = date('Ymdhis');
        
        $plan_details = array(
            'name'      => $name,
            'phone'     => $phone,
            'email'     => $email,
            'age'       => $age,
            'id_nummber'=> $id_nummber,
            'price'     => $price,
            'prod_qty'  => $prod_qty,
            'proctor_test'=> $proctor_test,
            'video_based_course'=> $video_based_course,
            'practice_test'=> $practice_test,
            'gst'       => $gst,
            'gst_price' => $gst_price,
            'sub_total' => $sub_total,
            'total_due' => $total_due,
            'client_id' => $client_id,
        );
        
        $client_orders_data = array(
            'client_id' => $client_id,
            'order_num' => $order_num,
            'plan_details' => json_encode($plan_details),
            'qty'       => $prod_qty,
            'status'    => 'Pending',
            'order_date'=> date('Y-m-d h:i:s'),
            'created_by_id' => $client_id,
            'created_on'=> date('Y-m-d h:i:s'),
			'policy_check'=> $this->input->post('policy_chk'),
        );
        
        //if($this->session->userdata('order_id') ==''){
            $this->db->insert('client_orders', $client_orders_data);
            // echo $this->db->last_query();exit;
            $session_array['order_id'] = $this->db->insert_id();
            
            if($session_array['order_id'])
            {
                $client_order_product_data = array(
                    'client_id' => $client_id,
                    'order_id'  => $session_array['order_id'],
                    'product_id'=> $prod_ids,
                    //'status'    => 'Pending',
                    'created_by_id' => $client_id,
                    'created_on'=> date('Y-m-d h:i:s'),
                );
                $this->db->insert('client_order_product', $client_order_product_data);
            }
        //}
        
        // user_activity_logs($action_type."is submited.",json_encode($insert));
        
        if(isset($_POST['submit']) && !empty($_POST['submit'])){
		    $this->session->set_userdata($session_array);
	    	if (!empty($client_id)) {
	    	  //  echo $url;exit;
	    	  //echo ENVIRONMENT;exit;
	    	  $payment_gateway = $this->Masters_model->get_data(array('*'), 'payment_settings', array('is_active' => 'true'), NULL, NULL, 0, 1);
	    	  
	    	   if(!empty($payment_gateway)){
	    	    $payment_data = json_decode($payment_gateway[0]['payment_data'], true);   
	    	    
	    	    if(ENVIRONMENT =='production' && $payment_data['mode']=='production'){
    	            $data['url']            = $payment_data['production_other_key'];
    				$data['merchantID']     = $payment_data['production_merchant_id'];
    				//$data['aggregatorID']   = $payment_data['production_merchant_key'];
    				$data['key']            = $payment_data['production_secret_key'];
	    	    }
	    	    else{
    	            $data['url']            = $payment_data['sandbox_other_key'];
        			$data['merchantID']     =  $payment_data['sandbox_merchant_id'];
        			$data['aggregatorID']   =  $payment_data['sandbox_merchant_key'];
        			$data['key']            = $payment_data['sandbox_secret_key'];
	    	    }
	    	   
				$data['merchantTxnNo']  = date("YmdHis");
				$data['amount']         = $this->input->post('hid_total_due');//min amt 51
				$data['currencyCode']   = "356";
				$data['payType']        = "0";
				$data['transactionType']= "SALE";
				$data['returnURL']      = base_url().'pay-return';
				$data['txnDate']        = date("YmdHis");
				$data['customerEmailId']= $email;
				$data['customerMobileNo']= $phone;
				$data['addlParam1']     = "Ref1^Ref2^Ref3^Ref4";
				$hashString = $data['addlParam1']."".$data['aggregatorID']."".$data['amount']."".$data['currencyCode']."".$data['customerEmailId']."".$data['customerMobileNo']."".$data['merchantID']."".$data['merchantTxnNo']."".$data['payType']."".$data['returnURL']."".$data['transactionType']."".$data['txnDate'];
				
				$data['secureHash'] = hash_hmac('SHA256', $hashString, $data['key']);
	    	   }
	    	}else{
	    		return false;
	    	}
		    
		}
		
// 		echo'<pre>';print_r($data);exit;

	   // $data['title'] = 'checkout';
	   // $this->load->view('front/product/checkout_submit', $data);
	    
	    $data['title'] 		= 'checkout';
        $data['subview'] 	= $this->load->view('front/product/checkout_submit', $data, true);
        $this->load->view('front/include/main', $data);
	}

	public function payreturn()
	{
	   // echo'<pre>';print_r($_REQUEST);//exit;
	   // echo'<pre>';print_r($this->session->userdata());exit;
	    
	    
	   // [pay-return] => 
        // [secureHash] => 0e09b60c5e8ca71ce77674c6e8fe35979d3ac36cc62b89c19bd86526cb65aa97
        // [amount] => 1.00
        // [respDescription] => Transaction successful
        // [paymentMode] => UPI
        // [aggregatorID] => J_99141
        // [oth_charge] => false
        // [responseCode] => 0000
        // [merchantId] => T_99141
        // [paymentID] => 369710122625
        // [merchantTxnNo] => 20230201134234
        // [addlParam1] => Ref1^Ref2^Ref3^Ref4
        // [paymentDateTime] => 20230201134317
        // [txnID] => T003838266667
	    
	    if ($this->session->userdata('order_id') != '' && $this->session->userdata('user_id') != '') {
	        $query      = $this->db->query("SELECT * FROM client_orders WHERE id= " . $this->session->userdata('order_id'));
            $order_data = $query->result_array();
            $invoice_num = 'F00' . $this->session->userdata('order_id');
			$client_id = $this->session->userdata('user_id');
			$order_id=$this->session->userdata('order_id');
            $insert = array(
                'sub_total'      => $this->input->post('amount'),
                'total'          => $this->input->post('amount'),
                'client_id'      => $client_id,
                'order_id'       => $order_id,
                'invoice_num'    => $invoice_num,
                'payment_method' => $this->input->post('paymentMode'),
                'cust_type'      => 'client',
                'created_on'     => current_date(),
                'paid_date'       => date('Y-m-d'),
                'invoice_date'  => date('Y-m-d'),
            );
            $result     = $this->db->insert('client_invoices', $insert);
            $_SESSION['invoice_id'] = $invoice_id = $this->db->insert_id();
			
            if ($invoice_id) {

                $insert_trans_array = array(
                    'client_id'        => $client_id,
                    'invoice_id'       => $invoice_id,
                    'transaction_id'   => $this->input->post('txnID'),
                    'amount_in'        => $this->input->post('amount'),
                    'gateway'          => 'payphi',
                    'bank_name'        => $this->input->post('paymentMode'),
                    'status'           => $this->input->post('respDescription'),
                    'gateway_txn_id'   => $this->input->post('txnID'),
                    'transaction_date' => current_date(),
                    'created_on'       => current_date(),
                );

                $results        = $this->db->insert('transactions', $insert_trans_array);
                $transaction_id = $this->db->insert_id();
                if ($this->input->post('respDescription') == 'Transaction rejected') {
                    $transactions_flag = 0;
                } elseif ($this->input->post('respDescription') == 'Transaction successful') {
                    
                    // update client_invoice
                    $this->db->where('id', $invoice_id);
                    $this->db->update('client_invoices', array('status' => 'Paid'));
                    
                    $transactions_flag = 1;

					$cod_id = get_name_by_id('client_order_product','id',array('order_id'=> $order_id));
					$product_id = get_name_by_id('client_order_product','product_id',array('order_id'=> $order_id));
					$product_name = get_name_by_id('products','product_name',array('id'=>$product_id));
					$inser_data = array(
						'invoice_id' 		=> $invoice_id,
						'client_id' 		=> $client_id,
						'amount' 			=> $this->input->post('amount'),
						'order_product_id' 	=> $cod_id,
						'invoice_desc' 		=> $product_name,
						'type' 				=> 'invoice'
					);
	
					//user_activity_log
					user_activity_logs("Client: Invoice is created, Invoice id: ".$invoice_id, json_encode($inser_data));
					$results = $this->db->insert('invoice_details', $inser_data);
				
					// Update invoice status
					$update_invoices = array(
						'invoice_num' 		=> auto_increment_master('invoice_auto_increment'),
						'status' 			=> $this->input->post('respDescription') == "Transaction successful" ? 'Paid' : 'Unpaid',
						'paid_date' 		=> current_date(),
						'updated_on' 		=> current_date(),
						'updated_by_id' 	=> $client_id,
					);
					$this->db->where('id', $invoice_id);
					$this->db->update('client_invoices', $update_invoices);
					
					//referer log
					referer_activity_logs(NULL,$order_id,$update_invoices['status'],'update');
					//user_activity_log
					user_activity_logs("Client : Invoice status updated, Invoice id: ".$invoice_id, json_encode($update_invoices));

					// Update order status

					$update_orders = array(
						'status' 		=> 'Complete',
						'remark' 	=> '',
					);
					$this->db->where('id', $order_id);
					$this->db->update('client_orders', $update_orders);
					$status = 'Complete';
					$remark = '';
					//admin_activity_log
					user_activity_logs("Order status Updated, Order ID -".$order_id, "ID: ".$order_id.' '."Status: ".$status." Remark:".$remark);

					$update_orders_prod = array(
						'status' 		=> 'Active',
					);
					$this->db->where('order_id', $order_id);
					$this->db->update('client_order_product', $update_orders_prod);
					$data = array("success" => 1, "msg" => 'Transactions details added successfully', "error" => 0, "status" => 1, 'transactions_flag' => $transactions_flag, 'order_id' => $order_id);
					$title = 'Transaction successful';
		        
                } else {
                    $transactions_flag = 2;
                }
				$data = array("success" => 0, "data" => array(), "msg" => 'Transactions not added', "error" => 1, "status" => 0, 'transactions_flag' => $transactions_flag);
                $title = 'Transaction rejected';
               
            } else {
				$transactions_flag = 2;
                $data = array("success" => 0, "data" => array(), "msg" => 'Transactions not added', "error" => 1, "status" => 0, 'transactions_flag' => $transactions_flag);
                $title = 'Transaction rejected';
            }
        }

        $data['title'] 		= $title;
        $data['subview'] 	= $this->load->view('front/product/payreturn', $data, true);
        $this->load->view('front/include/main', $data);

	}

	public function sample_page()
	{
		// echo "hii"; exit;
			$base_url = base_url() . "products";
			$cat_name = '';
			if ( !empty($category_id) && is_numeric($category_id) ) {

				$cat_name = get_name_by_id('categories','name',array('cat_id' =>$category_id));
				$base_url = base_url() . "products/" .replace_space_with_dash($cat_name);
				$this->session->set_userdata(array('cat_name'=> $cat_name,'cat_url'=>$base_url));
			}
 
			$this->load->library("pagination");
			$config = array();

			$total_rows 		= count($this->Front_Products_model->get_products_by_cat($category_id));

			$config["base_url"] 		= $base_url;
			$config["total_rows"] 		= $total_rows;
			$config["per_page"] 		= 4;
			$config['use_page_numbers'] = TRUE;
			$config['page_query_string'] = TRUE; //?page=1 (False is off)
			$config['query_string_segment'] = 'page';
			$config["uri_segment"] 		= 5;
			  
			$config['first_link'] 		= 'First';
			$config['first_tag_open'] 	= '<li class="page-item">';
			$config['first_tag_close'] 	= '</li>';
			
			$config['last_link'] 		= 'Last';
			$config['last_tag_open'] 	= '<li class="page-item">';
			$config['last_tag_close'] 	= '</li>';
			 
			$config['next_link'] 		= 'Next';
			$config['next_tag_open'] 	= '<li class="page-item">';
			$config['next_tag_close'] 	= '</li>';

			$config['prev_link'] 		= 'Previous';
			$config['prev_tag_open'] 	= '<li class="page-item">';
			$config['prev_tag_close'] 	= '</li>';

			$config['cur_tag_open'] 	= '<li class="page-item active"><a class="page-link" href="#">';
			$config['cur_tag_close'] 	= '</a></li>';

			$config['num_tag_open'] 	= '<li class="page-item">';
			$config['num_tag_close'] 	= '</li>';

			$config['attributes'] = array('class' => 'page-link');
			$this->pagination->initialize($config);
			
			$page = (int) ($this->input->get('page',false)) ? $this->input->get('page',false) : 0;
			$data["links"] = $this->pagination->create_links();
			$start = 0;
			if(!is_numeric($page)){
				redirect(base_url('products'));
				die();
			}
			if (!empty($page)) {
				$start = (($page - 1) * $config["per_page"]);
			}

			$breadcrumb = array();
			$breadcrumb['Home']             = base_url();
			if (!empty($cat_name)) {
				$breadcrumb[$cat_name]      = '';

			}else{
				$breadcrumb['Products'] = '';//base_url().'products';
				$this->session->set_userdata(array('cat_name'=> 'Products','cat_url'=>base_url().'products'));
			}
	
			$newest_product = $this->Front_Products_model->get_data(array('published_date'),'products', array('category_id'=>$category_id,'is_deleted' => false), '', '');	

			if(!empty($newest_product) || $newest_product == ''){
				$date    = date_converter($newest_product[0]['published_date'],'Y-m-d');
		        $current_date = date('Y-m-d');
		        $newdate = date("Y-m-d", strtotime ('+1 month' , strtotime($date)));
			}

			$data['product_list'] 	= $this->Front_Products_model->get_products_by_cat($category_id, $config["per_page"], $start);

			$data['cat_list'] 	    = $this->Front_Products_model->get_data(array('cat_id', 'name'), 'categories', array('is_active' => true, 'is_deleted' => false), '', 'display_order ASC');
            
           $cat_wise_prod = $this->Front_Products_model->get_category_wise_prod();	

        	if ($cat_wise_prod) {
        	   $data['cat_wise_prod'] = $cat_wise_prod;
        	}
			$data['category_id'] 	= !empty($category_id) ? $category_id : '';
			$data['title'] 		    = 'Products - SPOCHUB';
			$data['subview'] 	    = $this->load->view('front/product/sample_page_view', $data, true);
			$this->load->view('front/include/main', $data);
	}

	

}

