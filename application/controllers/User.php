<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class User extends CI_Controller {
 
	function __construct(){
		parent::__construct();
		$this->load->model('Users_model');
 
        //get all users
        $this->data['users'] = $this->Users_model->getAllUsers();
	}
 
	public function index(){
        $this->load->view('login', $this->data);
	}

	public function get_allusers(){
		if (!$this->session->userdata('user'))  {
            redirect('User/index');
        }else{
			$data['allusers'] = $this->Users_model->getAllUsers();
			$this->load->view('viewusers', $data);
        }

		
	}
 
	public function register(){
        $this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('email', 'Email', 'valid_email|required');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[7]|max_length[30]');
        $this->form_validation->set_rules('password_confirm', 'Confirm Password', 'required|matches[password]');
 
        if ($this->form_validation->run() == FALSE) { 
			$this->session->set_flashdata('error', 'Invalid Credentials');
			redirect('User/get_allusers');
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
                    
			$config = array(
				'protocol' => 'smtp',
				'smtp_host' => 'smtp.hostinger.com', //'smtp.hostinger.com',
				'smtp_port' => '587',	//587,
				'smtp_user' => 'shahzad@appvelo.com',	//'shahzad@appvelo.com', // change it to yours
				'smtp_pass' => 'abcABC123!@#',	//'abcABC123!@#', // change it to yours
				'mailtype' => 'html',
				'charset' => 'iso-8859-1',
				'wordwrap' => TRUE
			);

			$this->load->library('email',$config);
			$this->email->set_newline("\r\n");
			$this->email->initialize($config);
			$this->email->from('shahzad@appvelo.com');
			$this->email->to($email);
			// Email subject
			$this->email->subject('Send Email using PHPMailer in CodeIgniter 3');
			$this->email->message('Send HTML Email using SMTP in CodeIgniter');
			
			
			// Send email
			if(!$this->email->send()){
				
				echo $this->email->print_debugger();

			}else{
				$this->session->set_flashdata('success', 'Please check your Email .');
				redirect('user_login/register');
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

    public function login(){

		$email = $_POST['email'];
		$password = $_POST['password'];

		$data = $this->Users_model->login($email, $password);
 
		if($data){
			$this->session->set_userdata('user', $data);
			$this->session->set_flashdata('success','Login Successfully');
			redirect('User/dashboard');
		}
		else{
			
			$this->session->set_flashdata('error','Invalid login. User not found');
			redirect('User/index');
		} 
	}
 
	public function dashboard(){
		if (!$this->session->userdata('user'))  {
            redirect('User/index');
        }else{
			//restrict users to go to home if not logged in
			$this->session->get_userdata('user');
			$user_data['user_data'] = $this->Users_model->getAllUsers();
			$this->load->view('dashboard',$user_data);
        }
 
	}

	public function logout(){
		//load session library
		
		$this->session->unset_userdata('user');
		redirect('/');
	}

	public function update_user_profile(){
		//restrict users to go to home if not logged in
		if (!$this->session->userdata('user'))  {
            redirect('User/index');
        }else{
			
			$user_id = $_POST['user_id'];
			$result = $this->Users_model->getUser_profile($user_id);
			
			$data = array(
				'username'=> $result['username'],
				'email'=> $result['email'],
				'password' => $result['password']
				);		
			echo json_encode($data);
        }
		
	}

	public function up_insert(){
		$user_id=$this->input->post('user_id');
		$up_name=$this->input->post('up_name');
		$up_email=$this->input->post('up_email');
		$up_password=$this->input->post('up_password');
		$data = array(
			'username'=> $up_name,
			'email'=> $up_email,
			'password' => $up_password
		);
  
			$this->Users_model->update_insert($data, $user_id);
			
	}
	
	public function delete_user_profile($user_id){
		if($user_id){
			$this->Users_model->delete_profile($user_id);
			redirect('user/get_allusers');
		}
	}

}
?>