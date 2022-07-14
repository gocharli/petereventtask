<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Fullcalendar_model extends CI_Model
{
    function __construct(){
		parent::__construct();
		$this->load->database();
	}

    function fetch_all_event(){
    // $this->db->order_by('id');
    // return $this->db->get('tbl_events');
        $query = $this->db->get('tbl_events');
		return $query->result();
    }

    function insert_event($data)
    {
    $this->db->insert('tbl_events', $data);
    }

    function update_event($data, $id)
    {
        $this->db->where('tbl_events.id', $id);
		return $this->db->update('tbl_events', $data);
    }

    function delete_event($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('tbl_events');
    }
}

?>