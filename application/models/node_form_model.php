<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

  class Node_Form_Model extends CI_Model
  {
    public function get_data() {
      // Get the user input.
        if($this->input->post('auto_slide_status') == "true")
            $auto_slide_status = 1; //because it's stored in the database as an integer
        else
            $auto_slide_status = 0;
       $form_data = array(
        'tour_id' => $this->input->post('tour_id'),
        'node_name' => $this->input->post('node_name'),
        'node_location' => $this->input->post('node_location'),
        'node_lat' => $this->input->post('node_lat'),
        'node_long' => $this->input->post('node_long'),
        'auto_slide_status' => $auto_slide_status //added this
       );
       // Check whether we are missing any required parameters.
       $form_data['complete'] = $form_data['node_name']!='' and $form_data['node_location']!='';
       // Return the form data.
       return $form_data;
    }
  }
?>