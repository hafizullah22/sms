<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Classes extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('logged_in')) {

        redirect('/');
    }
    }

    public function index()
    {
        $data['classes'] = $this->db->get('classes')->result();

        $this->load->view('classes/list', $data);
    }

} //End of Controller