<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Roadmap_model extends CI_Model
{
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
    public function fetch_all_event(){
        $this->db->order_by('start_event');
        $query = $this->db->get('tbl_events');
            return $query->result();
    }
    public function sendmail_event($event_id){
        $query = $this->db->get_where('tbl_events',array('event_id'=>$event_id));
        
		return $query->row_array();
       
    }

}

?>