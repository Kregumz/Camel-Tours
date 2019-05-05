<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auto_Slideshow_Settings extends CI_Controller
{
    public function index($tour_id = -1, $node_id = -1, $form_data = array(), $error = null)
    {
        // Boot the user if they are not logged in.
        $this->check_session();
        // Verify that the specified tour ID is valid.
        $this->verify_tour($tour_id);
        // Verify that the specified node ID is valid.
        $this->verify_node($tour_id, $node_id);
        // Get the name of the page from the class.
        $data['title'] = get_class($this);
        $page = strtolower($data['title']);
        // Make sure that the view for this page exists!
        if (!file_exists(APPPATH . '/views/cms/' . $page . '.php'))
            show_404();
        // Get existing files.
        list($result, $img_index) = $this->get_existing_files($node_id);
        // Set additional data parameters.
        $data['form_data'] = $form_data;
        $data['error'] = $error;
        $data['user_id'] = $this->session->userdata('user_id');
        $data['tour_id'] = $tour_id;
        $data['node_id'] = $node_id;
        $data['existing_files'] = $result;
        // Load our templates and the view for this page.
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navigation', $data);
        $this->load->view('cms/' . $page, $data);
        $this->load->view('templates/footer', $data);

    }
    public function send_form($tour_id=-1, $node_id=-1) {

        $string = "";
        $i=0;
        $curMin = 0; //time in seconds of the minutes entry

        //the sequence number of audio files is 0 and the first image is 1, so the first timestamp
        //is stored with the second image
        //the timestamp for the first image will just be set  to 0 in the javascript file
        $curSlide = 2;
        $this->db->where('node_id', $node_id);
        $this->db->where('seq_num', $curSlide);


        foreach ($this->input->post() as $post){
            $this->db->where('node_id', $node_id);
            $this->db->where('seq_num', $curSlide);
            if ($i%2==0){
                $curMin=$post*60;

            }
            else {
                //when the entry is in seconds, get the total time by adding the remaining
                //seconds to the minutes in seconds
                $curTime= $curMin + $post;
                $this->db->update('slides', array('timestamp' => $curTime));
                $curSlide++;
            }

            $i++;

        }

        $this->index($tour_id, $node_id, array(), 'Changes Saved Successfully!');

    }

    //insert function to compress images and audio files TO DO
    private function check_session() {
        if (!$this->session->userdata('validated'))
            redirect('login');
    }
    private function verify_tour($tour_id) {
        $this->db->where('user_id', $this->session->userdata('user_id'));
        $this->db->where('tour_id', $tour_id);
        if (!$this->db->get('tours')->num_rows() == 1)
            redirect('cms/home');
    }
    private function verify_node($tour_id, $node_id) {
        $this->db->where('tour_id', $tour_id);
        $this->db->where('node_id', $node_id);
        if (!$this->db->get('nodes')->num_rows() == 1)
            redirect('cms/home');
    }

    private function get_existing_files($node_id) {
        $result = array();
        $img_index = 1;
        $this->db->where('node_id', $node_id);
        $query = $this->db->get('slides');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $key => $row) {
                $obj['name'] = $row->media_name;
                $obj['size'] = $row->media_size;
                $obj['thmb'] = $row->thumb_uri;
                $obj['seqn'] = $row->seq_num;
                $result[] = $obj;
                if (pathinfo($obj['name'], PATHINFO_EXTENSION) != "mp3")
                    $img_index++;
            }
            // Sort the result by sequence number.
            if (!function_exists('seqSort')){
                function seqSort($a, $b) { return $a['seqn'] - $b['seqn']; } //define the function if it has not been defined
            }
            usort($result, 'seqSort'); //without the if statement, this will not work on the second upload
        }
        return array($result, $img_index);
    }
}
?>
