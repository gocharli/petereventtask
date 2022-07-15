<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calendar extends CI_Controller{
  public function __construct(){
   parent::__construct();
   $this->load->model('Fullcalendar_model');
  }

  public function index(){
      return $this->load->view('calendarview');
  }
  public function load(){
    $event_data = $this->Fullcalendar_model->fetch_all_event();
    foreach($event_data as $row){
      $data[] = array(
        'id' => $row->fw_id,
        'title' => $row->fw_title,
        'start' => $row->fw_start_event,
        'end' => $row->fw_end_event
        // 'tags' => $row->event_tags
      );
    }
    
    echo json_encode($data);
  }
  public function insert(){
    $startdate=$this->input->post('start');
    $enddate=$this->input->post('end');
    $data = array(
      'fw_title'  => $this->input->post('title'),
      'fw_start_event'=> $startdate.' '.$this->input->post('timestart'),
      'fw_end_event' => $enddate.' '.$this->input->post('timeend'),
      'user_email' => $this->input->post('email'),
      'event_tags' => $this->input->post('tags')
    );

    $res=$this->Fullcalendar_model->insert_event($data);
    
  }
  public function insert_day(){
    if($this->input->post('title')){
        $data = array(
          'fw_title'  => $this->input->post('title'),
          'fw_start_event'=>$this->input->post('start'),
          'fw_end_event' => $this->input->post('end'),
          'user_email' => $this->input->post('email'),
          'event_tags' => $this->input->post('tags')
      );
        $res=$this->Fullcalendar_model->insert_event($data);
      echo json_encode($res);
    }

  }
  public function update(){
      $data = array(
        'fw_title'  => $this->input->post('title'),
        'fw_start_event'=> $this->input->post('start'),
        'fw_end_event' => $this->input->post('end')
      );

      $res=$this->Fullcalendar_model->update_event($data, $this->input->post('id'));
      echo json_encode($res);   
  }
  public function delete(){
    if($this->input->post('id')){
    $this->Fullcalendar_model->delete_event($this->input->post('id'));
    }
  }
  public function get_cal_data(){
    $a=$this->db->from('calendar_plugin')->where('fw_id',$this->input->post('id'))->get()->row();
    // print_r($a);die();
    $start=$a->fw_start_event;
    $end=$a->fw_end_event;

    $start_date=date('Y-m-d', strtotime( $start ) );
    $start_time=date('H:i', strtotime( $start ) );
    $end_date=date('Y-m-d', strtotime( $end ) );
    $end_time=date('H:i', strtotime( $end ) );
    $data = array(
      'fw_title'  => $a->fw_title,
      'fw_id'  => $a->fw_id,
      'fw_start_date'=> $start_date,
      'fw_start_time' => $start_time,
      'fw_end_date' => $end_date,
      'fw_end_time' => $end_time
    ); 
    echo json_encode ($data);
  }
  public function up_insert(){
      $start_date=$this->input->post('up_start');
      $end_date=$this->input->post('up_end');
      $start_time=$this->input->post('up_timestart');
      $end_time=$this->input->post('up_timeend');
      for($i = strtotime($start_date); $i <= strtotime($end_date); $i += (86400)){

          $date=date('Y-m-d', $i);
          $start=$date.' '.$start_time.':00';
          $end=$date.' '.$end_time.':00';

          $data = array(
          'fw_title'=> $this->input->post('up_title'),
            'fw_start_event'=> $start,
            'fw_end_event' => $end
          );

          $this->Fullcalendar_model->update_insert($data, $this->input->post('up_id'));
          echo json_encode(' ');
    }
  }

}

?>

