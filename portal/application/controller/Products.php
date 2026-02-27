<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
	Class Name 		: 	Order
	Created By		: 	Kamlesh Chaube.
	Created Date 	: 	22-8-2019
	Updated Date 	: 	22-8-2019
*/

class Products extends MY_Controller 
{
	public function __construct()
	{
        parent::__construct();
        $this->load->model('Masters_model'); 
    }
    /**
	 * function use for order index pagw
	 * @param       null
	 * @return    	mixed|string
	 */
	public function index()
	{
		$data['title']		= 'Products';
		$data['subview'] 	= $this->load->view('product/index',$data ,true);
		$this->load->view('include/main',$data);
	}
	/**
	 * function use for get product list
	 * @param     null
	 * @return    json
	 * Created By	: 	Aayusha k.
	 * Created Date : 	11-9-2020
	 */
	public function get_product_data($select,$table,$column_order=array(),$column_search=array(),$order_by=array())
	{ 
		// Get product details for listing
		$configArr 	= array('table'=>$table,'column_order'=>$column_order,'column_search'=>$column_search,'order_by'=>$order_by);
		$sql 	 = 'SELECT '.$select.' from client_order_product cop  ' ;
		$sql	.=' LEFT JOIN products P ON P.id  = cop.product_id ';
		$sql	.=' LEFT JOIN client_orders o ON o.id  = cop.order_id ';
		$sql	.="  WHERE cop.client_id = ".$this->session->userdata('user_id')." AND o.is_deleted=false ";

		if(!empty($this->input->post('product_name')))
		{
			$sql.=" AND (LOWER(p.product_name) LIKE '%".strtolower($this->input->post('product_name'))."%') ";	
		}
		if(!empty($this->input->post('search_filter_date'))) {
			$date=date('Y-m-d',strtotime($this->input->post('search_filter_date')));
			$sql.=" AND date(cop.created_on)='$date' ";
		}
		if($this->input->post('status') != ''){
			$status 	=	strtolower($this->input->post('status'));
			$sql		.=" AND LOWER(cop.status)='$status' ";
		}
		// for datatable search.
		if(!empty($this->input->post('search[value]')) || !empty($this->input->post('search_filter')))
		{
			$searchVal=$this->input->post('search[value]')?$this->input->post('search[value]'):$this->input->post('search_filter');
			$sql.=" AND LOWER(p.product_name) LIKE '%".strtolower($searchVal)."%' ";	
		}
		return array('product_lists' => $this->Masters_model->get_datatables_master($sql, $configArr),'sql'=>$sql,'configArr'=>$configArr);
	}
	
	/**
	 * function use for product list
	 * @param       null
	 * @return    	json
	 */
	public function product_list()
	{
		$table = 'client_order_product cop';
		$column_order = array('cop.id', 'cop.order_date','cop.status'); 
		//set column field database for datatable orderable
		$column_search = array('LOWER(P.product_name)','LOWER(cop.status)');
		$order_by = array('cop.id' => 'DESC');
		$product_lists=self::get_product_data('P.product_name,P.id as product_id,cop.created_on,cop.status,P.partner_id,o.plan_details,o.order_completion_date',$table,$column_order,$column_search,$order_by);

		$sql		= $product_lists['sql'];
	 	$configArr	= $product_lists['configArr'];

		$no 	 = 0;
		$data 	= array();
		$no 	= $_POST['start'];
		if (!empty($product_lists['product_lists'] )) {
				foreach ($product_lists['product_lists']  as $products) {
					$package = json_decode($products->plan_details,true);
					$row   = array();
					$row[] = ++$no;
					$row[] = ucfirst($products->product_name);
					$row[] = ucfirst($package['package_name']);
					$row[] = date_converter($products->created_on,'d-m-Y');
					$row[] = date_converter($products->order_completion_date,'d-m-Y');
					if($products->status == 'Pending') {
						$status ='<span class="label label-warning">'.($products->status).'</span>' ;
					}elseif($products->status == 'Inprogress'){
						$status='<span class="label label-info">'.($products->status).'</span>';
					}else{
						$status='<span class="label label-success">'.($products->status).'</span>';
					}
					$row[] = $status;
					$data[] = $row;
				}
		}

		$output = array(
			"draw" 				=> $_POST['draw'],
			"recordsTotal" 		=> $this->Masters_model->count_all_master($table),
			"recordsFiltered" 	=> $this->Masters_model->count_filtered_master($sql, $configArr),
			"data" 				=> $data,
		);
		echo json_encode($output); die();
		
	}
	/**
	 * function use for Generate and Download CSV
	 * @param     null
	 * @return    json
	 * Created By	: 	Aayusha k.
	 * Created Date : 	11-9-2020
	 */
	public function export_csv()
	{ 
		$product_lists=self::get_product_data('P.product_name,o.plan_details->>\'package_name\',date(cop.created_on) created_on, cop.status','products',array(),array(),array('cop.id' => 'DESC'));
		if(!empty($product_lists['product_lists'])){
		$filename = 'client_products_csv_'.date('YmdHis').'.csv';
 		$header = array("Product Name", "Package Name", "Date", "Status"); 

 		$product_array = array_map(function ($v) {
 		return (array) $v ; // convert to array 
 			}, $product_lists['product_lists']);
		foreach ($product_array as $key=>$line){ // For lable of frequency
			 $product_array[$key]['product_name'] 	= html_entity_decode($line['product_name']);
		}
	 	download_csv($filename,$header,$product_array);
	 	}else{
			$this->session->set_flashdata('error', 'Product data not found!');
			redirect(base_url('products'));
	 	}
	}
}