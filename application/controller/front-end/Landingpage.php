<?php
defined('BASEPATH') or exit('No direct script access allowed');
/*
Class Name         :     Landingpage
Created By        :     Roshni N
 */
class Landingpage extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('Front_Products_model', 'Front_service_model'));
        $this->load->model('Email_model');
    }

    /**
     * Created by Roshni N
     * @param       null
     * @return        mixed|string
     * Home page
     */
    public function index()
    {
        $this->load->view('front/landing_pages/endpointbck', $data);
    }

	// Diwali Offers VTM Scan 
	// SEO urls : website-vulnerability-scanner

	public function vulnerability_scanner()
    {
        $this->load->view('front/landing_pages/vulnerability_scanner');
    }

	public function vapt()
    {
        $this->load->view('front/landing_pages/vapt');
    }

	public function dms()
    {
        $this->load->view('front/landing_pages/dms');
    }

	public function hybrid_email_solution()
    {
        $this->load->view('front/landing_pages/hybrid_email_solution');
    }


    public function landing_pages_save()
    {
		$productName = $this->input->post('product_name');
		$product_name = (!empty($productName)) ? ucwords($productName) : 'SPOCHUB Endpoint Backup Solution';
		$contact = $this->input->post('contact') ? trim($this->input->post('contact')) : '';
		$company = $this->input->post('company') ? trim($this->input->post('company')) : '';
		$website = $this->input->post('website') ? trim($this->input->post('website')) : '';

		// echo $product_name;exit;

		// $product_name = 'SPOCHUB Endpoint Backup Solution';

        $this->form_validation->set_rules('email', 'email', 'trim|required');
        if ($this->form_validation->run() == false) {
            $message = array('status' => false, 'message' => validation_errors());
        } else {
            $insert = array(
                'email'			=> trim(strtolower($this->input->post('email'))),
                'name'			=> ucwords($this->input->post('name')),
                'contact'		=> $contact,
                'website'		=> $website,
                'company'		=> $company,
                'product_name'	=> $product_name,
                'about_project'	=> $this->input->post('comments'),
                'createdAt'		=> current_date(),
            );
            $result = $this->db->insert('products_lp', $insert);
            $insert_id = $this->db->insert_id();
			// print_r($send_mail_to_user);exit;

            if ($insert_id) {
                $message = array('status' => true, 'message' => 'Thank you for connecting us, Will get back to you soon');
				// Send mail to admin
				$adminEmails = array(
					array('email' => 'getintouch@spochub.com', 'full_name' => 'Get In Touch'),
					// array('email' => 'chinmay.sanghavi@esds.co.in', 'full_name' => 'Chinmay Sanghavi'),
					// array('email' => 'matin.shaikh@esds.co.in', 'full_name' => 'Matin Shaikh'),
					// array('email' => 'shubham.raut@esds.co.in', 'full_name' => 'Shubham Raut'),
					// array('email' => 'raj.gire@esds.co.in', 'full_name' => 'Raj Gire'),
					// array('email' => 'ajinkya.dhongade@esds.co.in', 'full_name' => 'Ajinkya Dhongade'),
					// array('email' => 'akash.wagh09@gmail.com', 'full_name' => 'Akash Wagh'),
				);

				$admin_mail_data = [];
				$admin_mail_data					=	$insert;
				$admin_mail_data['admin_mail']		=	$adminEmails;
				$admin_mail_data['diwali_offer']	=	$this->input->post('diwali_offer') ? 1 : 0;
				$admin_mail_data['LeadOREnquiry']	=	'Lead';
				$admin_mail_send = $this->send_mail_to('admin', $admin_mail_data);
				// exit;

				// Send mail to user
				$user_mail_data = [];
				$user_mail_data = $insert;
				$user_mail_data['LeadOREnquiry']	=	'Lead';
				$user_mail_send = $this->send_mail_to('user', $user_mail_data);
            } else {
                $message = array('status' => false, 'message' => 'Please try in again');
            }
        }
        echo json_encode($message);die();
    }

	public function send_mail_to($send_mail_to, $data){
		// Load email model 
		$this->load->model('email_model');
		if($send_mail_to == 'admin'){
			if($data['diwali_offer'] == 1){
				$arr = array(
					'body' => array(
						"{LeadOREnquiry}"	=> $data['LeadOREnquiry'],
						"{PRODUCT_NAME}"	=> $data['product_name'],
						"{CLIENT_NAME}"		=> $data['name'],
						"{CLIENT_EMAIL}"	=> $data['email'],
						"{CLIENT_WEBSITE}"	=> $data['website'],
					),
					'subject' => array("{PRODUCT_NAME}" => $data['product_name'], "{LeadOREnquiry}" => $data['LeadOREnquiry']),
				);
				$mailtitle = 'free_trial_diwali_lead';
			}
			else
			{
				$arr = array(
					'body' => array(
						"{LeadOREnquiry}"	=> $data['LeadOREnquiry'],
						"{PRODUCT_NAME}"	=> $data['product_name'],
						"{CLIENT_NAME}"		=> $data['name'],
						"{CLIENT_EMAIL}"	=> $data['email'],
						"{COMPANY_NAME}"	=> $data['company'],
						"{CLIENT_PHONE}"	=> $data['contact'],
					),
					'subject' => array("{PRODUCT_NAME}" => $data['product_name'], "{LeadOREnquiry}" => $data['LeadOREnquiry']),
				);
				$mailtitle = 'free_trial_lead';
			}

			$send_mail_email = $data['admin_mail'];
			$mail_body = get_email_body($mailtitle, $arr);


			$mail_subject = 'SPOCHUB - Lead Enquiry for the Endpoint Backup Solution';

			$sub_arr = array('Vulnerability Assessment And Penetration Testing', 'Cloud Document Management System Software','Hybrid Email Solution');
			if(in_array($data['product_name'], $sub_arr)){
				$mail_subject = 'SPOCHUB - '.$data['product_name'];
			}
			
			$this->email_model->send_mail($mail_subject, $mail_body['body'], $send_mail_email, $mail_body['from_mail'], 'SPOCHUB', '', 1);
			return true;
			// print_r($mail_body);exit;
		} else if($send_mail_to == 'user'){
			$arr = array(
				'body' => array(
					"{FULL_NAME}" => $data['name'],
				),
				'subject' => array("{PRODUCT_NAME}" => $data['product_name'], "{LeadOREnquiry}" => $data['LeadOREnquiry']),
			);
			$send_mail_email = $data['email'];
			$mail_body = get_email_body('client_endpoint_backup_solution', $arr);
			$this->email_model->send_mail('Thank You for Contacting SPOCHUB', $mail_body['body'], $send_mail_email, $mail_body['from_mail'], 'SPOCHUB', '', 1);
			return true;
			// print_r($mail_body);exit;
		}
	}

	public function download_files(){
		// print_r($_GET);exit;
		if(isset($_GET['path']))
		{
			//Read the filename
			$filename = $_SERVER['DOCUMENT_ROOT'].'/assets/landing-page/files/'.$_GET['path'];
			// echo $filename;exit;
			//Check the file exists or not
			if(file_exists($filename)) {
				// echo $_GET['path'];exit;

				//Define header information
				header('Content-Description: File Transfer');
				header('Content-Type: application/octet-stream');
				header("Cache-Control: no-cache, must-revalidate");
				header("Expires: 0");
				header('Content-Disposition: attachment; filename="'.basename($filename).'"');
				header('Content-Length: ' . filesize($filename));
				header('Pragma: public');

				//Clear system output buffer
				flush();

				//Read the size of the file
				readfile($filename);

				//Terminate from the script
				die();
			} else {
				echo "File does not exist.";
			}
		} else
		echo "Filename is not defined.";
	}
}
