<?php
//This file extracts and sends the timestamps from the database

  class Auto_Slideshow_Ajax extends CI_Controller{
      public function get_timestamps(){
          $node_id = $this->input->get('node_id'); //get node_id when it is called from Slideshow2.js

        $timestamps = [];
        $this->db->where('node_id', $node_id);
        $query = $this->db->get('slides');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                if ($row->seq_num >= 2){ //because timestamps are saved stating with the second slide
                    $timestamps[$row->seq_num -2] = $row->timestamp;
                }

            }

        }
        echo json_encode($timestamps);



      }

  }




?>
