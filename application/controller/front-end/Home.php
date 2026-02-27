<?php
defined('BASEPATH') or exit('No direct script access allowed');
/*
	Class Name 		: 	Home
	Created By		: 	Deepak K
*/
class Home extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model( array('Front_Products_model','Front_service_model','Email_model') );
		
		$keys = array('product_id','package_id','quantity','prev_url','client_custom_fields_data','user_m_download_url'); 
		// Delete front session
    	// $this->session->unset_userdata($keys);
	}

	/**
	 * Created by Deepak k
	 * @param       null
	 * @return    	mixed|string
	 * Home page
	 */
	public function index()
	{
		$data['title'] 		= 'CSC E-Governance';
		
		$data['cat_data'] 	= $this->Front_Products_model->get_data(array('cat_id','name','logo'), 'categories', array('is_active' => true, 'is_deleted' => false),'','display_order ASC');
		$data['product_list'] 	= $this->Front_Products_model->get_products();
	
		$sql  = "SELECT * FROM testimonials WHERE is_deleted = 'false' AND is_active = 'true' ORDER BY id DESC";
		$testimonial_data = $this->Front_Products_model->get_query($sql);
		$data['testimonial_data']  = $testimonial_data;

		$data['subview'] 	= $this->load->view('front/index', $data, true);
	//	$this->load->view('front/include/main', $data);
	}


	/**
	 * Created by Deepak k
	 * @param       null
	 * @return    	mixed|string
	 * contact us
	 */
	public function contact_us()
	{
		$cat_wise_prod = $this->Front_Products_model->get_category_wise_prod();	

		if ($cat_wise_prod) {
			$data['cat_wise_prod'] = $cat_wise_prod;
		}
		$product_list = array();
		foreach($cat_wise_prod as $key => $value){
			foreach($value as $val){
			$product_list[$val['id']]= $val['product_name'];
			}
		}
		// echo '<pre>';
		// print_r($product_list);
		// exit;
		$data['product_list'] = $product_list;
		$data['title'] 		= 'Contact Us';
		$data['subview'] 	= $this->load->view('front/contact-us', $data, true);
		$this->load->view('front/include/main', $data);
	}

	/**
	 * Created by Deepak k
	 * @param       null
	 * @return    	mixed|string
	 * privacy policy
	 */
	public function privacy_policy()
	{
		$cat_wise_prod = $this->Front_Products_model->get_category_wise_prod();	

		if ($cat_wise_prod) {
			$data['cat_wise_prod'] = $cat_wise_prod;
		}
		$data['title'] 		= 'Privacy Policy - SPOCHUB';
		$data['subview'] 	= $this->load->view('front/privacy-policy-new', $data, true);
		$this->load->view('front/include/main', $data);
	}

	/**
	 * Created by Deepak k
	 * @param       null
	 * @return    	mixed|string
	 * Marketplace Terms
	 */
	public function marketplace_terms()
	{
		$data['title'] 		= 'Marketplace Terms - SPOCHUB';
		//acceptable-usepolicy
		$data['subview'] 	= $this->load->view('front/marketplace-terms', $data, true);
		$this->load->view('front/include/main', $data);
	}

	/**
	 * Created by Deepak k
	 * @param       null
	 * @return    	mixed|string
	 * acceptable-use-policy
	 */
	public function acceptable_use_policy()
	{
		$data['title'] 		= 'Acceptable Use Policy - SPOCHUB';
		$data['subview'] 	= $this->load->view('front/acceptable-usepolicy', $data, true);
		$this->load->view('front/include/main', $data);
	}

	/**
	 * Created by Deepak k
	 * @param       null
	 * @return    	mixed|string
	 * Terms of Service
	 */
	public function terms_of_service()
	{
		$cat_wise_prod = $this->Front_Products_model->get_category_wise_prod();	

		if ($cat_wise_prod) {
			$data['cat_wise_prod'] = $cat_wise_prod;
		}
		$data['title'] 		= 'Terms of Service - SPOCHUB';
		$data['subview'] 	= $this->load->view('front/terms_of_service', $data, true);
		$this->load->view('front/include/main', $data);
	}
	
	public function leadership_team()
	{
		$data['title'] 		= 'Leadership Team - SPOCHUB';
		$data['subview'] 	= $this->load->view('front/leadership_team', $data, true);
		$this->load->view('front/include/main', $data);
	}

	public function about_us()
	{
		$cat_wise_prod = $this->Front_Products_model->get_category_wise_prod();	

		if ($cat_wise_prod) {
			$data['cat_wise_prod'] = $cat_wise_prod;
		}
		$data['title'] 		= 'About Us ';
		$data['subview'] 	= $this->load->view('front/about_us', $data, true);
		$this->load->view('front/include/main', $data);
	}

	public function billing_model()
	{
		$data['title'] 		= 'Innovative Billing Model - SPOCHUB';
		$data['subview'] 	= $this->load->view('front/billing_model', $data, true);
		$this->load->view('front/include/main', $data);
	}
	
	/**
	 * Created by Deepak k
	 * @param       null
	 * @return    	mixed|string
	 * refund policy
	 */
	public function refund_policy()
	{
		$data['title'] 		= 'Refund Policy - SPOCHUB';
		$data['subview'] 	= $this->load->view('front/refund-policy', $data, true);
		$this->load->view('front/include/main', $data);
	}

	/*case study pages for header*/
	/**
	 * Created by Hemant Potdar
	 * @param       null
	 * @return    	mixed|string
	 * Case Study pages fpr heade
	 */
	public function case_study_indefend_advanced()
	{
		$data['title'] 		= 'Indefend Advanced';
		$data['subview'] 	= $this->load->view('front/casestudy/indefendAdvanced', $data, true);
		$this->load->view('front/include/main', $data);
	}

	public function case_study_doc_mgm_system()
	{
		//print_r('expression'); exit();
		$data['title'] 		= 'Document Management System';
		$data['subview'] 	= $this->load->view('front/casestudy/documentManagementSystem', $data, true);
		$this->load->view('front/include/main', $data);
	}
	public function case_study_ssl_tls_certificate()
	{
		$data['title'] 		= 'SSL/TLS Certificate';
		$data['subview'] 	= $this->load->view('front/casestudy/sslCertificate', $data, true);
		$this->load->view('front/include/main', $data);
	}

	/*Case Study pages for header*/
	/**
	 * Created by Aayusha k
	 * @param       null
	 * @return    	mixed|string
	 * Case Study pages fpr heade
	 */
	/*public function case_study_ipas()
	{
		$data['title'] 		= 'iPAS';
		$data['subview'] 	= $this->load->view('front/casestudy/ipas', $data, true);
		$this->load->view('front/include/main', $data);
	}
	public function case_study_webvpn()
	{
		$data['title'] 		= 'Web VPN';
		$data['subview'] 	= $this->load->view('front/casestudy/WebVPN', $data, true);
		$this->load->view('front/include/main', $data);
	}
	public function case_study_enlight360()
	{
		$data['title'] 		= 'enlight 360';
		$data['subview'] 	= $this->load->view('front/casestudy/enlight360', $data, true);
		$this->load->view('front/include/main', $data);
	}*/
	public function case_study_qad()
	{
		$data['title'] 		= 'QAD';
		$data['subview'] 	= $this->load->view('front/casestudy/qad', $data, true);
		$this->load->view('front/include/main', $data);
	}




	/**
	 * function use for feedback
	 * @param       null
	 * @return    	json
	 */
	public function feedback()
	{	
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
		{
		$return_array 	= array('status' => false, 'body' =>'');
		$response 		= $this->input->post('response');
		// $user_id 		= $this->session->userdata('user_id') ? $this->session->userdata('user_id') : NULL;

		if ($response == 1) {
			
			$insert_feedback = array('is_helpful'	=> true);
		
			//user_activity_log
			$title ="Client : feedback is helpful or not";
			$description = json_encode($insert_feedback);
			user_activity_logs($title, $description);

			$this->db->insert('user_feedback', $insert_feedback);
			$return_array = array('status' => TRUE,'is_helpful' => 'true', 'body' =>'<div class="response user-feedback-success">Thank you for your feedback!</div>');
		}
		if ($response == 0) {

			if (!empty($this->input->post('feedback_response'))) {
				$insert_feedback = array(
					'is_helpful'	=> false,
					'response'		=> $this->input->post('feedback_response')
					);
				
				$this->db->insert('user_feedback', $insert_feedback);
				$return_array = array('status' => TRUE,'is_helpful' => 'true', 'body' =>'<div class="response user-feedback-success">Thank you for your feedback!</div>');
			}else{
				$body  = '<div class="feedback_form">
						<form name="feedback_response">
							<p>Please let us know your Requirement and will get back to you soon.</p>
							<div class="form-group">
								<textarea class="form-control nospace" name="feedback_response" id="feedback_response" placeholder="Enter your feedback" rows="3"></textarea>
								<span style="    display: none;" id="feedback_response-error" class="help-block">Please enter your feedback.</span>
							</div>
							<div class="learn-more">
								<a class="submit_response btn btn-danger" href="#">Submit</a>
							</div>
						</form>
						</div>';

				$return_array = array('status' => TRUE,'is_helpful' => 'false', 'body' =>$body);
			}
			
		}
		echo json_encode($return_array);die();
		}else{
			die('No direct script access allowed');
		}
	}

	
	public function get_city()
	{	
		$state = $this->input->post('state'); 
		$country = $this->input->post('country'); 
		$city = $this->input->post('city'); 


		//os version
	    $where = array('region'=>$state,'country'=>$country ); 
	    $result = $this->Front_Products_model->get_data(array('id','name'),'cities',$where);
		$str="<option value='' >-Select city-</option>";
	    if(count($result) > 0)
			{
				$test='';
				foreach ($result as $res) 
				{
					
					if(!empty($city) && !empty($city)){
						$test=($res['name'] == $city)? 'selected=selected':'';
					}
					$str .= "<option value='".$res['name']."' ".$test.">".$res['name']."</option>";
				}
			}
			echo $str;  
	}


	/**
	 * Created by Aayusha k
	 * @param       null
	 * @return    	json
	 *  newsletter subscribtion page 
	 * 
	 */
	public function newsletter()
	{
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
		{
			$data['email'] 	= $this->input->get('email',false);
			$data['title']	= 'Subscribe To Our News Letter';
			$this->load->view('front/newsletter', $data);
		}else{
			die('No direct script access allowed');
		}
	}
	/**
	 * Created by Aayusha k
	 * @param       null
	 * @return    	json
	 *  newsletter subscribtion page 
	 */
	public function newsletter_save()
	{
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
		{
			$this->form_validation->set_rules('email','email', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
				$message = array('status'=>false,'message'=>validation_errors());
			}
			else
			{
				// check if email is already submitted for subscription
				$sql = "SELECT * FROM newsletter WHERE email = '".$this->input->post('email')."'";
				$result = $this->db->query($sql);
				$result_count = $result->num_rows();
				if ($result_count > 0)
				{
					$message = array('status'=>false,'message'=>'You have already subscribed.');
				}
				else{
						
					$insert = array(	
						'email' 		=> strtolower($this->input->post('email')),
						'ip'            => isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $this->input->ip_address(),
        				'user_agent'    => $_SERVER['HTTP_USER_AGENT'],
						'created_on' 	=> current_date(),
					);	
		    		$this->db->insert('newsletter', $insert);
		    		/***************** Mail to subscriber ***********************/
		    		$sent_mail = $this->input->post('email');
					$arr = array();
					$mail_data= get_email_body('newsletter',$arr);
					
					$this->Email_model->send_mail($mail_data['subject'], $mail_data['body'],$sent_mail,$mail_data['from_mail'],'client');
					//Email log

					email_activity_logs($mail_data['subject'],$mail_data['body'],$sent_mail,NULL,'client');
					/*****************  Mail to admin ***********************/
					$admin_mail = email_by_admin_role('spochubadmin');
					$email =  $this->input->post('email');
					$arr = array('body' => array("{EMAIL}"=>$email));
					$mail_data = get_email_body('newsletter_subscribe',$arr);

					$this->Email_model->send_mail($mail_data['subject'], $mail_data['body'],$admin_mail,$mail_data['from_mail'],'Admin');
					//Email log
					email_activity_logs($mail_data['subject'],$mail_data['body'],$admin_mail,$this->session->userdata('user_id'),'admin');

					$message = array('status'=>true,'message'=>'You have subscribed succesfully.');
				}
			}
		echo json_encode($message); die();
		}else{
			die('No direct script access allowed');
		}
	}
	public function email_is_unique()
    {
    	if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
		{
	    	$sql 	= "SELECT * FROM newsletter WHERE  email = '".strtolower($this->input->post('email'))."'";

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

    /*Predective search functionality*/
    public function predective_search()
	{	
		$key_name = $this->input->post('key_name');
		$search_key = trim(strtolower($this->input->post('search_key')));
		$search_key = $this->security->xss_clean($search_key);
		$search_key = text_clean($search_key);

		$total_count = 0;
		$link = '';
		if($key_name!='Enter'){
			/****************************/
	        $result = $this->Front_Products_model->get_product_search($search_key);


	        $p_list = ''; 
	        if (!empty($result)) {

	        	//$p_list ='<li><h4>Products</h4></li>';
				$p_list ='<h4>Products</h4>';
	       		$p_list .='<ul id="product-list">';
		        foreach ($result as $data) 
		        {
		            $id = $data["id"];
		            $product_seo_name = replace_space_with_dash($data["product_name"]);

		            $link = base_url().'product/'.'/'.$id; 
					// $link = base_url().'product/'.$product_seo_name.'/'.$id; 

		            $p_list .='<li><a href="'.$link.'" target="_blank" onclick="testfunction()">'.ucfirst($data["product_name"]).'</a></li>';
		        }
		      	$p_list .= '</ul>';
		    }
		

			/************* service ***************/

		// 	$service_result = $this->Front_service_model->get_product_search($search_key);

	    //     $s_list = ''; 
	    //     if (!empty($service_result)) {

	    //     	$s_list ='<li><h4>Service</h4></li>';
	    //    // 	$s_list .='<ul id="service-list">';
		//         foreach ($service_result as $service) 
		//         {

		//             $link = base_url().'service/'.replace_space_with_dash($service["service_name"]).'/'.$service["id"]; 

		//             $s_list .='<li><a href="'.$link.'">'.ucfirst($service["service_name"]).'</a></li>';
		//         }
		//       //  $s_list .= '</ul>';
		//     }

		    /************* Category ***************/

		// 	$cat_result = $this->Front_Products_model->get_cat_search($search_key);

	    //     $c_list = ''; 
	    //     if (!empty($cat_result)) {

	    //     	$c_list ='<li><h4>Category</h4></li>';
	    //    // 	$c_list .='<ul id="cat-list">';
		//         foreach ($cat_result as $cat) 
		//         {

		//             $link = base_url().'products/'.replace_space_with_dash($cat["name"]); 

		//             $c_list .='<li><a href="'.$link.'">'.ucfirst($cat["name"]).'</a></li>';
		//         }
		//       //  $c_list .= '</ul>';
		//     }

			echo $html = $p_list.$s_list.$c_list;
		} else {
			echo $link = base_url().'products?search='.$search_key; 
		}
		exit;
	}
	public function predective_search_bkp()
	{	
		$key_name = $this->input->post('key_name');
		//print_r($key_name); exit();
		$search_key = trim(strtolower($this->input->post('search_key')));
		$search_key = $this->security->xss_clean($search_key);
		$search_key = text_clean($search_key);

		$total_count = 0;
		$link = '';
		if($key_name!='Enter'){
			/****************************/
	        $result = $this->Front_Products_model->get_product_search($search_key);

	        $p_list = ''; 
	        if (!empty($result)) {

	        	$p_list ='<h4>Products</h4>';
	        	$p_list .='<ul id="product-list">';
		        foreach ($result as $data) 
		        {
		            $id = $data["id"];
		            $product_seo_name = replace_space_with_dash($data["product_name"]);

		            $link = base_url().'product/'.$product_seo_name.'/'.$id; 

		            $p_list .='<li onClick="window.location =\''.$link.'\'">'.ucfirst($data["product_name"]).'</li>';
		        }
		        $p_list .= '</ul>';
		    }
		

			/************* service ***************/

			$service_result = $this->Front_service_model->get_product_search($search_key);

	        $s_list = ''; 
	        if (!empty($service_result)) {

	        	$s_list ='<h4>Service</h4>';
	        	$s_list .='<ul id="service-list">';
		        foreach ($service_result as $service) 
		        {

		            $link = base_url().'service/'.replace_space_with_dash($service["service_name"]).'/'.$service["id"]; 

		            $s_list .='<li onClick="window.location =\''.$link.'\'">'.ucfirst($service["service_name"]).'</li>';
		        }
		        $s_list .= '</ul>';
		    }

		    /************* Category ***************/

			$cat_result = $this->Front_Products_model->get_cat_search($search_key);

	        $c_list = ''; 
	        if (!empty($cat_result)) {

	        	$c_list ='<h4>Category</h4>';
	        	$c_list .='<ul id="cat-list">';
		        foreach ($cat_result as $cat) 
		        {

		            $link = base_url().'products/'.replace_space_with_dash($cat["name"]); 

		            $c_list .='<li onClick="window.location =\''.$link.'\'">'.ucfirst($cat["name"]).'</li>';
		        }
		        $c_list .= '</ul>';
		    }

			echo $html = $p_list.$s_list.$c_list;
		} else {
			echo $link = base_url().'products?search='.$search_key; 
		}
		exit;
	}
	/*eof Predective search functionality*/
	public function order_summary()
    {
        $data['title'] 		= 'Order Summury';
        $data['subview'] 	= $this->load->view('front/order-summary', $data, true);
        $this->load->view('front/include/main', $data);
    }



}

