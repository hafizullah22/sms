<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('logged_in')) {

        redirect('/');
    }
    }

    /*
    |--------------------------------------------------------------------------
    | Student List
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $data['title'] = 'Student List';

        $data['students'] = $this->db->get('students')->result();

        $this->load->view('students/list', $data);
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
        $this->load->view('students/add', $data);
    }


    /*
    |--------------------------------------------------------------------------
    | Save Student
    |--------------------------------------------------------------------------
    */
public function store()
{
    // =========================
    // Upload Configuration
    // =========================
    $config['upload_path']   = FCPATH . 'images/teachers/';
    $config['allowed_types'] = 'jpg|jpeg|png|webp';
    $config['max_size']      = 2048;
    $config['encrypt_name']  = TRUE;

    // Load Upload Library
    $this->load->library('upload');
    $this->upload->initialize($config);

    $image_path = '';

    // =========================
    // Check Image Upload
    // =========================
    if (!empty($_FILES['photo']['name'])) {

        if ($this->upload->do_upload('photo')) {

            $upload_data = $this->upload->data();

            // Save relative path in DB
            $image_path = 'images/teachers/' . $upload_data['file_name'];

        } else {

            // Upload Error
            $this->session->set_flashdata('msg_type', 'error');
            $this->session->set_flashdata('msg_title', 'Upload Failed!');
            $this->session->set_flashdata('msg_text', strip_tags($this->upload->display_errors()));

            redirect('student/create');
            return;
        }
    }

    // =========================
    // Insert Data
    // =========================
    $insert_data = [

        'full_name'        => $this->input->post('full_name'),
        'roll_no'          => $this->input->post('roll_no'),
        'registration_no'  => $this->input->post('registration_no'),
        'gender'           => $this->input->post('gender'),
        'date_of_birth'    => $this->input->post('date_of_birth'),
        // 'blood_group'      => $this->input->post('blood_group'),
        // 'religion'         => $this->input->post('religion'),

        'class_id'         => $this->input->post('class_id'),
        // 'section'          => $this->input->post('section'),
        'year'             => $this->input->post('year'),

        'present_address'  => $this->input->post('present_address'),

        'photo'            => $image_path,
    ];

    $this->db->insert('students', $insert_data);

    // =========================
    // Success / Failed Message
    // =========================
    if ($this->db->affected_rows() > 0) {

        $this->session->set_flashdata('msg_type', 'success');
        $this->session->set_flashdata('msg_title', 'Success!');
        $this->session->set_flashdata('msg_text', 'Student Added Successfully');

    } else {

        $this->session->set_flashdata('msg_type', 'error');
        $this->session->set_flashdata('msg_title', 'Failed!');
        $this->session->set_flashdata('msg_text', 'Failed to Add Student');
    }

    redirect('student/create');
}


    /*
    |--------------------------------------------------------------------------
    | Edit Student
    |--------------------------------------------------------------------------
    */
    public function edit($id)
    {

        $data['title'] = 'Edit Student';

        $data['student'] = $this->Student_model->get_student($id);

        $this->load->view('admin/student/edit', $data);
    }


    /*
    |--------------------------------------------------------------------------
    | Update Student
    |--------------------------------------------------------------------------
    */
    public function update($id)
    {

        $update_data = [

            'student_name'     => $this->input->post('student_name'),
            'roll_no'          => $this->input->post('roll_no'),
            'registration_no'  => $this->input->post('registration_no'),
            'gender'           => $this->input->post('gender'),
            'date_of_birth'    => $this->input->post('date_of_birth'),
            'blood_group'      => $this->input->post('blood_group'),
            'religion'         => $this->input->post('religion'),

            'class_id'         => $this->input->post('class_id'),
            'section'          => $this->input->post('section'),
            'session_year'     => $this->input->post('session_year'),

            'mobile'           => $this->input->post('mobile'),
            'guardian_name'    => $this->input->post('guardian_name'),
            'guardian_mobile'  => $this->input->post('guardian_mobile'),
            'address'          => $this->input->post('address'),

            'updated_at'       => date('Y-m-d H:i:s')

        ];

        $this->Student_model->update_student($id, $update_data);

        

        $this->session->set_flashdata('success', 'Student Updated Successfully');

        redirect('student');
    }

public function view($id)
{
    $data['student'] = $this->db
        ->get_where('students', ['id' => $id])
        ->row();

    if ($data['student']) {

        $this->load->view('students/view_partial', $data);

    } else {

        $this->output->set_status_header(404);
        echo "Student not found.";
    }
}



public function id_cards($class_id, $session_year)
{
    

    // Fetch Students
    $students = $this->db
        ->where('class_id', $class_id)
        ->where('year', $session_year)
        ->get('students')
        ->result();

    if (empty($students)) {
        show_error('No students found for this class and session.');
    }

    $data = [
        'students'     => $students,
        'class_id'     => $class_id,
        'session_year' => $session_year
    ];

   
    // 2. PDF GENERATION ENGINE (mPDF)
    $this->load->library('pdf');

    // Initialize mPDF in Landscape orientation ('L') for wide tabulation sheets
    $mpdf = $this->pdf->load('A4', 'P');

    // Set Header
    // $mpdf->SetHTMLHeader($this->pdf->header());

    // 3. Generate HTML and Output
    $html = $this->load->view('students/id_cards', $data, true);
    $mpdf->WriteHTML($html);
    $mpdf->Output();

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