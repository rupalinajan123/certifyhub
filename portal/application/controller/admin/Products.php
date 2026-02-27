<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
	Class Name 		: 	Products
	Created By		: 	Deepak K
	Created Date 	: 	22-08-2019

*/
class Products extends MY_Controller 
{
	public function __construct()
	{
        parent::__construct();
        $this->load->model(array('masters_model','Product_model'));
	}
	
	/**
	 * Function use for load Products
	 * @param       null
	 * @return    	mixed|string
	 */
	public function index()
	{
				//for active and in-active
		if ($this->input->server('REQUEST_METHOD') == 'POST'){
            $status_id = $this->input->post('id');
            $active_flag = $this->input->post('active_flag');
			
            if($status_id != '' && $active_flag != '' ){
				 $result = $this->masters_model->update_data('products',array('id' => $status_id),array('is_active' => $active_flag));
				echo json_encode(array('status' => true,'message' => 'message'));
                die();
            }
        }
		$where = array('is_deleted' => false,'is_active' => true); 
	    $data['categories_list'] = $this->masters_model->get_data(array('cat_id','name'),'categories',$where);
		
		// for sub category.
		/*$where = array('is_deleted' => false,'is_active' => true); 
	    $data['sub_categories_list'] = $this->masters_model->get_data(array('sub_cat_id','name'),'sub_categories',$where);*/

	    $where = array('is_deleted' => false); 
	    $data['users_list'] = $this->masters_model->get_data(array('user_id','first_name','last_name'),'users',$where);
		
		$data['title'] = 'Products';
		$data['subview'] = $this->load->view('admin/products/index',$data ,true);
		$this->load->view('include/main',$data);	
	}

	/**
	 * function use for get product list
	 * @param     null
	 * @return    json
	 */
	public function export_csv()
	{ 
		$order_by = array('p.id' => 'DESC');
		$product_lists=self::get_product_data('p.id, p.category_id, p.product_name,p.status','products',array(),array(),$order_by);

		$filename = 'product_list_'.date('YmdHis').'.csv';
 		$header = array("Product ID", "Category", "Product Name", "Status"); 
 		
 		$product_array = array_map(function ($v) {
 			return (array) $v ; // convert to array 
 		}, $product_lists['product_lists']);

 		foreach ($product_array as $key=>$line){ 
			$PRODUCT_STATUS=$this->config->item('PRODUCT_STATUS');

			if(!empty($line['category_id'])){
				$product_array[$key]['category_id']=category_name_by_product($line['id']);
			}

			$data[$key]['product_name'] = html_entity_decode($line['product_name']);
			$product_array[$key]['status'] = $PRODUCT_STATUS[$line['status']]['label'];
		}

	    /*echo "<pre>";
	    print_r($product_array);
	    exit;*/
	 	download_csv($filename,$header,$product_array);
	}

	 /**
	 * function use for get product list
	 * @param     null
	 * @return    json
	 */
	public function get_product_data($select,$table,$column_order=array(),$column_search=array(),$order_by=array())
	{ 
		
	 	$configArr = array('table' => $table, 'column_order' => $column_order,'column_search' => $column_search, 'order_by' => $order_by);

		$sql = 'SELECT '.$select.' FROM products p 
			LEFT JOIN categories c ON CAST(c.cat_id AS TEXT) IN (p.category_id)
			LEFT JOIN sub_categories sc ON p.sub_category_id = sc.sub_cat_id 
			LEFT JOIN users u ON p.partner_id = u.user_id ';


		$sql .=" WHERE p.is_deleted = 'false' ";
		
		// for datatable search.
		if(!empty(trim($this->input->post('search[value]'))))
		{
			$searchVal=trim($this->input->post('search[value]'));

			$sql.=" AND (LOWER(p.product_name) LIKE '%".strtolower($searchVal)."%' ";

			$sql.=" OR LOWER(sc.name) LIKE '%".strtolower($searchVal)."%' ";

			$sql.=" OR ( (select string_agg(LOWER(name), ',' ORDER BY name) As cat_list from categories where cat_id in ( SELECT unnest(string_to_array(category_id, ','))::int from products where id = p.id)) LIKE '%".strtolower($searchVal)."%'))";	
		}

		if(!empty(trim($this->input->post('product_name'))))
		{
			$sql.=" AND LOWER(p.product_name) LIKE '%".strtolower($this->input->post('product_name'))."%' ";
		}
		if(!empty(trim($this->input->post('type'))))
		{
			$sql.=" AND LOWER(p.type) LIKE '%".strtolower($this->input->post('type'))."%' ";
			//$sql.=" AND LOWER(p.product_type) LIKE '%".strtolower($this->input->post('type'))."%' ";
		}
		// if(!empty(trim($this->input->post('full_lead'))))
		// {
		// 	$sql.=" AND LOWER(p.product_type) LIKE '%".strtolower($this->input->post('full_lead'))."%' ";
		// }
	   if(!empty($this->input->post('company_name')))
	 	{
	 	  $sql.=" AND  (u.user_id = '".$this->input->post('company_name')."') ";
        }
		if(!empty(trim($this->input->post('user_id'))))
		{
			$user_id=trim($this->input->post('user_id'));
			$sql.=" AND u.user_id  ='".strtolower($user_id)."' ";
		}

		if(!empty(trim($this->input->post('sub_cat_id'))))
		{
			$searchVal=trim($this->input->post('sub_cat_id'));
			$sql.=" AND sc.sub_cat_id  ='".strtolower($searchVal)."' ";
		}

		if($this->input->post('status') != '')
		{
			$searchVal=trim($this->input->post('status'));
			$sql.=" AND p.status  ='".strtolower($searchVal)."' ";
		}

	 	return array('product_lists' => $this->masters_model->get_datatables_master($sql, $configArr),'sql'=>$sql,'configArr'=>$configArr);
 		
	}

	 /**
	 * function use for get product list
	 * @param     null
	 * @return    json
	 */
	public function products_list()
	{
		
		$table 			= 'products';
		$column_order 	= array('p.id','p.type','p.product_type','p.product_name','p.overview','p.brief','p.highlight'); 

		$column_search 	= array('LOWER(p.product_name)','LOWER(p.type)','LOWER(p.product_type)','LOWER(u.company_name)');

		$order_by 	= array('p.id' => 'DESC');

		$select 	= 'p.id, p.category_id, p.sub_category_id, p.product_name, p.status,p.created_by_id,p.product_type,p.created_on,p.type,p.product_kind,c.name as cat_name,u.first_name,u.last_name, sc.sub_cat_id, sc.name as sub_cat_name,u.user_id,p.display_order,u.company_name';

		$product_lists = self::get_product_data($select,$table,$column_order,$column_search,$order_by);
		

	 	$sql			= $product_lists['sql'];
	 	$configArr		= $product_lists['configArr'];
		$product_lists 	= $product_lists['product_lists'];

		$data 	= array();
		$no 	= $this->input->post('start');
		$product_type = '';
		if (!empty($product_lists)) {

		
			$PRODUCT_STATUS 		= $this->config->item('PRODUCT_STATUS');
			$PRODUCT_KIND 			= $this->config->item('PRODUCT_KIND');
			$PRODUCT_STATUS_LEADS 	= $this->config->item('PRODUCT_STATUS_LEADS');


			foreach ($product_lists as $product) {
				
				$no++;
				$row = array();
				$url_view =  base_url().'admin/products/details/'.$product->id;
				if($product->product_type=='Lead'){
					$url_view =  base_url().'admin/products/lead_details/'.$product->id;
				}

				$row[] = '<a href="'.$url_view.'" class="text-primary"  >'.$product->id.'</a>';
				$row[] = '<a href="'.$url_view.'" class="text-primary"  >'.ucfirst(truncate_string($product->product_name)).'</a>';
				

				$cat_names = ucfirst(truncate_string(category_name_by_product($product->id)));
                $cat_names_full = category_name_by_product($product->id);

/*                $sub_cat = '<p class="cat_names">'.$cat_names_full.'</p>';
                if (strlen($cat_names_full) > 50) {
                	$sub_cat = '<p class="cat_names_full">'.$cat_names_full.'</p>     <p class="cat_names">'.$cat_names.'<a href="javascript:void(0);" class="showMore text-info">show more</a></p>';
                }
                $row[] = $sub_cat;*/

                $product_type = '';
                if(!empty($product->type)){
                	$product_type = ' - <b>('.ucfirst(truncate_string($product->type)).')</b>';
                }

                $row[] = $product->product_type.$product_type;
            //  	$row[] = $product->company_name	;
                if($this->session->userdata('user_type') == 'admin' && $product->user_id ==''){
                    $row[] = '<a href="'.base_url('admin/profile').'" class="text-primary" target="_blank" >Admin</a>';
                }
                else{
				$row[] = '<a href="'.base_url('admin/partners/details/').$product->user_id.'" class="text-primary" target="_blank" >'.($product->first_name.' '.$product->last_name).'</a>';
                }
				$row[] = date('Y-m-d H:i:s',strtotime($product->created_on));
				$button = '';
				$url_pack = base_url().'admin/product_contacts/list/'.$product->id;
				$button .=  button_action($url_pack,'', '','Product Contacts','fa-phone');
				$row[]   = $button;

				$kind  = isset($PRODUCT_KIND[$product->product_kind]) ? $PRODUCT_KIND[$product->product_kind] : '';

				$row[]  = '<select class="product_order " style="width: 100px;" data-id="'.$product->id.'">'.$this->get_display_order($product->display_order).'</select>';

				$row[]  = '<select class="product_kind " style="width: 100px;" data-id="'.$product->id.'">'.$this->get_product_kind_status($product->product_kind).'</select>';
				
				$status = isset($PRODUCT_STATUS[$product->status]) ? $PRODUCT_STATUS[$product->status]['label'] : 'Pending';
				$class  = isset($PRODUCT_STATUS[$product->status]) ? $PRODUCT_STATUS[$product->status]['color'] : 'label-default';
				
				if($product->product_type=='Full'){
					$row[]  = '<span class="label '.$class.'">'.$status.'</span><br/>';/*'	<select name="" class="" style="    width: 125px;">'.$this->get_status($product->status).'</select>';*/
				}else{
					$row[]  = '<span class="label '.$class.'">'.$status.'</span><br/>	<select name="product_status_leads" class="product_status_leads " style="width: 125px;" data-id="'.$product->id.'">'.$this->get_leads_status($product->status).'</select>';
				}

				//$button   =  button_action($url_view, '', '', 'View Product Details', 'fa-eye');
				$button_action ='';
					if ($product->product_type == 'Lead') {
		 			$url 	 =  base_url().'admin/products/add_lead_product?action=basic_info&mode=edit&product_id='.$product->id; 
			 		$button_action .=  button_action($url, '', '', 'Edit Lead Product').' | ';
			 	}

		 		//$button .=  button_action('#', 'add_contact', $product->id, 'Product Contacts','fa fa-phone').' | ';

				$button_action .='<a href="" class="btn btn-icon-toggle delete_product" data-toggle="tooltip" data-placement="top" data-original-title="Delete Product" data-id="'.$product->id.'" data-status="'.$product->status.'"><i class="fa fa-trash"></i></a>';

				$row[]   = $button_action;
				$data[]   = $row;
			
			}
		}
		$output = array(
			"draw" 				=> $this->input->post('draw'),
			"recordsTotal" 		=> $this->masters_model->count_all_master($table),
			"recordsFiltered" 	=> $this->masters_model->count_filtered_master($sql, $configArr),
			"data" 				=> $data,
		);
		echo json_encode($output);
	}

	/**
	 * function use for load view of product
	 * @param     int $product_id
	 * @return    mixed|string
	 */
	public function details($product_id = NULL)
	{
		if ( empty($product_id) || !is_numeric($product_id) ) {
			$this->session->set_flashdata('error', 'Product id is not found.');
			redirect(base_url().'admin/products');
		}

		$data 						= $this->Product_model->get_package_details($product_id);
		$data['consuption_json'] 	= $this->Product_model->consuption_json($product_id);
		$data['infra']				= $this->get_infrastructure_details($product_id);
		$data['api_deta'] 		= $this->Product_model->get_data(array('id','api_type','api_url','username','password'),'product_api_details',array('product_id' =>$product_id,'is_deleted' => FALSE ));
		
		$sql = 'SELECT p.id,p.id as product_id, p.register_api,p.category_id, p.sub_category_id, p.product_name, p.overview, p.brief, p.highlight, p.highlight, p.usage,p.package_note,  p.support,p.type, p.version, p.logo,p.user_manual,p.case_study, p.video,p.sample_report,p.process_doc,p.demo_url, p.status,p.programming_lang,p.other_programming_lang,p.framework,p.other_framework, c.cat_id, c.name as cat_name, sc.sub_cat_id, sc.name as sub_cat_name FROM products p 
			LEFT JOIN categories c ON CAST(c.cat_id AS TEXT) IN (p.category_id)
			LEFT JOIN sub_categories sc ON p.sub_category_id = sc.sub_cat_id ';

		$sql .=" WHERE p.is_deleted = 'false' AND p.id = ".$product_id." ";

		$edit_data = $this->masters_model->get_query($sql);
		
		if (!empty($edit_data)) {
			$data['products']   = $edit_data[0];
		}else{
			$this->session->set_flashdata('error', 'Product data is not found.');
			redirect(base_url().'admin/products');
		}
		
		$data['title'] 		= 'Product Details';
		$data['subview'] 	= $this->load->view('admin/products/product_view',$data ,true);
		$this->load->view('include/main',$data);
	}

	/**
	 * function use for get package details
	 * @param     int $product_id
	 * @return    array
	 *added by 	  Aayusha k
	 */
	public function get_infrastructure_details($product_id)
	{
		if (empty($product_id) || $product_id == '' || !is_numeric($product_id) || preg_match('#[^0-9]#',$product_id)) {
			$this->session->set_flashdata('error', 'Product id is not found.');
			redirect(base_url() . 'partner/products');
		}
			$select = array(
			'infrastructure_requirnments.*', 
			'infra_vcpu.id as vcpu_id','infra_vcpu.from as vcpu_from','infra_vcpu.to as vcpu_to',
			'infra_ram.id as ram_id','infra_ram.from as ram_from','infra_ram.to as ram_to',
			'infra_disk_storage.id as disk_storage_id','infra_disk_storage.from as disk_storage_from','infra_disk_storage.to as disk_storage_to',
			'infra_operating_system.id as os_id','infra_operating_system.name as os_name',
			'os_version.id as os_id','os_version.name as os_version_name',
			'infra_software_application.id as sa_id','infra_software_application.name as sa_name',
			'sa_version.id as sa_id','sa_version.name as sa_version_name',
			'infra_database.id as db_id','infra_database.name as db_name',
			'db_version.id as db_id','db_version.name as db_version_name',
		);
		$where = array('infrastructure_requirnments.is_deleted' => false, 'infrastructure_requirnments.product_id' => $product_id);
		$join = array(
			'infra_vcpu'			=> array('infra_vcpu.id = infrastructure_requirnments.vcpu_id', 'left'),
			'infra_ram'				=> array('infra_ram.id = infrastructure_requirnments.ram_id', 'left'),
			'infra_disk_storage'	=> array('infra_disk_storage.id = infrastructure_requirnments.disk_storage_id', 'left'),
			'infra_operating_system'=> array('infra_operating_system.id = infrastructure_requirnments.os_id', 'left'),
			'infra_operating_system as os_version'=> array('os_version.id = infrastructure_requirnments.os_version_id', 'left'),
			'infra_software_application'=> array('infra_software_application.id = infrastructure_requirnments.web_server_id', 'left'),
			'infra_software_application as sa_version'=> array('sa_version.id = infrastructure_requirnments.web_server_version_id', 'left'),
			'infra_database'		=> array('infra_database.id = infrastructure_requirnments.web_server_id', 'left'),
			'infra_database as db_version'		=> array('db_version.id = infrastructure_requirnments.database_version_id', 'left'),
		);

		$data = $this->masters_model->get_data($select, 'infrastructure_requirnments', $where, $join);

		if (!empty($data)) {
			$data = $data;
		}
		
		return $data;	
	}

	/**
	 * function use for get change product status
	 * @param     null
	 * @return    json
	 */
	public function change_product_status()
	{

		$product_status = trim($this->input->post('product_status'));
		$products_id 	= trim($this->input->post('products_id'));
		if (!empty($product_status) && !empty($products_id) ) {
			$this->masters_model->update_data('products',array('id' =>$products_id),array('status' => $product_status));
			//admin_activity_log
			admin_activity_logs("Admin: Product status updated, Product id:".$products_id , "Product status: " . $product_status);
			$output = array('status' =>true ,'message' => 'Product status change successfully.' );
		}else{
			$output = array('status' =>false ,'message' => 'Product id not found.' );
		}
		echo json_encode($output);
	}

	/**
	 * function use for get change product kind
	 * @param     null
	 * @return    json
	 */
	public function update_kind()
	{
		$product_kind 	= trim($this->input->post('product_kind'));
		$products_id 	= trim($this->input->post('products_id'));

		if (!empty($product_kind) && !empty($products_id) ) {

			$this->masters_model->update_data('products',array('id' =>$products_id),array('product_kind' => $product_kind));

			//admin_activity_log
			admin_activity_logs("Product kind updated, Product id:".$products_id , "Product kind: " . $product_kind);
			$output = array('status' =>true ,'message' => 'Product kind change successfully.' );
		}else{
			$output = array('status' =>false ,'message' => 'Product id not found.' );
		}
		echo json_encode($output);
	}

	/**
	 * function use for get change product display_order
	 * @param     null
	 * @return    json
	 */
	public function update_display_order()
	{
		$product_order 	= trim($this->input->post('product_order'));
		$products_id 	= trim($this->input->post('products_id'));

		if ( !empty($products_id) ) {

			if (empty($product_order) ) {
				$this->masters_model->update_data('products',array('id' =>$products_id),array('display_order' => NULL));
				$output = array('status' =>true ,'message' => 'Display order change successfully.' );
				echo json_encode($output);
				exit();
			}

			$p_count = $this->masters_model->get_query_count("select id from products where  is_deleted ='FALSE' AND display_order='".$product_order."'; ");

			if ($p_count  == 0) {
				$this->masters_model->update_data('products',array('id' =>$products_id),array('display_order' => $product_order));
				$output = array('status' =>true ,'message' => 'Display order change successfully.' );

				admin_activity_logs("Display order, Product id:".$products_id , "Order: " . $product_order);
			}else{
				$output = array('status' =>false ,'message' => 'Display order is already assigned to another product.' );
			}

			
			
		}else{
			$output = array('status' =>false ,'message' => 'Product id not found.' );
		}
		echo json_encode($output);
	}

	//
	

	public function consuption_json($product_id = '')
	{
		if ( empty($product_id) || !is_numeric($product_id) ) {
			$this->session->set_flashdata('error', 'Product id is not found.');
			redirect(base_url().'admin/products');
		}
		
		$plan_list = $this->masters_model->get_data('id as plan_id','product_package_details',array('product_id' => $product_id));
		$json 		= array( );
		$license 	= array();
		$transaction= array();
		
		foreach ( $plan_list as $plan ) {
			

			$license_data	= $this->masters_model->get_data('*','product_package_license',array('package_id' => $plan['plan_id'],'is_deleted' => false));

			$transaction_data	= $this->masters_model->get_data('*','product_package_transaction',array('package_id' => $plan['plan_id'],'is_deleted' => false));

			if (!empty($license_data)) {
				foreach ($license_data as $lic) {
					$license[$lic['license_id']] = 0 ;
				}
			}

			if (!empty($transaction_data)) {
				foreach ($transaction_data as $tran) {
					$transaction[$tran['id']] = 0;
				}
			}
			
			//print_r($plan_details);

			//$json_temp['order_id'] 		= $order['order_id'];
			//$json_temp['license_key'] 	= '#################################';

			if (!empty($license)) {
				$json_temp['license']	= $license;
			}

			if (!empty($transaction)) {
				$json_temp['transaction']	= $transaction;
			}
			$json = $json_temp;
						
		}
		echo '<pre>';
		print_r($json);
	}

	/**
	 * function use for load view lead of product
	 * @param     null
	 * @return    mixed|string
	 */
	public function lead_details($product_id = NULL)
	{
		if ( empty($product_id) || !is_numeric($product_id) ) {
			$this->session->set_flashdata('error', 'Product id is not found.');
			redirect(base_url().'admin/products');
		}

		$sql = 'SELECT p.id,p.id as product_id, p.register_api,p.category_id, p.sub_category_id, p.product_name, p.overview, p.brief, p.highlight, p.highlight, p.usage,p.package_note,  p.support,p.type, p.version, p.logo, p.demo_url, p.status,p.video,p.sample_report,p.process_doc,p.programming_lang,p.other_programming_lang,p.framework,p.other_framework,p.user_manual,p.case_study,p.short_brief,c.cat_id, c.name as cat_name, sc.sub_cat_id, sc.name as sub_cat_name FROM products p 
		LEFT JOIN categories c ON CAST(c.cat_id AS TEXT) IN (p.category_id)
		LEFT JOIN sub_categories sc ON p.sub_category_id = sc.sub_cat_id ';

		$sql .=" WHERE p.is_deleted = 'false' AND p.id = ".$product_id." ";

		$edit_data = $this->masters_model->get_query($sql);
		
		if (!empty($edit_data)) {
			$data['products']   = $edit_data[0];
		}else{
			$this->session->set_flashdata('error', 'Product data is not found.');
			redirect(base_url().'admin/products');
		}		

		$data['title'] 		= 'Product Details';
		$data['subview'] 	= $this->load->view('admin/products/lead/view',$data ,true);
		$this->load->view('include/main',$data);
	}

	function get_status($status=''){
		$PRODUCT_STATUS=$this->config->item('PRODUCT_STATUS');
		$html='';
		if (!empty($PRODUCT_STATUS)) {
			foreach ($PRODUCT_STATUS as $row=>$val) { 
				$chk=($status==$row)?'selected':'';
				$html .='<option value="'.$row.'" '.$chk.'>'.$val['label'].'</option>';
			}
		} 
		return $html;
	}

	function get_leads_status($exist_status=''){
		$PRODUCT_STATUS=$this->config->item('PRODUCT_STATUS_LEADS');
		$role=$this->session->userdata('user_type');
		$select='<option value="">--Select--</option>';
		if (!empty($PRODUCT_STATUS)) {
			foreach ($PRODUCT_STATUS as $key => $status) { 
				if ($status['user'] == 'partner') {
					$disabled='';
					// if($exist_status >=$key){
					// 		$disabled='disabled';
					// }    
	                $selected = $key == $exist_status ? 'selected' : '';
	                $select .= '<option ' . $selected . ' '.$disabled.' value="' . $key . '">'.$status['label'] . '</option>';            
		        }
			}
		} 
		return $select;
	}

	private function get_product_kind_status($exist_status=''){
		$PRODUCT_STATUS=$this->config->item('PRODUCT_KIND');
		$select='<option value="">-- Select --</option>';
		if (!empty($PRODUCT_STATUS)) {
			foreach ($PRODUCT_STATUS as $key => $status) {  
	            $selected = $key == $exist_status ? 'selected' : '';
	            $select .= '<option ' . $selected .' value="' . $key . '">'.$status . '</option>';            
		        
			}
		} 
		return $select;
	}

	private function get_display_order($exist_order=''){
		$p_count = $this->masters_model->get_query_count("select id from products where  is_deleted ='FALSE' ");
		
		$select='<option value="">-- None --</option>';
		if ( $p_count > 0 ) {
			for ($i=1; $i <= $p_count; $i++) { 
	            $selected = $i == $exist_order ? 'selected' : '';
	            $select .= '<option ' . $selected .' value="' . $i . '">'.$i . '</option>';            
		        
			}
		}
		return $select;
	}
	
		/**
	 * function use for add/edit product
	 * @param       int $id
	 * @return    	mixed|string
	 */
	public function add_lead_product()
	{

		$product_id = !empty($this->input->get('product_id')) ? $this->input->get('product_id') :'';
		$action 	= !empty($this->input->get('action')) ? $this->input->get('action') :'basic_info';
		$mode 	= !empty($this->input->get('mode')) ? $this->input->get('mode') :'add';
		$product_type = !empty($this->input->get('product_type')) ? $this->input->get('product_type') :'';

		if(!empty($product_id) && !is_numeric($product_id)){
			$this->session->set_flashdata('error', 'Product id is not valid.');
			redirect(base_url().'admin/products');die();
		}

		//$data['title'] 		= 'Add Product';
		
		
		$data['edit_data'] 	= array();

		if ($action == 'basic_info') {
			$where = array('is_deleted'=>false,'is_active'=>true); 

			$data['categories_list'] 	= $this->Product_model->get_data(array('cat_id','name'),'categories',$where);
			
			$data['sub_categories_list']= $this->Product_model->get_data(array('sub_cat_id','name'),'sub_categories',$where);

			if(!empty($product_id)){
				$where1 = array('id'=>$product_id, 'is_deleted'=>false); 
				$edit_data = $this->Product_model->get_data('','products', $where1);
				$data['edit_data'] = $edit_data[0];
			}
			
			$data['mode'] 			= $mode;
			$data['product_id'] 	= $product_id;
			$data['action'] 		= 'basic_info';
			$data['product_type'] 	= $product_type;
			
		}elseif ($action == 'details_info') {
			$data['action'] 	= 'details_info';
			$data['product_id'] = $product_id;
			$data['product_type'] 		= $product_type;

			if($mode == 'edit'){
				$data['back_url'] = "admin/products/add_lead_product?action=basic_info&mode=edit&product_id=".$product_id;
			}
			else{
				$data['back_url'] = "admin/products/add_lead_product?action=basic_info&product_id=".$product_id;	
			}

			if(!empty($product_id)){
				$where1 = array('id'=>$product_id, 'is_deleted'=>false); 
				$edit_data = $this->Product_model->get_data('','products', $where1);
				$data['edit_data'] = $edit_data[0];
			}

		}elseif ($action == 'documentation') {
			$data['action'] 	= 'documentation';
			$data['product_id'] = $product_id;
			$data['product_type'] 		= $product_type;

			if($mode == 'edit'){
				$data['back_url'] = "admin/products/add_lead_product?action=details_info&mode=edit&product_id=".$product_id;
			}
			else{
				$data['back_url'] = "admin/products/add_lead_product?action=details_info&product_id=".$product_id;	
			}

			if(!empty($product_id)){
				$where1 = array('id'=>$product_id, 'is_deleted'=>false); 
				$edit_data = $this->Product_model->get_data('','products', $where1);
				$data['edit_data'] = $edit_data[0];

				$where2 = array('product_id'=>$product_id); 
				$product_images = $this->Product_model->get_data('','product_images', $where2);
				$data['product_images'] = $product_images;
			}

		}

		if($product_id){
			$where1  = array('id'=>$product_id, 'is_deleted'=>false); 
			$product = $this->Product_model->get_data('product_name','products', $where1);
			$data['product_name'] = $product[0]['product_name'];
			//print_r($data['product_name']); die;
		}
		if($mode == 'add'){	
			$data['title'] 		= 'Add Product';
		}
		else{
			$data['title'] 		= 'Edit Product';
		}
		$data['mode'] = $mode;
		$data['product_type'] = 'lead';
		$data['subview'] = $this->load->view('admin/products/add/add_lead',$data ,true);
		$this->load->view('include/main',$data);
	}
    
    	/**
	 * function use for save product
	 * @param     null
	 * @return    mixed|string
	 */
	public function product_save($action, $product_type)
	{

		if ($action == 'basic_info') {
			$result  = $this->save_basic_info($product_type);
			if ($result['status']) {
				$this->session->set_flashdata('success', $result['msg']);
			}
			echo json_encode($result);
			exit();
			
		}elseif($action == 'details_info'){

			$result  = $this->save_details_info($product_type);
			if ($result['status']) {
				$this->session->set_flashdata('success', $result['msg']);
			}
			echo json_encode($result);
			exit();
		}
		elseif($action == 'documentation'){
			//echo json_encode($_FILES); die;
			$result  = $this->save_documentation_info($product_type);
			if ($result['status']) {
				$this->session->set_flashdata('success', $result['msg']);
			}
			echo json_encode($result);
			exit();
		}
		elseif($action == 'ui_checklist'){
			$result  = $this->save_ui_checklist();
			if ($result['status']) {
				$this->session->set_flashdata('success', $result['msg']);
			}
			echo json_encode($result);
			exit();
		}
		elseif($action == 'api_info'){

			$result  = $this->save_api_info();

			if ($result['status']) {
				$this->session->set_flashdata('success', $result['msg']);
			}

			echo json_encode($result);
			exit();
		}
		else{
			$this->session->set_flashdata('error', 'Data is not valid. Please try again.');
			redirect(base_url('admin/products/add?action=basic_info'));die();
		}

	}

	/* add basic info of products */
	
		/**
	 * function use for add/edit product
	 * @param       int $id
	 * @return    	mixed|string
	 */
	public function add()
	{
		$product_id = !empty($this->input->get('product_id')) ? $this->input->get('product_id') :'';
		$action 	= !empty($this->input->get('action')) ? $this->input->get('action') :'basic_info';
		$mode 	= !empty($this->input->get('mode')) ? $this->input->get('mode') :'add';
		$product_type = !empty($this->input->get('product_type')) ? $this->input->get('product_type') :'';
		if(!empty($product_id) && !is_numeric($product_id)){
			$this->session->set_flashdata('error', 'Product id is not valid.');
			redirect(base_url().'admin/products');die();
		}

		if($mode == 'add'){
				
			$data['title'] 		= 'Add Product';
		}
		else{
			$data['title'] 		= 'Edit Product';
		}
		
		
		$data['edit_data'] 	= array();

		if ($action == 'basic_info') {
			$where = array('is_deleted'=>false,'is_active'=>true); 

			$data['categories_list'] 	= $this->Product_model->get_data(array('cat_id','name'),'categories',$where);
			
			$data['sub_categories_list']= $this->Product_model->get_data(array('sub_cat_id','name'),'sub_categories',$where);

			if(!empty($product_id)){
				$where1 = array('id'=>$product_id, 'is_deleted'=>false); 
				$edit_data = $this->Product_model->get_data('','products', $where1);
				$data['edit_data'] = $edit_data[0];	
			}
			
			$data['product_id'] 	= $product_id;
			$data['mode'] 			= $mode;
			$data['action'] 		= 'basic_info';
			$data['product_type'] 	= $product_type;
			
		}elseif ($action == 'details_info') {
			$data['action'] 	= 'details_info';
			$data['product_id'] = $product_id;
			$data['product_type'] 	= $product_type;
			$data['mode'] 			= $mode;

			if($mode == 'edit'){
				$data['back_url'] = "admin/products/add?action=basic_info&mode=edit&product_id=".$product_id;
			}
			else{
				$data['back_url'] = "admin/products/add?action=basic_info&product_id=".$product_id;	
			}
			
			if(!empty($product_id)){
				$where1 = array('id'=>$product_id, 'is_deleted'=>false); 
				$edit_data = $this->Product_model->get_data('','products', $where1);
				$data['edit_data'] = $edit_data[0];
			}

		}elseif ($action == 'documentation') {
			$data['action'] 	= 'documentation';
			$data['product_id'] = $product_id;
			$data['product_type'] 		= $product_type;
			$data['mode'] 			= $mode;

			if($mode == 'edit'){
				$data['back_url'] = "admin/products/add?action=details_info&mode=edit&product_id=".$product_id;
			}
			else{
				$data['back_url'] = "admin/products/add?action=details_info&product_id=".$product_id;	
			}

			if(!empty($product_id)){
				$where1 = array('id'=>$product_id, 'is_deleted'=>false); 
				$edit_data = $this->Product_model->get_data('','products', $where1);
				$data['edit_data'] = $edit_data[0];

				$where2 = array('product_id'=>$product_id); 
				$product_images = $this->Product_model->get_data('','product_images', $where2);
				$data['product_images'] = $product_images;
			}

		}elseif ($action == 'ui_checklist') {
			$data['action'] 	= 'ui_checklist';
			$data['product_id'] = $product_id;
			$where = array('is_deleted'=>false,'is_active'=>true);  
			$data['ui_lists'] 	= $this->Product_model->get_data(array('id','name'),'ui_items',$where);
			$data['product_type'] 		= $product_type;
			$data['mode'] 			= $mode;

			if($mode == 'edit'){
				$data['back_url'] = "admin/products/add?action=documentation&mode=edit&product_id=".$product_id;
			}
			else{
				$data['back_url'] = "admin/products/add?action=documentation&product_id=".$product_id;	
			}

			if(!empty($product_id)){
				$where1 = array('product_id'=>$product_id); 
				$edit_data = $this->Product_model->get_data('','product_ui_checklist', $where1);
				$data['ui_checklist'] = $edit_data;
			}

		}elseif ($action == 'api_info') {

			$data['action'] 	= 'api_info';
			$data['product_id'] = $product_id;
			$data['product_type'] 	= $product_type;
			$data['mode'] 			= $mode;

			if($mode == 'edit'){
				$data['back_url'] = "admin/products/add?action=ui_checklist&mode=edit&product_id=".$product_id;
			}
			else{
				$data['back_url'] = "admin/products/add?action=ui_checklist&product_id=".$product_id;	
			}



			if(!empty($product_id)){
				$where1 = array('product_id'=>$product_id, 'is_deleted'=>false); 
				$api_data = $this->Product_model->get_data('','product_api_details', $where1);
				$data['api_data'] = $api_data;

				$where2 = array('id'=>$product_id, 'is_deleted'=>false); 
				$prod_type = $this->Product_model->get_data('type','products', $where2);
				$data['prod_type'] = $prod_type[0];


			}

		}

		if($product_id){
			$where1  = array('id'=>$product_id, 'is_deleted'=>false); 
			$product = $this->Product_model->get_data('product_name','products', $where1);
			$data['product_name'] = $product[0]['product_name'];
			//print_r($data['product_name']); die;
		}


		$data['mode'] = $mode;
		$data['product_type'] = 'full';
		$data['subview'] = $this->load->view('admin/products/add/add',$data ,true);
		$this->load->view('include/main',$data);
	}
    
    /* add basic info of products */

	private function save_basic_info($product_type)
	{

		$result = array('status' => false , 'error' => '');
		$id   	= $this->input->post('id');
		$status = $this->input->post('status');
		
		if ( $this->input->post('product_name') && !empty($this->input->post('category_id')) ) {

			$this->form_validation->set_rules('category_id[]','Category', 'trim|required');
			$this->form_validation->set_rules('product_name','Product Name', 'trim|required|max_length[100]');


			if($product_type == 'full') {
				if( $status!=7 && $status!=8 ){
					$this->form_validation->set_rules('type','Type', 'trim|required');
				}
			}
			
			if($product_type == 'full') {
				if($this->input->post('type')=='Multi Tenant'){
					//$this->form_validation->set_rules('register_api','Register API', 'trim|required');
				}
			}
			$this->form_validation->set_rules('short_brief','Short Brief', 'trim|required');
			$this->form_validation->set_rules('version','Version', 'trim|max_length[100]');
			
			if ($this->form_validation->run() == TRUE) {
				
				if($product_type == 'full') {
					$fileds = array('sub_category_id','version','demo_url','package_note');
				}
				else{
					$fileds = array('sub_category_id','version','demo_url');
				}
				//Add multiple select
				$cat_id = $this->input->post('category_id');
				$category_id = implode(',', $cat_id); 
				$category 	 = array("category_id"=>$category_id);
				
				$data 		 = $this->Product_model->array_from_post($fileds);
				$data['product_name'] 		    = $this->input->post('product_name');
				$data['short_brief'] 		    = $this->input->post('short_brief');
				$data['price']                  = $this->input->post('price');
				$data['mrp']                  = $this->input->post('mrp');
				if($status!=7 && $status!=8){
					if($product_type == 'full') {
						$data['type']=$this->input->post('type');
					}
				}	
				// echo'<pre>';print_r($_FILES);exit;
				
				if (!empty($_FILES['logo']['name']))
				{
					$config['prefix'] 			= 'logo_';
					$config['upload_path']		= $this->config->item('LOGO_UPLOAD');
					$config['allowed_types']    = 'gif|jpg|png|jpeg';  
					$config['max_size']         = '20480';         
					$config['encrypt_name'] 	= TRUE;
					//$config['max_width']     	= '180';
					//$config['max_height']    	= '80';
					$data['logo'] 				= '';
					
					unset($data['old_logo']);

					$upload_files =	@$this->Product_model->upload_file('logo', $_FILES, $config);

					if(isset($upload_files[0]) && !empty($upload_files[0])) {
						$image = $upload_files[0][0];
						$data['logo']  = $image;
					} else {
						$error = $upload_files[1];

						if (!empty($error)) {
							$result = array('status' => false , 'msg' => $error);
						}
					}
					
				}
				
				$data = array_merge($category,$data);
				
				$data['partner_id'] = $this->session->userdata('user_id');

				$data['programming_lang'] 		= $this->input->post('programming_lang');
				$data['other_programming_lang'] = NULL;

				$data['framework'] 				= $this->input->post('framework');
				$data['other_framework'] 		= NULL;

				$data['product_type'] 			= ucfirst($product_type);
				if($product_type == 'lead') {
				$data['free_trial'] 			= $this->input->post('free_trial');
				$data['free_trial_link'] 		= $this->input->post('free_trial_link');
				}
					//print_r($data); die;
				


				if ( $this->input->post('programming_lang') == 'other' ) {
					$data['other_programming_lang'] = $this->input->post('other_programming_lang');
				}
				if ( $this->input->post('framework') == 'other' ) {
					$data['other_framework'] = $this->input->post('other_framework');
				}		

				if (empty($id)) {

					user_activity_logs("Partner: Product added", json_encode($data));
					$data['register_api']	 	= $this->input->post('register_api');
					$data['client_login_url']	= $this->input->post('client_login_url');
					


					$this->Product_model->add_data('products',$data);
					//echo $this->db->last_query(); die;

					$insert_id 	= $this->db->insert_id();

					if($product_type == 'lead'){
						$url = base_url().'admin/products/add_lead_product?action=details_info&product_id='.$insert_id;
						$url2 = base_url().'admin/products/add_lead?action=basic_info';
						$url3 = base_url().'admin/products/add_lead?action=basic_info&product_id='.$id;
					}
					else{
						$url = base_url().'admin/products/add?action=details_info&product_id='.$insert_id;
						$url2 = base_url().'admin/products/add?action=basic_info';
						$url3 = base_url().'admin/products/add?action=basic_info&product_id='.$id;
					}


					if ($insert_id) {
						
						$result = array(
							'status' => true ,
							'url' => $url,
							'msg' => 'Product saved successfully. Please fill more details of product.'
						);	
					}else {

						$result = array(
							'status' => false ,
							'url' =>$url2,
							'msg' => 'Products not added. Please try after some time.'
						);

					}

				}else {
					//print_r($data); die;

					//user_activity_log
					user_activity_logs("Partner: Product updated, Id: ".$id, json_encode($data));

					if($product_type == 'full') {
						if($status!='7' && $status!='8' && $this->input->post('prod_type') == 'Multi Tenant'){
							$data['register_api']		= $this->input->post('register_api');
							$data['client_login_url']	= $this->input->post('client_login_url');
						}
					}

					$result 	= $this->Product_model->update_data('products',array('id'=>$id), $data);
					$user_id	= $this->user_id;

					if($product_type == 'lead'){
						$url = base_url().'admin/products/add_lead_product?action=details_info&mode=edit&product_id='.$id;
						$url2 = base_url().'admin/products/add_lead?action=basic_info&mode=edit';
						$url3 = base_url().'admin/products/add_lead?action=basic_info&mode=edit&product_id='.$id;
					}
					else{
						$url = base_url().'admin/products/add?action=details_info&mode=edit&product_id='.$id;
						$url2 = base_url().'admin/products/add?action=basic_info&mode=edit';
						$url3 = base_url().'admin/products/add?action=basic_info&mode=edit&product_id='.$id;
					}
					// Approval Request.
					if($product_type =='full' && $this->input->post('prod_type') == 'Multi Tenant')
					{

						if($status=='7' || $status=='8'){
						
						$request_data = array(
							'post_data'		=>json_encode(array('register_api'=>$this->input->post('register_api'),
							'client_login_url'=>$this->input->post('client_login_url'),
							'api_data'=>$this->input->post('api_data'))),
							'product_id'	=>$id,
	                        'partner_id'	=>$user_id,
	                        'action_id'		=>$id,
	                        'action'		=>'update_product',
	                        'remark'		=>$this->input->post('remark_value'),
	                        'status'		=>'Pending',
	                        'created_by_id'	=>$user_id,
	                        'created_on'	=>current_date(),                 
						);

						$this->Product_model->add_data('change_requests',$request_data);

				// 		/************************ Partner mail **************************/
		  //              	$email 			= get_name_by_id('users','email', array('user_id'=>$this->user_id));
		  //              	$first_name 	= get_name_by_id('users','first_name', array('user_id'=>$this->user_id));
		  //              	$product_name 	= $this->input->post('product_name');
		  //              	$hr 			= $this->config->item('HR');

				// 			$mail_slug = array(
				// 				'body'=>array(
				// 					"{PARTNER_NAME}"	=> $first_name,
				// 					"{PRODUCT_PACKAGE}"	=> $product_name,
				// 					"{ACTION}"			=> 'Edit Product',
				// 					'{HR}'				=> $hr
				// 					),
				// 				'subject'=>array(
				// 					"{PARTNER_NAME}"	=>$first_name,
				// 					"{PRODUCT_PACKAGE}"	=>$product_name,
				// 					"{ACTION}"			=>'Edit Product'
				// 				)
				// 			);

				// 		$mail_data = get_email_body('approval_request_partner',$mail_slug);

				// 		$this->Email_model->send_mail($mail_data['subject'], $mail_data['body'],$email,$mail_data['from_mail'],$first_name);

				// 		//Email log
				// 		email_activity_logs($mail_data['subject'],$mail_data['body'],$email,$this->user_id,'partner');
						/************************ Admin Mail*****************************/
						
						$admin_mail=get_name_by_id('admins','email', array('id'=>1));
						$arr = array(
							'body'=>array("{PARTNER_NAME}"=>$first_name,"{PRODUCT_PACKAGE}"=>$product_name,"{ACTION}"=>'Edit Product','{HR}'=>$hr),
							'subject'=>array("{PARTNER_NAME}"=>$first_name,"{PRODUCT_PACKAGE}"=>$product_name,"{ACTION}"=>'Edit Product')
						);

						$mail_data= get_email_body('approval_request_admin',$arr);

						$this->Email_model->send_mail($mail_data['subject'], $mail_data['body'],$admin_mail,$mail_data['from_mail'],'Spochub');

						//Email log
						email_activity_logs($mail_data['subject'],$mail_data['body'],$admin_mail,1,'admin');
						/****************************** Admin Mail************************/
						$this->session->set_flashdata('success', 'Your request for update product is sent for Approval.');
						$result = array(
							'status' => true ,
							'url' =>$url,
							'msg' => 'Your request for update product is sent for Approval.'
						);
						}else{
							$result = array(
							'status' => true ,
							'url' =>$url,
							'msg' => 'Basic information saved successfully. Please fill more details of product'
							);
						}

					}else{
						$result = array(
							'status' => true ,
							'url' =>$url,
							'msg' => 'Basic information saved successfully. Please fill more details of product'
						);
					}
				/*}else{
						$result = array(
							'status' => true ,
							'url' =>$url,
							'msg' => 'Basic information saved successfully. Please fill more details of product'
						);
					}*/

					
				}
			}else{

				$result = array(
						'status' => true ,
						'url' =>$url3,
						'msg' => 'Please fill the required filed.'
					);
			}
		}else{
			$result = array(
					'status' => true ,
					'url' =>$url2,
					'msg' => 'Please fill the required filed.'
				);
		}
		return $result;
	}

	/* add details info of products */

	private function save_details_info($product_type)
	{

		$result = array('status' => false , 'error' => '');
		$id   	= $this->input->post('id');
		$status = $this->input->post('status');
		if ($id != '') 
		{
			if($product_type == 'lead'){
				$url = base_url().'admin/products/add_lead_product?action=documentation&mode=edit&product_id='.$id;
				$url2 = base_url().'admin/products/add_lead_product?action=details_info&mode=edit&product_id='.$id;
			}
			else{
				$url = base_url().'admin/products/add?action=documentation&mode=edit&product_id='.$id;
				$url2 = base_url().'admin/products/add?action=details_info&mode=edit&product_id='.$id;
			}

		/*$this->form_validation->set_rules('brief','Product Brief', 'required');
		$this->form_validation->set_rules('overview','Product Overview', 'required');
		$this->form_validation->set_rules('highlight','Product Highlight', 'required');
		$this->form_validation->set_rules('usage','Usage', 'required');
		$this->form_validation->set_rules('support','Support', 'required');
			
		if ($this->form_validation->run() == TRUE) {*/
				
			$data['partner_id'] 	= $this->session->userdata('user_id');
			$data['brief'] 			= $this->input->post('brief');
			$data['overview'] 		= $this->input->post('overview');;
			$data['highlight'] 		= $this->input->post('highlight');
			$data['usage'] 			= $this->input->post('usage');
			$data['support'] 		= $this->input->post('support');



				user_activity_logs("Partner: Product added", json_encode($data));
				
				$res 	= $this->Product_model->update_data('products',array('id'=>$id), $data);

				//return $res;



				if ($res) {
						
					$result = array(
						'status' => true ,
						'url' => $url,
						'msg' => 'Product details information saved successfully. Please fill more details of product.'
					);	
				}
				
			//}
		/*}
		else{
			$result = array(
				'status' => true ,
				'url' => $url2,
				'msg' => 'Please fill all the details.'
			);
		}*/
	}

		return $result;
	}

	public function save_documentation_info($product_type)
	{
		//print_r($_POST); print_r($_FILES); die;
		//return '****'; die;
		$result = array('status' => false , 'error' => '');
		$id   	= $this->input->post('id');
		$status = $this->input->post('status');
		$mode   = $this->input->post('mode');
		$image_count = $this->input->post('image_count');
		$old_user_manual = $this->input->post('old_user_manual');

		$update_array = array();

		//return json_encode($_FILES); die; 

		if (!empty($_FILES['case_study']['name']))
		{
			$config['prefix'] 			= 'case_study_';
			$config['upload_path']		= $this->config->item('CASE_STUDY_UPLOAD');
			$config['allowed_types']    = 'jpg|jpeg|png|ppt|doc|docx|pdf';  
			$config['max_size']         = '25000000';         
			$config['encrypt_name'] 	= TRUE;
			//$config['max_width']     	= '180';
			//$config['max_height']    	= '80';
			

			//unset($data['old_case_study']);

			$upload_files =	@$this->Product_model->upload_file('case_study', $_FILES, $config);

			if(isset($upload_files[0]) && !empty($upload_files[0])) {
				$case_study = $upload_files[0][0];
				$update_array['case_study'] = $case_study;
				//return json_encode($update_array); die;
			} else {
				$error = $upload_files[1];

				
			}
			
		}
		
		if (!empty($_FILES['user_manual']['name']))
		{
			$config['prefix'] 			= 'user_manual_';
			$config['upload_path']		= $this->config->item('USER_MANUAL_UPLOAD');
			$config['allowed_types']    = 'jpg|jpeg|png|ppt|doc|docx|pdf';  
			$config['max_size']         = '25000000';         
			$config['encrypt_name'] 	= TRUE;
			//$config['max_width']     	= '180';
			//$config['max_height']    	= '80';
			//$data['old_user_manual'] 	= NULL;

		

			$upload_files =	@$this->Product_model->upload_file('user_manual', $_FILES, $config);
			
			if(isset($upload_files[0]) && !empty($upload_files[0])) {
				$user_manual = $upload_files[0][0];
				$update_array['user_manual'] = $user_manual;
			} else {
				$error = $upload_files[1];

				
			}
		}

		if (!empty($_FILES['video']['name']))
		{
			$config['prefix'] 			= 'video_';
			$config['upload_path']		= $this->config->item('VIDEO_UPLOAD');
			$config['allowed_types']    = 'flv|mp4|ts|3gp|mov|avi';  
			$config['max_size']         = '25000000';         
			$config['encrypt_name'] 	= TRUE;
			//$config['max_width']     	= '180';
			//$config['max_height']    	= '80';
			$data['logo'] 				= '';

			//unset($data['old_video']);

			$upload_files =	@$this->Product_model->upload_file('video', $_FILES, $config);

			if(isset($upload_files[0]) && !empty($upload_files[0])) {
				$video = $upload_files[0][0];
				$update_array['video'] = $video;
			} else {
				$error = $upload_files[1];

				
			}
		}

		if (!empty($_FILES['sample_report']['name']))
		{
			$config['prefix'] 			= 'sample_report_';
			$config['upload_path']		= $this->config->item('SAMPLE_REPORT_UPLOAD');
			$config['allowed_types']    = 'jpg|jpeg|png|ppt|doc|docx|pdf';  
			$config['max_size']         = '25000000';         
			$config['encrypt_name'] 	= TRUE;
			//$config['max_width']     	= '180';
			//$config['max_height']    	= '80';
			$data['logo'] 				= '';

			//unset($data['old_sample_report']);

			$upload_files =	@$this->Product_model->upload_file('sample_report', $_FILES, $config);

			if(isset($upload_files[0]) && !empty($upload_files[0])) {
				$sample_report = $upload_files[0][0];
				$update_array['sample_report'] = $sample_report;
			} else {
				$error = $upload_files[1];

			}
		}

		//echo json_encode($_FILES); die;

		if (!empty($_FILES['process_doc']['name']))
		{
			$config['prefix'] 			= 'process_doc_';
			$config['upload_path']		= $this->config->item('PROCESS_DOC_UPLOAD');
			$config['allowed_types']    = 'jpg|jpeg|png|ppt|doc|docx|pdf';  
			$config['max_size']         = '25000000';         
			$config['encrypt_name'] 	= TRUE;
			//$config['max_width']     	= '180';
			//$config['max_height']    	= '80';
			$data['logo'] 				= '';

			//unset($data['old_process_doc']);

			$upload_files =	@$this->Product_model->upload_file('process_doc', $_FILES, $config);
			//return $upload_files; die;

			if(isset($upload_files[0]) && !empty($upload_files[0])) {
				$process_doc = $upload_files[0][0];
				$update_array['process_doc'] = $process_doc;
			} else {
				$error = $upload_files[1];

				
			}
		}

		$res 	= $this->Product_model->update_data('products',array('id'=>$id), $update_array);

		$this->db->where('product_id', $id);
		$this->db->delete('product_images');

		for ($i=1; $i <=5 ; $i++) { 
			
			if (!empty($_FILES['product_image_'.$i]['name']))
			{
				$config['prefix'] 			= 'product_images_';
				$config['upload_path']		= $this->config->item('PRODUCT_IMAGE_UPLOAD');
				$config['allowed_types']    = 'gif|jpg|png|jpeg';  
				$config['max_size']         = '25000000';         
				$config['encrypt_name'] 	= TRUE;
				//$config['max_width']     	= '180';
				//$config['max_height']    	= '80';
				$data['logo'] 				= '';

				
				$upload_files =	@$this->Product_model->upload_file('product_image_'.$i, $_FILES, $config);
				//return json_encode($upload_files); die;
				
				if(isset($upload_files[0]) && !empty($upload_files[0])) {
					$product_image = $upload_files[0][0];
					$product_images_array = array( 'product_id' => $id, 	
										   		   'product_image'  => $product_image
												);

					$res1 	= $this->db->insert('product_images', @$product_images_array);
					//return $res1; die;
					//return json_encode($product_images_array); die;
				} else {
					$error = $upload_files[1];	
				}
				
			}
			else if(!empty($_POST['old_product_image_'.$i])){
				$product_image = $_POST['old_product_image_'.$i];
				$product_images_array = array( 'product_id' => $id, 	
										   	   'product_image'  => $product_image
											);

				$res1 	= $this->db->insert('product_images', @$product_images_array);
			}
		}

		//return json_encode($update_array); die;

		
	
		if ($res || @$res1 || $mode == 'edit') {
			if($product_type == 'lead'){	
				$url = base_url().'admin/products/';	
				$url2 = base_url().'admin/products/add_lead?action=documentation&mode=edit&product_id='.$id;	
				$msg = 'Product Documentation added successfully.';	
			}	
			else{	
				$url = base_url().'admin/products/add?action=ui_checklist&mode=edit&product_id='.$id;	
				$url2 = base_url().'admin/products/add?action=documentation&mode=edit&product_id='.$id;	
				$msg = 'Product Documentation saved successfully. Please fill more details of product.';	
			}

				
			$result = array(
				'status' => true ,
				'url' => $url,
				'msg' => $msg
			);	
		}
		else{
			$result = array(
				'status' => false ,
				'url' =>$url2,
				'msg' => 'Not Updated.'
			);	
		}
		return $result;
	}
    
    public function delete(){
		$product_id = !empty($this->input->get('product_id')) ? $this->input->get('product_id') :'';

		$data = array(
						'is_deleted' 	=> true,
						'deleted_by_id' => $this->user_id,
						'deleted_on'	=> current_date()
						);
		$result 	= $this->Product_model->update_data('products',array('id'=>$product_id), $data);

		if($result){
			$where = array('product_id'=>$product_id);
			$res1 = $this->Product_model->update_data('product_images', $where);

			$res2 	= $this->Product_model->update_data('product_api_details',$where, $data);
			$res3 = $this->Product_model->delete_data('product_ui_checklist', $where);

			if($res1 || $res2 || $res3){
				$this->session->set_flashdata('success', 'Product Deleted Successfully.');
			}
		}
	}
	/**
	 * function use for delete product
	 * @param     null
	 * @return    json
	 */
	public function delete_product()
    {

        $product_id = $this->input->post('product_id');
        $remark 	= $this->input->post('remark');
        $user_id 	= $this->user_id;

        if (!empty($product_id)) {
        	 $where = array('id'=>$product_id);
        	$product_status = get_name_by_id('products','status',$where);
        	if($product_status!='7' && $product_status!="8"){

	            $result = $this->Product_model->delete_data('products',$where);
	            if($result){
	              	$message = array('status'=>true,'message'=>'Your product is deleted successfully.');
	            }else{
	              	$message = array('status'=>true,'message'=>'Your product not delete! please try agin.');
	            }

        	}else{

				user_activity_logs("Partner: Product deleted", "Product_id:".$product_id);
				$post_data = array(
				    'product_id'=>$product_id,
				    'partner_id'=>$user_id,
				    'action_id'	=>$product_id,
				    'action'	=>'delete_product',
				    'post_data'	=>json_encode(array('product_id'=>$product_id)),
				    'remark'	=>$remark,
				    'status'	=>'Pending',
				    'created_by_id'=>$user_id,
				    'created_on' =>current_date(),
				);    
                $result = change_requests_by_partner($post_data);
                  
                if ($result) {
                  	/************************ Partner mail **************************/
	                	$email = get_name_by_id('users','email', array('user_id'=>$this->user_id));
	                	$first_name = get_name_by_id('users','first_name', array('user_id'=>$this->user_id));
	                	$product_name = $this->input->post('product_name');
	                	$hr = $this->config->item('HR');
						$mail_slug = array(
							'body'=>array(
								"{PARTNER_NAME}"=>$first_name,
								"{PRODUCT_PACKAGE}"=>$product_name,
								"{ACTION}"=>'Delete Product',
								'{HR}'=>$hr
							),
							'subject'=>array(
								"{PARTNER_NAME}"=>$first_name,
								"{PRODUCT_PACKAGE}"=>$product_name,
								"{ACTION}"=>'Delete Product'
							)
						);

						$mail_data = get_email_body('approval_request_partner',$mail_slug);

						$this->Email_model->send_mail($mail_data['subject'], $mail_data['body'],$email,$mail_data['from_mail'],$first_name);

						//Email log
						email_activity_logs($mail_data['subject'],$mail_data['body'],$email,$this->user_id,'partner');
						/****************************** Admin Mail***************************************/
						
						$admin_mail = email_by_admin_role();
						$mail_slug = array(
							'body'=>array(
								"{PARTNER_NAME}"=>$first_name,
								"{PRODUCT_PACKAGE}"=>$product_name,
								"{ACTION}"=>'Delete Product',
								'{HR}'=>$hr
							),
							'subject'=>array(
								"{PARTNER_NAME}"=>$first_name,
								"{PRODUCT_PACKAGE}"=>$product_name,
								"{ACTION}"=>'Delete Product'
							)
						);

						$mail_data = get_email_body('approval_request_admin',$mail_slug);

						$this->Email_model->send_mail($mail_data['subject'], $mail_data['body'],$admin_mail,$mail_data['from_mail'],'Spochub');

						//Email log
						email_activity_logs($mail_data['subject'],$mail_data['body'],$admin_mail,1,'admin');
						/****************************** Admin Mail***************************************/

					$message = array('status'=>true,'message'=>'Your request for deleting the product is sent for Approval.');
                }else{

                    $message = array('status'=>false,'message'=>'Your request for deleting the product is failed to sent. Try agin!');
                }
          	}
        }else{
            $message = array('status'=>false,'message'=>'Product id not found.');
        }
        echo json_encode($message);
    }

	public function remove_image(){
		$img_id = $this->input->post('img_id');
		$table  = $this->input->post('table');
		$field_name = $this->input->post('field_name');

		$this->db->where('id', $img_id);
		$data 		= array($field_name => NULL);
		if($table == 'product_images'){
			$res 	= $this->db->delete($table);
		}
		else{
			$res 	= $this->db->update($table, $data);
		}
		echo $res;
	}

}