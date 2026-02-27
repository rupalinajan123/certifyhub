<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
	Class Name 		: 	Downlaod
	Created By		: 	Deepak k
	Created Date 	: 	11-02-2020

*/
class Downlaod extends CI_Controller 
{
	public function __construct()
	{
        parent::__construct();
    }

    /**
	 * Create Deepak k
	 * @param       null
	 * @return      mixed|string
	 * Ref : https://www.tutorialrepublic.com/php-tutorial/php-file-download.php
	 * URL: downlaod?image_type=logo&file_name=p_1574666873.png
	 */
	public function index()
	{
		$this->session->unset_userdata(array('user_m_download_url'));
		$file_name = $this->input->get('file_name');
		$file_type = $this->input->get('file_type');
		$get_extension = explode(".", $file_name);
		$prod_name = $this->input->get('prod_name');

		if(!empty($file_name)){
		    // Get parameters
		    $file_name = urldecode($file_name); // Decode URL-encoded string
		    //die();
		    //$abs_path = $this->config->item('ABS_PATH');
		    
		    //if(preg_match('/^[^.][-a-z0-9.]+[a-z]$/i', $file_name)){
		    	$filepath = '';
		    	if (!empty($file_type)) {
		    		
		    		switch ($file_type) {
		    			case 'user_manual':
		    				$filepath = $this->config->item('USER_MANUAL_UPLOAD'). $file_name;
		    				$prod_name = $prod_name."-user-mannual.".$get_extension[1];
		    				//if (is_login() == false && $this->session->userdata('user_type') != 'client' ) {
		    				
		    				$source = !empty($this->input->get('source')) ? $this->input->get('source') : '';

		    				if ($source != 'YES' && $this->session->userdata('user_type') != 'client'){ 

		    					$keys = array('user_id','first_name','last_name','email','username','logged_in','prev_url','captcha_client','product_id','package_id','quantity','amount');
    							$this->session->unset_userdata($keys);
    							
		    					$user_manual = array(
		    						'user_m_download_url' => base_url().'downlaod?file_type=user_manual&file_name='.$file_name.'&prod_name='.$this->input->get('prod_name'),
		    						//$_SERVER['HTTP_REFERER'].'?section=usage'
								);
								
							    $this->session->set_userdata($user_manual);
							    redirect($this->config->item('PORTAL_LINK').'login');
		    				}
		    				break;
		    			case 'video':
		    				$filepath = $this->config->item('products_videos'). $file_name;
		    				$prod_name = $prod_name."-video.".$get_extension[1];
		    				
		    				break;
		    			case 'sample_report':
		    				$filepath = $this->config->item('products_sample_report'). $file_name;
		    				$prod_name = $prod_name."-datasheet.".$get_extension[1];

		    				break;
		    			case 'process_doc':
		    				$filepath = $this->config->item('products_process_doc'). $file_name;
		    				$prod_name = $prod_name."-brochure.".$get_extension[1];
		    			
		    				break;
		    			case 'case_study':
		    				$filepath = $this->config->item('CASE_STUDY_UPLOAD'). $file_name;
		    				$prod_name = $prod_name."-case-study.".$get_extension[1];
		    				break;
		    			case 'product_images':
		    				$filepath = $this->config->item('PRODUCT_IMAGE_UPLOAD'). $file_name;
		    				$prod_name = $prod_name."-product-image.".$get_extension[1];
		    				break;
		    			case 'partner_attachment':
			    				if (!is_login()) {
			    					redirect(base_url());
			    				}
		    				 $filepath = $this->config->item('PARTNER_DOCUMENT'). $file_name;
		    				 $prod_name = $prod_name."-partner-attachment.".$get_extension[1];
		    				break;
		    			case 'registration_certificate':
		    					if (!is_login()) {
			    					redirect(base_url());
			    				}
		    				 $filepath = $this->config->item('CLIENT_COVID_DOC'). $file_name;
		    				 $prod_name = $prod_name."-registration-certificate.".$get_extension[1];
		    				break;
		    			case 'Partner_Commercials':
		    				$filepath = $this->config->item('PARTNER_DOC_Commercials'). $file_name;
		    				$prod_name = $prod_name."-partner-commercials.".$get_extension[1];
		    				break;
		  
		    			default:
		    				 $filepath = $this->config->item('CASE_STUDY_UPLOAD'). $file_name;
		    				 $prod_name = $prod_name.".".$get_extension[1];
		    				break;
		    		}
		    	}
		       
		    	
		        // Process download
		        if( !empty($file_name) && filesize($filepath) >0 ) {
		            header('Content-Description: File Transfer');
		            header('Content-Type: application/octet-stream');
		            header('Content-Disposition: attachment; filename="'.basename($prod_name).'"');
		            header('Expires: 0');
		            header('Cache-Control: must-revalidate');
		            header('Pragma: public');
		            header('Content-Length: ' . filesize($filepath));
		            flush(); // Flush system output buffer
		            readfile($filepath);
		        } else {
		            http_response_code(404);
		        }
		    /*} else {
		        die("Invalid file name!");
		    }*/
		}
	}
}