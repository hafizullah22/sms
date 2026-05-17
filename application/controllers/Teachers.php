<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teachers extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('logged_in')) {

        redirect('/');
    }
    }


    public function index()
    {
        $data['title'] = 'Teacher List';

        $data['teachers'] = $this->db->get('teachers')->result();

        $this->load->view('teachers/list', $data);
    }


    public function create()
{
    $this->load->view('teachers/add');
}

public function store()
{
    // Upload Configuration
    $config['upload_path']   = './images/teachers/';
    $config['allowed_types'] = 'jpg|jpeg|png|webp';
    $config['max_size']      = 2048;
    $config['encrypt_name']  = TRUE;

    $this->load->library('upload', $config);

    $image_path = '';

    // Check if image uploaded
    if (!empty($_FILES['image']['name'])) {

        if ($this->upload->do_upload('image')) {

            $upload_data = $this->upload->data();
            $image_path  = 'images/teachers/' . $upload_data['file_name'];

        } else {

            $this->session->set_flashdata('msg_type', 'error');
            $this->session->set_flashdata('msg_title', 'Upload Failed!');
            $this->session->set_flashdata('msg_text', $this->upload->display_errors());

            redirect('teachers/create');
        }
    }

    // Insert Data
    $insert_data = [

        'teacher_name' => $this->input->post('teacher_name', true),
        'designation'  => $this->input->post('designation', true),
        'salary'       => $this->input->post('salary', true),
        'joining_date' => $this->input->post('joining_date', true),
        'image'        => $image_path,

    ];

    // Insert into teachers table
    $this->db->insert('teachers', $insert_data);

    if ($this->db->affected_rows() > 0) {

        $this->session->set_flashdata('msg_type', 'success');
        $this->session->set_flashdata('msg_title', 'Success!');
        $this->session->set_flashdata('msg_text', 'Teacher Added Successfully');

    } else {

        $this->session->set_flashdata('msg_type', 'error');
        $this->session->set_flashdata('msg_title', 'Failed!');
        $this->session->set_flashdata('msg_text', 'Failed to Add Teacher');

    }

    redirect('teachers/create');
}

public function edit($id)
{
    // Get Teacher Data
    $data['teacher'] = $this->db
        ->where('id', $id)
        ->get('teachers')
        ->row();

    // Check Data Exists
    if (!$data['teacher']) {

        $this->session->set_flashdata('msg_type', 'error');
        $this->session->set_flashdata('msg_title', 'Not Found!');
        $this->session->set_flashdata('msg_text', 'Teacher Not Found');

        redirect('teachers');
        return;
    }

    // Load Edit View
    $this->load->view('teachers/edit', $data);
}

public function update($id)
{
    // Get Existing Teacher
    $teacher = $this->db
        ->where('id', $id)
        ->get('teachers')
        ->row();

    // Check Teacher Exists
    if (!$teacher) {

        $this->session->set_flashdata('msg_type', 'error');
        $this->session->set_flashdata('msg_title', 'Not Found!');
        $this->session->set_flashdata('msg_text', 'Teacher Not Found');

        redirect('teachers');
        return;
    }

    // Default Old Image
    $image = $teacher->image;

    // Upload Config
    $config['upload_path']   = FCPATH . 'images/teachers/';
    $config['allowed_types'] = 'jpg|jpeg|png|webp';
    $config['max_size']      = 2048;
    $config['encrypt_name']  = TRUE;

    $this->load->library('upload', $config);

    // Check New Image Upload
    if (!empty($_FILES['image']['name'])) {

        if ($this->upload->do_upload('image')) {

            // Delete Old Image
            if (!empty($teacher->image) && file_exists(FCPATH . $teacher->image)) {
                unlink(FCPATH . $teacher->image);
            }

            // New Upload Data
            $upload_data = $this->upload->data();

            $image = 'images/teachers/' . $upload_data['file_name'];

        } else {

            $this->session->set_flashdata('msg_type', 'error');
            $this->session->set_flashdata('msg_title', 'Upload Failed!');
            $this->session->set_flashdata('msg_text', strip_tags($this->upload->display_errors()));

            redirect('teachers/edit/' . $id);
            return;
        }
    }

    // Update Data
    $data = [

        'teacher_name' => $this->input->post('teacher_name', true),
        'designation'  => $this->input->post('designation', true),
        'salary'       => $this->input->post('salary', true),
        'joining_date' => $this->input->post('joining_date', true),
        'image'        => $image,

    ];

    // Update Database
    $this->db->where('id', $id);
    $update = $this->db->update('teachers', $data);

    if ($update) {

        $this->session->set_flashdata('msg_type', 'success');
        $this->session->set_flashdata('msg_title', 'Success!');
        $this->session->set_flashdata('msg_text', 'Teacher Updated Successfully');

    } else {

        $this->session->set_flashdata('msg_type', 'error');
        $this->session->set_flashdata('msg_title', 'Failed!');
        $this->session->set_flashdata('msg_text', 'Failed to Update Teacher');

    }

    redirect('teachers');
}



} //End of Controller 