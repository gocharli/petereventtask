<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fullcalendar_model extends CI_Model
{
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
    public function fetch_all_event(){
        $query = $this->db->get('tbl_events');
            return $query->result();
    }

    public function insert_event($data)
    {
    $this->db->insert('tbl_events', $data);
    }

    public function update_event($data, $id)
    {
    $this->db->where('event_id', $id);
    $this->db->update('tbl_events', $data);
    }

    public function delete_event($id)
    {
    $this->db->where('event_id', $id);
    $this->db->delete('tbl_events');
    }

    public function update_insert($data, $id)
    {
    $this->db->where('event_id', $id);
    $this->db->update('tbl_events', $data);
    }

}

?>