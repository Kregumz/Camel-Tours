<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

  class Home extends CI_Controller
  {
    public function index() {
      // Get the name of the page from the class.
      $data['title'] = get_class($this);
      $page = strtolower($data['title']);
      // Make sure that the view for this page exists!
      if (!file_exists(APPPATH.'/views/'.$page.'.php'))
        show_404();
      // Load our templates and the view for this page.
      $this->load->view('templates/home_header', $data); //header
      $this->load->view('templates/navigation', $data);  //navbar
      $this->load->view($page, $data); //body
      $this->load->view('templates/footer', $data); //footer
    }
  }

?>