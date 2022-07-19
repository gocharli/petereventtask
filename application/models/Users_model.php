<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Users_model extends CI_Model {
 
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
 
	public function getAllUsers(){
		$this->db->order_by('user_id');
		$query = $this->db->get('users');
		return $query->result(); 
	}
 
	public function insert($user){
		$this->db->insert('users', $user);
		$sql_result = $this->db->insert_id();
		if($sql_result){ 
		$this->session->set_flashdata('success', 'User added Successfully');
					redirect('User/get_allusers');
		}else{
			$this->session->set_flashdata('error', 'Oops ! User not added');
					redirect('User/get_allusers');
		}
	}
 
	public function getUser($id){
		$query = $this->db->get_where('users',array('user_id'=>$id));
		return $query->row_array();
	}
	public function getUser_profile($user_id){
		$query = $this->db->get_where('users',array('user_id'=>$user_id));
		return $query->row_array();
	}
	public function activate($data, $id){
		$this->db->where('users.user_id', $id);
		return $this->db->update('users', $data);
	}

	public function login($email, $password){
		$query = $this->db->get_where('users', array('email'=>$email, 'password'=>$password));
			return $query->row_array();
	}
	public function update_profile($data,$user_id){
		$this->db->where('user_id', $user_id);
    	$this->db->update('users', $data);
	}
	public function update_insert($data, $user_id){
		$this->db->where('user_id', $user_id);
		$sql_query = $this->db->update('users', $data);
		if($sql_query){
			$this->session->set_flashdata('success', 'Updated successfully');
			redirect('user/get_allusers');
		}
		else{
			$this->session->set_flashdata('error', 'Somthing went worng Data not updated!!');
			redirect('user/get_allusers');
		}
	}
	public function delete_profile($user_id)
    {
		$this->db->where('user_id', $user_id);
		$sql_query = $this->db->delete('users');
		if($sql_query){
			$this->session->set_flashdata('success', 'Record delete successfully');
			redirect('user/get_allusers');
		}
		else{
			$this->session->set_flashdata('error', 'Somthing went worng. Error!!');
			redirect('user/get_allusers');
		}
    }
 
}