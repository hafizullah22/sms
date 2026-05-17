<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {



     public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('logged_in')) {

        redirect('/');
    }
    }

    public function index() {
        $data['title'] = 'Settings';
        $data['school_info'] = $this->db->get('school_info')->row();
        $this->load->view('settings/index', $data);
    }

    public function create() {
        $data['title'] = 'Settings';
        $this->load->view('settings/add', $data);
    }

    public function edit() {
        $data['title'] = 'Settings';
        $data['school_info'] = $this->db->get('school_info')->row();
        $this->load->view('settings/edit', $data);
    }


   public function update()
{
    $logo_path = null;

    // =========================
    // IMAGE UPLOAD (LOGO)
    // =========================
    if (!empty($_FILES['logo']['name'])) {

        $config['upload_path']   = './images/';
        $config['allowed_types'] = 'jpg|jpeg|png|webp';
        $config['max_size']      = 2048;
        $config['encrypt_name']  = TRUE;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('logo')) {

            $this->session->set_flashdata('msg_type', 'error');
            $this->session->set_flashdata('msg_title', 'Upload Failed!');
            $this->session->set_flashdata('msg_text', $this->upload->display_errors());

            redirect('settings');
            return;
        }

        $upload_data = $this->upload->data();
        $logo_path = 'images/' . $upload_data['file_name'];
    }

    // =========================
    // DATA ARRAY
    // =========================
    $school_info = [
        'school_name_en'      => $this->input->post('school_name_en', true),
        'school_name_bn'      => $this->input->post('school_name_bn', true),
        'address'             => $this->input->post('address', true),
        'eiin_number'         => $this->input->post('eiin_number', true),
        'phone'               => $this->input->post('phone', true),
        'establishment_year'  => $this->input->post('establishment_year', true),
    ];

    // only update logo if uploaded
    if ($logo_path) {
        $school_info['logo'] = $logo_path;
    }

    // =========================
    // UPDATE DB
    // =========================
    // $this->db->where('id', 1)->update('school_info', $school_info);

    $this->db->where('id', 1);
        $this->db->update('school_info', $school_info);

    // =========================
    // FLASH MESSAGE
    // =========================
    if ($this->db->affected_rows() > 0) {

        $this->session->set_flashdata('msg_type', 'success');
        $this->session->set_flashdata('msg_title', 'Success!');
        $this->session->set_flashdata('msg_text', 'School information updated successfully');

    } else {

        $this->session->set_flashdata('msg_type', 'info');
        $this->session->set_flashdata('msg_title', 'No Change!');
        $this->session->set_flashdata('msg_text', 'No data was modified');

    }

    redirect('settings');
}


}
