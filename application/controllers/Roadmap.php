<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Roadmap extends CI_Controller{
    
    public function __construct(){
        parent::__construct();
        $this->load->model('Roadmap_model');
    }

    public function index(){    
        $data['event_data'] = $this->Roadmap_model->fetch_all_event();
        $this->load->view('roadmap',$data);
    }
    public function fetch_event(){    
        $data['event_data'] = $this->Roadmap_model->fetch_all_event();
        $this->load->view('viewevents',$data);
    }
    public function sendmail($event_id){ 
        $data = $this->Roadmap_model->sendmail_event($event_id);
        if(isset($data)){
            $usermail = explode(",", $data['user_email']);
            foreach($usermail as $fetch_mail) {
                $fetch_mail = trim($fetch_mail); 
                if(!empty($fetch_mail)){

                    //set up email and SMTP configuration
                    
                    $config = array(
                        'protocol' => 'smtp',
                        'smtp_host' => 'smtp.hostinger.com', //'smtp.hostinger.com',
                        'smtp_port' => '465',	//587,
                        'smtp_user' => 'shahzad@appvelo.com',	//'shahzad@appvelo.com', // change it to yours
                        'smtp_pass' => 'abcABC123!@#',	//'abcABC123!@#', // change it to yours
                        'mailtype' => 'html',
                        'charset' => 'iso-8859-1',
                        'wordwrap' => TRUE
                    );

                    $this->load->library('email',$config);
                    $this->email->initialize($config);
                    $this->email->from('shahzad@appvelo.com');
                    $this->email->to($fetch_mail);
                    // Email subject
                    $this->email->subject('Send Email using PHPMailer in CodeIgniter 3');
                    $this->email->message('Send HTML Email using SMTP in CodeIgniter');
                    
                    
                    // Send email
                    if(!$this->email->send()){
                        
                        echo $this->email->print_debugger();

                    }else{
                        $this->session->set_flashdata('success', 'Please check your Email .');
                        redirect('Roadmap/fetch_event');
                    }
                    
                }
            }
        }
        
    }
   
}

?>