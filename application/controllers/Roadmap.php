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
                    $mail = $this->phpmailer_lib->load();
                    $mail->isSMTP();
                    $mail->Host     = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'parkerrosan001@gmail.com';
                    $mail->Password = 'pArkEr001@';
                    $mail->SMTPSecure = 'tls';
                    $mail->Port     = 587;
                    $mail->setfrom('parkerrosan001@gmail.com', 'Parker');
                    $mail->addreplyto('parkerrosan001@gmail.com', 'Parker');
                    
                    // Add a recipient
                    $mail->addaddress('parkerrosan001@gmail.com');

                     // Email subject
                    $mail->Subject = 'Send Email using PHPMailer in CodeIgniter 3';
                    
                    // Set email format to HTML
                    $mail->isHTML(true);
                    
                    // Email body content
                    $mailContent = "<h1>Send HTML Email using SMTP in CodeIgniter</h1>
                        <p>Hello hope you are doing well I am Parker Rosan Php web Developer. This is a test email sending using SMTP mail server using PHPMailer.</p>";
                    $mail->Body = $mailContent;
                    
                    // Send email
                    if(!$mail->send()){
                        $this->session->set_flashdata('error', 'Something went wrong.Please try again later.'.$mail->ErrorInf);
                        redirect('Roadmap/fetch_event');
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