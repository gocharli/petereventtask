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
        'id' => $row->event_id,
        'title' => $row->event_title,
        'start' => $row->start_event,
        'end' => $row->end_event
      );
    }
    
    echo json_encode($data);
  }
  public function insert(){
    $startdate=$this->input->post('start');
    $reminderdate=date('Y-m-d', strtotime($startdate. ' - 1 day')) ; // change according to your reminder time 1 day or more
   
    $enddate=$this->input->post('end');

    $data = array(
      'event_title'  => $this->input->post('title'),
      'start_event'=> $startdate.' '.$this->input->post('timestart'),
      'end_event' => $enddate.' '.$this->input->post('timeend'),
      // 'user_email' => $this->input->post('email'),
      'user_email' => implode(',', $this->input->post('user[]')),
      'event_tags' => implode(',', $this->input->post('tags[]')),
      'event_description' => $this->input->post('event_desc'),
      'reminder_date' => $reminderdate
    );

    $res=$this->Fullcalendar_model->insert_event($data);
    
  }
  public function insert_day(){
    $startdate=$this->input->post('start');
    $reminderdate=date('Y-m-d', strtotime($startdate. ' - 1 day')) ; // change according to your reminder time 1 day or more
    if($this->input->post('title')){
        $data = array(
          'event_title'  => $this->input->post('title'),
          'start_event'=>$this->input->post('start'),
          'end_event' => $this->input->post('end'),
          'user_email' => implode(',', $this->input->post('user[]')),
          'event_tags' => implode(',', $this->input->post('tags[]')),
          'event_description' => $this->input->post('event_desc'),
          'reminder_date' => $reminderdate
      );
        $res=$this->Fullcalendar_model->insert_event($data);
      echo json_encode($res);
    }

  }
  public function update(){
      $data = array(
        'event_title'  => $this->input->post('title'),
        'start_event'=> $this->input->post('start'),
        'end_event' => $this->input->post('end')
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
    $a=$this->db->from('tbl_events')->where('event_id',$this->input->post('id'))->get()->row();
    // print_r($a);die();
    $start=$a->start_event;
    $end=$a->end_event;

    $start_date=date('Y-m-d', strtotime( $start ) );
    $start_time=date('H:i', strtotime( $start ) );
    $end_date=date('Y-m-d', strtotime( $end ) );
    $end_time=date('H:i', strtotime( $end ) );
    $data = array(
      'event_title'  => $a->event_title,
      'event_id'  => $a->event_id,
      'start_date'=> $start_date,
      'start_time' => $start_time,
      'end_date' => $end_date,
      'end_time' => $end_time
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
          'event_title'=> $this->input->post('up_title'),
            'start_event'=> $start,
            'end_event' => $end
          );

          $this->Fullcalendar_model->update_insert($data, $this->input->post('up_id'));
          echo json_encode(' ');
    }
  }

}

?>