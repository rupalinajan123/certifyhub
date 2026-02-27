<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
	Class Name 		: 	show_image
	Created By		: 	Deepak k
	Created Date 	: 	10-02-2020

*/
class Show_image extends CI_Controller 
{
	public function __construct()
	{
        parent::__construct();

    }
    /**
	 * Create Deepak k
	 * @param       null
	 * @return      mixed|string
	 */
	public function index()
	{

		$image_name = $this->input->get('image_name');
		
		$image_type = $this->input->get('image_type');

		if($image_name!="")
		{
			if (preg_match('/^[\w\-. ]+$/', $image_name)):

			$allowed 	=  array('jpeg','jpg', "png", "gif", "bmp", "JPEG","JPG", "PNG", "GIF", "BMP");
			$ext 		= pathinfo($image_name, PATHINFO_EXTENSION);
			if(in_array($ext,$allowed) ) {
			
				switch ($image_type) {
					case 'logo':
							if(file_exists("assets/front/images/".$image_name))
								$filename = "assets/front/images/".$image_name;
						break;

					case 'category_logo':
							if(file_exists($this->config->item('CATEGORY_LOGO_UPLOAD').$image_name)){
								$filename = $this->config->item('CATEGORY_LOGO_UPLOAD').$image_name;
							}else{
								$filename = $this->config->item('CATEGORY_LOGO_UPLOAD').'industry-manufacturing.png';
							}
						break;
						
					case 'category_slider':
							if(file_exists($this->config->item('category_slider').$image_name)){
								$filename = $this->config->item('category_slider').$image_name;
							}else{
								$filename = 'assets/front/images/default.png';
							}
						break;
						
					case 'leadership_team':
							if(file_exists($this->config->item('leadership_team').$image_name)){
								$filename = $this->config->item('leadership_team').$image_name;
							}else{
								$filename = 'assets/front/images/default.png';
							}
						break;

					case 'product_display_logo':
							if(file_exists($this->config->item('product_display_logo').$image_name)){
								$filename = $this->config->item('product_display_logo').$image_name;
							}else{
								$filename = 'assets/front/images/default.png';
							}
						break;
						

					case 'product_logo':
							if(file_exists($this->config->item('LOGO_UPLOAD').$image_name)){
								$filename = $this->config->item('LOGO_UPLOAD').$image_name;
							}else{
								$filename = 'assets/front/images/default.png';
							}
						break;
					case 'cover_image':
						if(file_exists($this->config->item('COVER_UPLOAD').$image_name)){
							$filename = $this->config->item('COVER_UPLOAD').$image_name;
						}else{
							$filename = 'assets/front/images/default.png';
						}
					break;		
					case 'product_images':
							if(file_exists($this->config->item('PRODUCT_IMAGE_UPLOAD').$image_name)){
								$filename = $this->config->item('PRODUCT_IMAGE_UPLOAD').$image_name;
							}else{
								$filename = 'assets/front/images/default.png';
							}
						break;
					
					default:
						$filename = "";
						break;
				}

				if($filename!='' && file_exists($filename))
				{
					$imginfo = getimagesize($filename);
					header("Content-type:".$imginfo['mime']);
					readfile($filename);
					die();
				}else{
					die('File not found!');
				}
			}else{
				die('File name not valid!');
			}

			else:
				die('File name not valid!');
			endif;
		}

	}

}