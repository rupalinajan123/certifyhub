<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Front_Products_model
 *
 * @package 	: Marketplace
 * @author 		: Deepak K
 */

class Front_Products_model extends MY_Model
{
	function __construct()
	{
		parent::__construct();
	}

	/**
	 * function use for get package details
	 * @param     int $product_id
	 * @return    array
	 */
	public function get_package_details($product_id)
	{
		$select = array('p.id as product_id','p.product_type', 'p.product_name','p.package_note', 'p.overview', 'p.brief','p.short_brief', 'p.highlight', 'p.usage', 'p.id as product_service_id', 'p.support', 'p.version', 'p.logo','p.user_manual','p.case_study','p.video','p.sample_report','p.video','p.process_doc','p.type','p.created_on','p.free_trial','p.verified','p.price','p.mrp','users.company_name', '(select round(sum(ratings)/count(ratings)) from product_review where product_id=' . $product_id . ' AND is_active=true )as rating');

		$table = "products p";

		$where = "p.is_deleted = 'false' AND p.status = '7' AND p.id=" . $product_id;

		$join = array(
			'users'			=> array('users.user_id = p.partner_id', 'left'),
		);

		$edit_data = $this->get_data($select, $table, $where, $join);
		if (!empty($edit_data)) {
			$edit_data = $edit_data[0];
		}
		

		$data['products']  = $edit_data;


		$sql = 'SELECT ppkgd.product_id,
			  ( 
			    SELECT json_agg(item)
			    FROM (
			      SELECT *
			      FROM product_package_license ppkgl WHERE ppkgl.package_id = ppkgd.id AND "ppkgl"."is_deleted" = FALSE
			    ) item
			  ) AS package_license_list,
			  ( 
			    SELECT json_agg(item)
			    FROM (
			      SELECT *
			      FROM product_package_features ppkf WHERE ppkf.package_id = ppkgd.id AND "ppkf"."is_deleted" = FALSE
			    ) item
			  ) AS package_features_list,
			  ( 
			    SELECT json_agg(item)
			    FROM (
			      SELECT *
			      FROM product_package_transaction ppkgt WHERE ppkgt.package_id = ppkgd.id AND "ppkgt"."is_deleted" = FALSE
			    ) item
			  ) AS package_transaction_list,
			"ppkgd"."id" as "package_id",
			"ppkgd"."package_name", "ppkgd"."implementation_amount",
			"ppkgd"."implementaion_frequency", "ppkgd"."support_amount",
			"ppkgd"."support_frequency", "ppkgd"."license_frequency",
			"ppkgd"."features_amount", "ppkgd"."features_frequency","ppkgd"."package_type",
			"ppkgd"."transaction_frequency"
			FROM product_package_details ppkgd WHERE "ppkgd"."is_deleted" = FALSE AND "ppkgd"."is_active" = TRUE AND ppkgd.product_id = ' . $product_id . ' ORDER BY "ppkgd"."id" ;';
		$data['product_details'] = $this->get_query($sql);

		$data['license_elements'] 	= $this->get_data(array('id', 'license_name'), 'package_license_element', array('is_deleted' => false, 'is_active' => true));
		return $data;
	}

	/**
	 * function use get product review
	 * @param       product_id
	 * @return    	array
	 */
	public function products_review($product_id, $top = false)
	{
		/*$sql='SELECT "product_review".*, "client"."first_name", "client"."last_name" 
		FROM "product_review" 
		LEFT JOIN "client" ON "client"."id" = "product_review"."user_id"
		WHERE "product_review"."product_id" = '.$product_id.' AND "product_review"."is_active" = TRUE 
		ORDER BY "product_review"."id" desc LIMIT 10';
		$res = $this->db->query($sql);
		return $res->result_array();*/

		$limit = 10;
		$where = array('product_review.product_id' => $product_id, 'product_review.is_active' => true);
		if ($top) {
			$where['product_review.ratings >='] = 3;
			$limit = 4;
		}
		$join = array('client ' => 'client.id = product_review.user_id');
		return $this->get_data(
			array('product_review.*', 'client.first_name', 'client.last_name'),
			'product_review',
			$where,
			$join,
			'product_review.id desc',
			'0',
			$limit
		);
	}

	/**
	 * function use get product count
	 * @param       id
	 * @return    	array
	 */
	public function get_products()
	{
		$sql = "SELECT (select round(sum(ratings)/count(ratings)) from product_review r 
		where r.product_id=p.id AND r.is_active=true )as rating,u.company_name as company_name,p.product_kind,p.product_name,p.short_brief,p.logo,p.id,p.cover_image  from products p 
		left join product_review r on r.product_id=p.id 
		left join users u on u.user_id=p.partner_id
		WHERE  p.status = '7' AND  p.is_deleted = FALSE AND u.is_active = true ";

		$sql .= " group by p.id,u.company_name ORDER BY p.product_kind,p.product_name ASC  ";
		
		$rest = $this->db->query($sql);
		return $rest->result_array();
	}

	

	/**
	 * function use get most popular products
	 * @return    	array
	 */
	public function most_popular_products()
	{
/*		$sql = "SELECT 
		(select case 
				WHEN round(sum(ratings)/count(ratings)) > 2
				then round(sum(ratings)/count(ratings))
				ELSE 0
				END
		from product_review r where r.product_id=p.id )as rating,
	   (select count(cop.client_id) from client_order_product cop	where cop.product_id = p.id )as client_count,
	   (select count(pl.id) from product_leads pl	where pl.product_id = p.id )as lead_count,
		u.company_name as company_name,p.product_name,p.brief,p.logo,p.id,p.id as product_id  from products p 
		left join product_review r on r.product_id=p.id 
		left join users u on u.user_id=p.partner_id
		WHERE  p.status = '7' AND  p.is_deleted = FALSE AND u.is_active = true ";
*/
		$sql = "SELECT
		(select case 
				WHEN round(sum(ratings)/count(ratings)) > 3
				then round(sum(ratings)/count(ratings))
				ELSE 0
				END
		from product_review r where r.product_id=p.id AND r.is_active=true )as rating,
		(select count(pl.id) from product_leads pl where pl.product_id = p.id AND pl.product_type = 'Lead' )as lead_count,
		p.product_name,p.short_brief,p.logo,p.cover_image,p.video,p.published_date,p.id,p.id as product_id,p.price,p.brief  from products p 
		left join categories c on c.cat_id=p.category_id::bigint 
		WHERE  p.status = '7' AND  p.is_deleted = FALSE AND product_type = 'Lead' AND c.is_active= true";
		$sql .= " group by p.id ORDER BY lead_count desc,p.product_name ASC  ";
		$rest = $this->db->query($sql);
		return $rest->result_array();
	}

	/**
	 * function use get testimonials
	 * @return    	array
	 */
	public function get_testimonials()
	{
		$sql  = "SELECT * FROM testimonials WHERE is_deleted = 'false' AND is_active = 'true' ORDER BY id DESC";
		return $this->get_data('*',
			'testimonials',
			array('is_deleted' => 'false','is_active' => 'true'),
			'',
			'id desc'
		);
	}

	/**
	 * function use get product count
	 * @param       id
	 * @return    	array
	 */
	public function get_products_by_cat($category_id='', $limit = '', $start = '0')
	{

		$sub = '';
		$sub1 = '';
		$products = array();

		$search_key = $_GET['search'];
		$search_where = '';

		if(!empty($search_key)){
			$search_where = " AND (p.product_name ILIKE '%".strtolower($search_key)."%' OR p.short_brief ILIKE '%".strtolower($search_key)."%' OR p.programming_lang ILIKE '%".strtolower($search_key)."%' OR p.other_programming_lang ILIKE '%".strtolower($search_key)."%' OR p.framework ILIKE '%".strtolower($search_key)."%') ";
		}

		if (!empty($category_id)) {

			$cat_id = $this->db->escape_like_str($category_id);			
			$sub 	= ' cross join unnest(string_to_array(category_id, \',\')) AS k(cat_id)';
			$sub1 	= "trim(category_id) = ANY ( string_to_array('$cat_id', ',') )  AND ";
			
			$sql = "SELECT (select round(sum(ratings)/count(ratings)) from product_review r 
			where r.product_id=p.id AND r.is_active=true )as rating,u.company_name as company_name,p.id,p.seo_url,p.product_name,p.short_brief,p.video,p.logo,p.cover_image,p.created_on, p.published_date, p.price from products p $sub 
			left join product_review r on r.product_id=p.id 
			left join users u on u.user_id=p.partner_id
			left join categories c on c.cat_id=p.category_id::bigint 
			WHERE  $sub1 p.status = '7' AND  p.is_deleted = FALSE AND u.is_active = true AND c.is_active= true";

			$sql .= " group by p.id,u.company_name ORDER BY p.product_kind,p.product_name ASC  ";
			if (!empty($limit)) {
				$sql .= " limit  " . $limit . " OFFSET " . ($start) . "";
			}
			
			$rest 		= $this->db->query($sql);
			$products 	= $rest->result_array();
			
		}else{
			$sql = "SELECT (select round(sum(ratings)/count(ratings)) from product_review r 
				where r.product_id=p.id AND r.is_active=true )as rating,u.company_name as company_name,p.id,p.seo_url,p.product_name,p.short_brief,p.logo,p.cover_image,p.video, p.created_on, p.published_date, p.price from products p $sub 
				left join product_review r on r.product_id=p.id 
				left join users u on u.user_id=p.partner_id
				left join categories c on c.cat_id=p.category_id::bigint 
				WHERE  $sub1 p.status = '7' AND  p.is_deleted = FALSE AND c.is_active= true AND u.is_active = true ".$search_where;

				$sql .= " group by p.id,u.company_name ORDER BY p.display_order,p.product_name ASC  ";
				if (!empty($limit)) {
					$sql .= " limit  " . $limit . " OFFSET " . ($start) . "";
				}
				
				$rest 		= $this->db->query($sql);
				$products 	= $rest->result_array();
		}
		

		return $products;
	}


	/**
	 * function use get product search
	 * @param       search,limit and start
	 * @return    	array
	 */
	public function get_product_search($search)
	{
		$sql = "SELECT p.id,p.seo_url,p.product_name  from products p  
		WHERE   p.status = '7' AND  p.is_deleted = FALSE ";

		$search = strtolower($search);
		// $sql .= " AND ( LOWER(p.product_name) LIKE '%".$this->db->escape_like_str($search)."%' OR LOWER(p.brief) LIKE '%".$this->db->escape_like_str($search)."%' OR LOWER(p.overview) LIKE '%".$this->db->escape_like_str($search)."%' OR LOWER(p.highlight) LIKE '%".$this->db->escape_like_str($search)."%'  ) ";
		$sql .= " AND ( LOWER(p.product_name) LIKE '".$this->db->escape_like_str($search)."%'  ) ";


		$sql .= "  ORDER BY p.product_name ASC  ";

		$rest = $this->db->query($sql);

		if($rest->num_rows()) 
		{
		   return $rest->result_array();
		}
		return array();
	}


	/**
	 * function use get Category search
	 * @param       search
	 * @return    	array
	 */
	public function get_cat_search($search='')
	{

		$sql = "SELECT cat_id,name  from categories 
		WHERE   is_active = TRUE AND  is_deleted = FALSE ";

		$search = strtolower($search);
		$sql .= " AND ( LOWER(name) LIKE '%".$this->db->escape_like_str($search)."%'  ) ";
		

		$sql .= "  ORDER BY display_order ASC";

		$rest = $this->db->query($sql);

		if($rest->num_rows()) 
		{
		   return $rest->result_array();
		}
		return array();
	}

	/**
	 * function use for get package details
	 * @param     int $product_id
	 * @return    array
	 */
	public function get_package_details_by_id($package_id)
	{
		if (empty($package_id) || $package_id == '' || !is_numeric($package_id) || preg_match('#[^0-9]#',$package_id)) {
			$this->session->set_flashdata('error', 'Package id is not found.');
			redirect(base_url() . 'partner/products');
		}

		$sql = 'SELECT ppkgd.product_id,
			  (
			    SELECT json_agg(item)
			    FROM (
			      SELECT *
			      FROM product_package_license ppkgl WHERE ppkgl.package_id = ppkgd.id AND "ppkgl"."is_deleted" = FALSE
			    ) item
			  ) AS package_license_list,
			  (
			    SELECT json_agg(item)
			    FROM (
			      SELECT id,name
			      FROM product_package_features ppkf WHERE ppkf.package_id = ppkgd.id AND "ppkf"."is_deleted" = FALSE
			    ) item
			  ) AS package_features_list,
			  (
			    SELECT json_agg(item)
			    FROM (
			      SELECT *
			      FROM product_package_transaction ppkgt WHERE ppkgt.package_id = ppkgd.id AND "ppkgt"."is_deleted" = FALSE
			    ) item
			  ) AS package_transaction_list,
			"ppkgd"."id" as "package_id",
			"ppkgd"."package_name", "ppkgd"."implementation_amount",
			"ppkgd"."implementaion_frequency", "ppkgd"."support_amount",
			"ppkgd"."support_frequency", "ppkgd"."license_frequency",
			"ppkgd"."features_amount", "ppkgd"."features_frequency",
			"ppkgd"."transaction_frequency","ppkgd"."product_package_id","ppkgd"."package_type"
			FROM product_package_details ppkgd WHERE "ppkgd"."is_deleted" = FALSE AND ppkgd.id = '.$package_id.' ORDER BY "ppkgd"."id" ;';
		$package_details =  $this->get_query($sql);
		return empty($package_details) ? array() : $package_details[0];
	}


	public function get_contact_of_lead($real_id,$type='products')
	{
		if (empty($real_id) ||  !is_numeric($real_id) || empty($type)) {
			echo json_encode(array('status' => false,'error' => 'Product id or type is not valid.'));
			die();
		}

		if (strtolower($type) == 'products') {
			
			$sql = 'SELECT p.product_name,
			  (
			    SELECT json_agg(item)
			    FROM (
			      SELECT pc.email,pc.name,pc.phone_no,pc.id
			      FROM product_contacts pc WHERE pc.real_id = p.id AND "pc"."is_deleted" = FALSE AND "pc"."is_active" = TRUE
			    ) item 
			  ) AS contacts_data
			  
			FROM products p WHERE "p"."is_deleted" = FALSE AND p.id = '.$real_id.' ;';
		}

		if (strtolower($type) == 'services') {
			
			$sql = 'SELECT s.service_name,
			  (
			    SELECT json_agg(item)
			    FROM (
			      SELECT pc.email,pc.name,pc.phone_no,pc.id
			      FROM product_contacts pc WHERE pc.real_id = s.id AND "pc"."is_deleted" = FALSE AND "pc"."is_active" = TRUE
			    ) item 
			  ) AS contacts_data
			  
			FROM services s WHERE "s"."is_deleted" = FALSE AND s.id = '.$real_id.' ;';
		}

		$contacts_data =  $this->get_query($sql);
		return empty($contacts_data) ? array() : $contacts_data[0];
	}

//Added by aayusha, 21-09-2020
	public function get_free_trial_link($product_id)
	{
		$sql = "SELECT p.free_trial_link from products p  
		WHERE   p.status = '7' AND  p.is_deleted = FALSE AND id=".$product_id;
		$sql .= "  ORDER BY display_order ASC";

		$rest = $this->db->query($sql);
		if($rest->num_rows()) 
		{
		   return $rest->result_array();
		}
		return array();
	}
	public function get_category_wise_prod(){
	    $sql_cat = "select c.name,c.cat_id,p.product_name, p.id, p.partner_id from categories c inner join products p on p.category_id::integer = c.cat_id::integer 
    WHERE  p.status = '7' AND  p.is_deleted = FALSE AND p.product_type = 'Lead' and c.is_deleted = FALSE and c.is_active = true order by c.cat_id limit 50";
	    $rest_cat = $this->db->query($sql_cat);
		//return $rest_cat->result_array();
		$cat_wise_prod =$rest_cat->result_array();
        $arr_val =array();
		foreach($cat_wise_prod as $val => $key){
           if($cat_wise_prod[$val]['name']==$key['name']){
	               $arr_val[$cat_wise_prod[$val]['name']][]=$key;
           }
        }
        //echo '<pre>';
        //print_r($arr_val);
        return $arr_val;
        	        
	}

}