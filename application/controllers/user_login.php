<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class user_login extends CI_Controller {
 
	function __construct(){
		parent::__construct();
		$this->load->model('Users_model');
 
        //get all users
        $this->data['users'] = $this->Users_model->getAllUsers();
	}
 
	public function index(){
        $this->load->view('login', $this->data);
	}

	public function register(){
        $this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('email', 'Email', 'valid_email|required');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[7]|max_length[30]');
        $this->form_validation->set_rules('password_confirm', 'Confirm Password', 'required|matches[password]');
 
        if ($this->form_validation->run() == FALSE) { 
         	$this->load->view('register', $this->data);
		}
		else{
			//get user inputs
            $username = $this->input->post('username');
			$email = $this->input->post('email');
			$password = $this->input->post('password');
 
			//generate simple random code
			$set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$code = substr(str_shuffle($set), 0, 12);
 
			//insert user to users table and get id
            $user['username'] = $username;
			$user['email'] = $email;
			$user['password'] = $password;
			$user['code'] = $code;
			$user['active'] = false;
			$id = $this->Users_model->insert($user);
 
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
                
                // Add cc or bcc 
                // $mail->addcc('cc@example.com');
                // $mail->addbcc('bcc@example.com');
                
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
                        redirect('User/register');
                }else{
					$this->session->set_flashdata('success', 'User added Successfully');
					redirect('User/login');
                }
		}
 
	}
 
	public function activate(){
		$id =  $this->uri->segment(3);
		$code = $this->uri->segment(4);
 
		//fetch user details
		$user = $this->Users_model->getUser($id);
 
		//if code matches
		if($user['code'] == $code){
			//update user active status
			$data['active'] = true;
			$query = $this->Users_model->activate($data, $id);
 
			if($query){
				$this->session->set_flashdata('message', 'User activated successfully');
			}
			else{
				$this->session->set_flashdata('message', 'Something went wrong in activating account');
			}
		}
		else{
			$this->session->set_flashdata('message', 'Cannot activate account. Code didnt match');
		}
 
		redirect('register');
 
	}

}
?>