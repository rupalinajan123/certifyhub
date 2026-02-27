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
		$this->load->model( array('Front_Products_model','Email_model', 'Masters_model') );
		
		$keys = array('product_id','package_id','quantity','prev_url','client_custom_fields_data','user_m_download_url','cat_name','cat_url'); // Delete front session
    	$this->session->unset_userdata($keys);
	}

	/**
	 * Created by Deepak k
	 * @param       null
	 * @return    	mixed|string
	 * Home page
	 */
	public function index()
	{
		$data['title'] 		= 'SPOCHUB - SaaS PaaS On-Click Marketplace';
		
		$data['cat_data'] = $cat_data 	= $this->Front_Products_model->get_data(array('cat_id','name','logo'), 'categories', array('is_active' => true, 'is_deleted' => false),'','display_order ASC');
		

		$top_products		= $this->Front_Products_model->most_popular_products();	
		
		
// 		echo "<pre>";		print_r($_SESSION); exit;
		$most_five_products = array();
		if ($top_products) {
			/*$most_popular_products = array();
			$customer_weightage 	= $this->config->item('most_popular_customer_weightage');
			$lead_weightage			= $this->config->item('most_popular_lead_weightage');
			$rating_weightage		= $this->config->item('most_popular_rating_weightage');*/
			$top_popular_ount		= $this->config->item('top_most_popular_product_count');
			foreach ($top_products as $products) {	
			
				$temp  = array('lead_count' => $products['lead_count'],
								'product_name' => $products['product_name'],
								'short_brief' => $products['short_brief'],	
								'logo' => $products['logo'],
								'cover_image' => $products['cover_image'],
								'id' => $products['id'],
								'product_id' => $products['product_id'],
								'rating' => $products['rating'],
								'video' => $products['video'],
								'price' => $products['price'],
								'description' => $products['brief']
							);

				/*$temp['customer_weightage'] = $products['client_count'] * $customer_weightage;
				$temp['lead_weightage'] 	= $products['lead_count'] * $lead_weightage;
				$temp['rating_weightage'] 	= $products['rating'] * $rating_weightage;
				$temp['total_score'] 	= $temp['customer_weightage'] + $temp['lead_weightage'] + $temp['rating_weightage'];*/
				//$most_popular_products[] = $temp;
				//$temp['lead_count'] = max($lead_count = array('lead_count' => $products['lead_count']));
				$most_popular_products[] = $temp; 
			}
			/*usort($most_popular_products, function ($item1, $item2) {
		    	return $item2['lead_count'] <=> $item1['lead_count'];
			});*/
			$most_five_products = array_slice($most_popular_products, 0, $top_popular_ount, true);	
		} 

		$data['top_five_popular_products'] 	= $most_five_products;
        $cat_wise_prod = $this->Front_Products_model->get_category_wise_prod();	

        	if ($cat_wise_prod) {
        	   $data['cat_wise_prod'] = $cat_wise_prod;
        	}
		$data['testimonial_data']  	= $this->Front_Products_model->get_testimonials();
		$data['subview'] 	= $this->load->view('front/index', $data, true);
		$this->load->view('front/include/main', $data);
	}	

	/**
	 * Created by Deepak k
	 * @param       null
	 * @return    	json
	 *  show order summery page 
	 *  this use only for covid product
	 */
	public function summary()
	{
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
		{
			$product_id = $this->input->post('product_id');
			$package_id = $this->input->post('package_id');

			if (!empty($product_id) || !empty($package_id)) {
				$product_details = $this->Front_Products_model->get_data(array('product_name','id'), 'products',array('id' =>$product_id));
				
				$data['product_details'] = (!empty($product_details) ? $product_details[0] : array());

				$package_details = $this->Front_Products_model->get_data(array('d.id as package_id', 'p.type','p.product_offered','d.package_name','d.implementation_amount','d.features_amount'), 'product_package_details d',array('d.id' =>$package_id,'d.product_id'=>$product_id),array('products p'=>'p.id=d.product_id'));

				$data['package_details'] = (!empty($package_details) ? $package_details[0] : array());

				$data['package_list'] = $this->Front_Products_model->get_data(array('d.id as package_id', 'd.package_name','d.implementation_amount','d.features_amount'), 'product_package_details d',array('d.product_id'=>$product_id,'d.is_deleted' =>false));

				$data['state'] 	 = $this->Front_Products_model->get_data(array('country','code','name'),'states',array('country' =>'IN'));

				$body = $this->load->view('front/product/product_details/summary', $data, true);
				$output = array('status' => true, 'body' => $body);
			}else{
				$output = array('status' => false, 'body' => '');
			}
			echo json_encode($output);
			die();
		
		}else{
			die('No direct script access allowed');
		}
	}

	
	
}

