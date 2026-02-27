<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
	Class Name 		: 	Product_checkout
	Created By		: 	Deepak k
	Created Date 	: 	11-02-2020

*/
class Product_checkout extends CI_Controller 
{
	public function __construct()
	{
        parent::__construct();
        $this->load->model( array('Masters_model') );
    }

    /**
	 * Created by Rahul b
	 * @param       $product_id
	 * @param       $package_id
	 * @return    	mixed|string
	 *  Product summary page
	 */
	public function order_summary($product_id=null,$package_id=null)
	{

		$site_url = $this->config->item('PORTAL_LINK');
		if ((empty($product_id) || !is_numeric($product_id)) || (empty($package_id) || !is_numeric($package_id))) {
			$this->session->set_flashdata('error', 'Please select product first.');
			redirect($site_url);exit();
		}
		
		$product_details = $this->Masters_model->get_data(array('product_name','id'), 'products',array('id' =>$product_id));
			
		$data['product_details'] 	= (!empty($product_details) ? $product_details[0] : array());
		$data['client_details'] 	= array();
		if(!empty($this->session->userdata('user_id')) && $this->session->userdata('user_type')=='client'){
			
			$select = array('concat(first_name,\' \',last_name) as name','company','phone','email','address1','countries.name as country_name','states.name as state_name');
			$joins 	= array(
					'countries'	=> 'countries.code = c.country',
					'states'	=> 'states.code = c.state and states.country = c.country'
					);		
			$where 	= array(	'c.id'=> $this->session->userdata('user_id'), 'c.is_deleted'=> false);

			$client_details = $this->Masters_model->get_data($select,'client c',$where,$joins);
			$data['client_details'] = $client_details[0];
		}
		
		$package_details = $this->Masters_model->get_data(array('d.*', 'p.type','p.product_offered'), 'product_package_details d',array('d.id' =>$package_id,'d.product_id'=>$product_id),array('products p'=>'p.id=d.product_id'));
		
			$features_amount		= 0;
			$implementation_amount	= 0;

			if(!empty($package_details[0]['implementation_amount'])):
			 $implementation_amount 	= $package_details[0]['implementation_amount'];
			endif;

			if(!empty($package_details[0]['features_amount'])):
				$implementation_amount 		 = $implementation_amount + $package_details[0]['features_amount'];
			endif;
			
			$data['final_amt'] = $implementation_amount;
			
		$data['package_details'] = (!empty($package_details) ? $package_details[0] : array());

		if (empty($data['product_details']) || empty($data['package_details'])) {
			$this->session->set_flashdata('error', 'Product not found in database.');
			redirect($site_url);
		}		
		$data['product_id']=$product_id;
		$data['package_id']=$package_id;
		
		
		$data['title'] 				= 'Order Summary';
		//echo"<pre>";print_r($data); die;
		$this->load->view('order_summary', $data);
	}

	/**
	 * Created by Deepak k
	 * @param       null
	 * @return    	mixed|string
	 *  order summery page
	 */
	public function summary_post()
	{
		$site_url = $this->config->item('PORTAL_LINK');
		$keys = array('product_id','package_id','private_offer_id','package_type','quantity','client_custom_fields_data');
    	$this->session->unset_userdata($keys); // Clear revious session data

		$product_id 	= $this->input->post('product_id');
		$package_id 	= $this->input->post('package_id');
		$quantity 		= $this->input->post('quantity');
		$custom_field 	= $this->input->post('custom_field');
		$promo_code 	= $this->input->post('promo_code');
		$private_offer_id = $this->input->post('private_offer_id');
		$package_type 	= $this->input->post('package_type');

		if (empty($product_id) ) {
			$this->session->set_flashdata('error', 'Somthing is wrong');
			redirect($site_url);
			die();
		}

		if (is_login() == true && $this->session->userdata('user_type') != 'client') {
			$keys = array('user_id','first_name','last_name','email','username','logged_in','prev_url','captcha_client','product_id','package_id','quantity','private_offer_id','package_type','amount','client_custom_fields_data');
    		$this->session->unset_userdata($keys);
		}

		if (!empty($package_id)) {
			$summary_post = array(
					'product_id'	=> $product_id,
					'package_id'	=> $package_id,
					'client_custom_fields_data'=>$custom_field,
					'promo_code'=>$promo_code,
					'quantity'	    => ($quantity ? $quantity : 1),
			);
		}
		
		if (!empty($private_offer_id)) {
			$summary_post = array(
					'product_id'		=> $product_id,
					'private_offer_id'	=> $private_offer_id,
					'package_type'		=> $package_type,
					'client_custom_fields_data'=>$custom_field,
					'promo_code'		=> $promo_code,
					'quantity'	    	=> ($quantity ? $quantity : 1),
			);
		}
		
	    $this->session->set_userdata($summary_post);  //add checkout data in session
	    $actual_link = $site_url . '/orders/add_order';//place order link

	    $prev_url = array('prev_url' => $actual_link);
		$this->session->set_userdata($prev_url);

		redirect($actual_link);
	}
	/**
	 * function use for order success
	 * @param       $order_id int
	 * @return    	mixed
	 */
	public function success($order_id = NULL,$product_id = NULL)
	{
		$user_id = $this->session->userdata('user_id');
		if (!empty($user_id) && !empty($order_id)) {

			$invoices =  $this->Masters_model->get_data('id,status','client_invoices',array('order_id'=>$order_id));
			$product_data =  $this->Masters_model->get_data('product_id','client_order_product',array('order_id'=>$order_id));

			$data['title'] 			= 'Payment Success Page';
			$data['product_id'] 	= $product_data[0]['product_id'];
			$data['order_id'] 		= $order_id;
			$data['invoice_id'] 	= isset($invoices[0]) ? $invoices[0]['id'] : 0;
			$data['invoice_status'] = isset($invoices[0]) ? $invoices[0]['status'] : '';
			$this->load->view('success', $data);
			
		} else {
			$this->session->set_flashdata( 'error', 'Your session has been expired.');
			redirect(base_url());
		}
	}

	public function check_coupon_code()
	{
		$promo_code=@$this->input->post('promo_code');
		$package_id=@$this->input->post('package_id');
		$product_id=@$this->input->post('product_id');
		$product_total=@$this->input->post('product_amount');
		// print_r($_POST);exit;
		$json_data=array('status'=>'0','message'=>'Not valid!');

		// check required parametrs
		if(!empty($package_id) && !empty($product_id))
		{		
			$this->db->select('value, discount_method');
			$this->db->where('code',$promo_code);
            $this->db->like('applies_to', '"'.$product_id.'"');
            $query = $this->db->get('coupon_master');
            $result = $query->result_array();
            $sub_total=0;
            $res_arr = array();
            if(count($result)>0){
            	$res_arr['msg'] = '';
	            if($result[0]['discount_method'] == 'Fixed Amount'){
	            	$sub_total = $product_total - $result[0]['value'];
	            	$res_arr['sub_total'] = $sub_total;
	            	$res_arr['discount'] = $result[0]['value'];
	            	$res_arr['perc_amount'] = 0;
	            }
	            else{
	            	$perc_amount = $product_total*($result[0]['value'])/100;
	                $sub_total = $product_total - $perc_amount;
	                $res_arr['perc_amount'] = $perc_amount;
	                $res_arr['sub_total'] = $sub_total; 
	                $res_arr['discount'] = $result[0]['value'].'%';    
	            }
	        }
	        else{
	        	$res_arr['msg'] = 'Promo Code does not matched.';
	        }
	        echo json_encode($res_arr);
		}
		
	}

	public function offer_order_summary($product_id=null,$private_offer_id=null)
	{
		$site_url = $this->config->item('PORTAL_LINK');
		if ((empty($product_id) || !is_numeric($product_id)) || (empty($private_offer_id) || !is_numeric($private_offer_id))) {

			$this->session->set_flashdata('error', 'Please select product first.');
			redirect($site_url . '/products');exit();
		}
    	$this->session->unset_userdata(array('offer_url'));

		$product_details = $this->Masters_model->get_data(array('product_name','id'), 'products',array('id' =>$product_id));
			
		$data['product_details'] = (!empty($product_details) ? $product_details[0] : array());
		$data['client_details'] = array();
		if(!empty($this->session->userdata('user_id')) && $this->session->userdata('user_type')=='client'){
			
			$select = array('concat(first_name,\' \',last_name) as name','company','phone','email','address1','countries.name as country_name','states.name as state_name');
			$joins 	= array(
					'countries'	=> 'countries.code = c.country',
					'states'	=> 'states.code = c.state and states.country = c.country'
					);		
			$where 	= array(	'c.id'=> $this->session->userdata('user_id'), 'c.is_deleted'=> false);

			$client_details = $this->Masters_model->get_data($select,'client c',$where,$joins);
			$data['client_details'] = $client_details[0];
		}else{
			$actual_link = $site_url . '/product/offer-order-summary/'.$product_id.'/'.$private_offer_id;
		    //order summary link

		    $offer_url = array('offer_url' => $actual_link);
			$this->session->set_userdata($offer_url);
		}
		$offer_data = $this->Masters_model->get_data('*', 'private_offers',array('id' =>$private_offer_id));
		$offer_data = $offer_data[0];
			//echo"<pre>";print_r($offer_data); die;
			//$data['package_details'] = $offer_data['package_data'];
			$features_amount		= 0;
			$implementation_amount	= 0;
			//echo"<pre>"; print_r($offer_data['package_data']["implementation_amount"]); die;
			if(!empty($data['package_details']['implementation_amount'])):
			 $implementation_amount 	= $data['package_details']['implementation_amount'];
			endif;
			if(!empty($data['package_details']['features_amount'])):
				$implementation_amount 		 = $implementation_amount + $data['package_details']['features_amount'];
			endif;
			
		$data['final_amt'] = $implementation_amount;	
		$data['product_id'] 		= $product_id;
		$data['private_offer_id'] 	= $offer_data['id'];
		$data['package_type'] 		= $offer_data['package_type'];
		
		$data['title'] 				= 'Order Summary - SPOCHUB';
		$data['subview'] 			= $this->load->view('order_summary', $data);
	}

	public function private_offer_post()
	{
		$keys = array('product_id','private_offer_id','package_type','client_custom_fields_data','quantity');
    	$this->session->unset_userdata($keys); // Clear Previous session data

		$product_id = $this->input->post('product_id');
		$private_offer_id = $this->input->post('private_offer_id');
		$package_type 	= $this->input->post('package_type');
		$custom_field 	= $this->input->post('custom_field');

		if (empty($product_id) || empty($private_offer_id) ) {
			$this->session->set_flashdata('error', 'Somthing is wrong');
			redirect(base_url('products'));
			die();
		}

		if (is_login() == true && $this->session->userdata('user_type') != 'client') {
			$keys = array('user_id','first_name','last_name','email','username','logged_in','prev_url','captcha_client','product_id','private_offer_id','package_type','quantity','client_custom_fields_data');
    		$this->session->unset_userdata($keys);
		}

		$summary_post = array(
				'product_id'		=> $product_id,
				'private_offer_id'	=> $private_offer_id,
				'package_type'		=> $package_type,
				'client_custom_fields_data'=>$custom_field,
				'promo_code'		=> $promo_code,
				'quantity'	    	=> ($quantity ? $quantity : 1),
		);
		
	    $this->session->set_userdata($summary_post);  //add checkout data in session
	    $actual_link = base_url() . 'orders/add_order';//place order link

	    $prev_url = array('prev_url' => $actual_link);
		$this->session->set_userdata($prev_url);

		redirect($actual_link);
	}
}