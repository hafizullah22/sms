<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subject extends CI_Controller {
  public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('logged_in')) {

        redirect('/');
    }
    }
    /*
    |--------------------------------------------------------------------------
    | Subject List
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $data['title'] = 'Subject List';

        $data['subjects'] = $this->db->get('subjects')->result();

        $this->load->view('subjects/list', $data);
    }


    /*
    |--------------------------------------------------------------------------
    | Add Student Form
    |--------------------------------------------------------------------------
    */
    public function create()
    {
        $data['title'] = 'Add Student';

        $data['classes'] = $this->db->get('classes')->result();
        $this->load->view('subjects/add', $data);
    }


    /*
    |--------------------------------------------------------------------------
    | Save Student
    |--------------------------------------------------------------------------
    */
    public function store()
    {

        $insert_data = [

            'class_id'     => $this->input->post('class_id'),
            'year'         => $this->input->post('year'),
            'subject_name'          => $this->input->post('subject_name'),
            'subject_type'  => $this->input->post('subject_type'),
            'total_marks'           => $this->input->post('total_marks'),
            'pass_marks'    => $this->input->post('pass_marks'),
           

            // 'created_at'       => date('Y-m-d H:i:s')

        ];


        $this->db->insert('subjects', $insert_data);

        if ($this->db->affected_rows() > 0) {

            $this->session->set_flashdata('msg_type', 'success');
            $this->session->set_flashdata('msg_title', 'Success!');
            $this->session->set_flashdata('msg_text', 'Subject Added Successfully');

        } else {

            $this->session->set_flashdata('msg_type', 'error');
            $this->session->set_flashdata('msg_title', 'Failed!');
            $this->session->set_flashdata('msg_text', 'Failed to Add Student');

        }

redirect('subject/create');

}





    /*
    |--------------------------------------------------------------------------
    | Edit Student
    |--------------------------------------------------------------------------
    */
    public function edit($id)
    {

        $data['title'] = 'Edit Subject';

        $data['subject'] = $this->db->get_where('subjects', ['id' => $id])->row();

        $this->load->view('subjects/edit', $data);
    }


    /*
    |--------------------------------------------------------------------------
    | Update Subject
    |--------------------------------------------------------------------------
    */
    public function update($id)
    {

        $update_data = [

            'subject_name'     => $this->input->post('subject_name'),
            'class_id'         => $this->input->post('class_id'),
            'year'             => $this->input->post('year'),
            'subject_type'     => $this->input->post('subject_type'),
            'total_marks'      => $this->input->post('total_marks'),
            'pass_marks'       => $this->input->post('pass_marks'),
           
            // 'updated_at'       => date('Y-m-d H:i:s')

        ];

        $this->db->where('id', $id);
        $this->db->update('subjects', $update_data);

        if ($this->db->affected_rows() > 0) {

    $this->session->set_flashdata('msg_type', 'success');
    $this->session->set_flashdata('msg_title', 'Success!');
    $this->session->set_flashdata('msg_text', 'Subject Updated Successfully');

} else {

    $this->session->set_flashdata('msg_type', 'error');
    $this->session->set_flashdata('msg_title', 'Failed!');
    $this->session->set_flashdata('msg_text', 'Failed to Update Subject');

}

        redirect('subject');
    }


    /*
    |--------------------------------------------------------------------------
    | Delete Student
    |--------------------------------------------------------------------------
    */
    public function delete($id)
    {

        $this->Student_model->delete_student($id);

        $this->session->set_flashdata('success', 'Student Deleted Successfully');

        redirect('student');
    }

}