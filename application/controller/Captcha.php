<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Captcha extends CI_Controller
{
    function __construct() {
        parent::__construct();
        
        // Load the captcha helper
        $this->load->helper('captcha');
    }
    
    public function index(){
        // If captcha form is submitted
        if($this->input->post('submit')){
            $inputCaptcha = $this->input->post('captcha');
            $sessCaptcha = $this->session->userdata('captchaCode');
            if($inputCaptcha === $sessCaptcha){
                echo 'Captcha code matched.';
            }else{
                echo 'Captcha code does not match, please try again.';
            }
        }
        
        // Pass captcha image to view
        $data['captchaImg'] =get_captcha();
        
        // Load the view
        $this->load->view('captcha/index', $data);
    }
    
    public function refresh(){
        // Captcha configuration
        echo get_captcha();
    }
}