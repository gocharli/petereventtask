<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fullcalendar_model extends CI_Model
{
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
    public function fetch_all_event(){
        $query = $this->db->get('calendar_plugin');
            return $query->result();
    }

    public function insert_event($data)
    {
    $this->db->insert('calendar_plugin', $data);
    }

    public function update_event($data, $id)
    {
    $this->db->where('fw_id', $id);
    $this->db->update('calendar_plugin', $data);
    }

    public function delete_event($id)
    {
    $this->db->where('fw_id', $id);
    $this->db->delete('calendar_plugin');
    }

    public function update_insert($data, $id)
    {
    $this->db->where('fw_id', $id);
    $this->db->update('calendar_plugin', $data);
    }

}

?> 