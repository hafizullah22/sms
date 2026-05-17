<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Result extends CI_Controller {

     public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('logged_in')) {

        redirect('/');
    }
    }
    // Initial page load
    public function create() {
        $data['classes'] = $this->db->order_by('class_numeric', 'ASC')->get('classes')->result();
        $this->load->view('result/create', $data);
    }

    // AJAX: Fetch Students and Subjects for the selected class
    public function get_data() {
        $class_id = $this->input->post('class_id');

        $students = $this->db->where('class_id', $class_id)
                             ->order_by('roll_no', 'ASC')
                             ->get('students')->result();

        $subjects = $this->db->where('class_id', $class_id)
                             ->get('subjects')->result();

        echo json_encode([
            'students' => $students,
            'subjects' => $subjects
        ]);
    }

    // AJAX: Get existing marks when a subject is selected
    public function get_existing_marks() {
        $class_id   = $this->input->post('class_id');
        $subject_id = $this->input->post('subject_id');

        $results = $this->db->where([
            'class_id'   => $class_id,
            'subject_id' => $subject_id
        ])->get('results')->result();

        $marks_map = [];
        foreach($results as $row) {
            $marks_map[$row->student_id] = $row->marks;
        }

        echo json_encode($marks_map);
    }

    // AJAX: Batch Save Marks (The "Save Button" Logic)
    public function store_batch() {
        $class_id    = $this->input->post('class_id');
        $subject_id  = $this->input->post('subject_id');
        $student_ids = $this->input->post('student_id');
        $marks       = $this->input->post('marks');

        if(empty($subject_id) || empty($student_ids)) {
            echo json_encode(['status' => 'error', 'message' => 'Please select a subject and enter marks.']);
            return;
        }

        $insert_data = [];
        $update_data = [];

        foreach($student_ids as $key => $sid) {
            $mark_value = $marks[$key];
            
            // Skip empty inputs if you don't want to save 0/null
            if($mark_value === '') continue;

            $entry = [
                'class_id'   => $class_id,
                'subject_id' => $subject_id,
                'student_id' => $sid,
                'marks'      => $mark_value
            ];

            // Check if record exists to separate Insert vs Update
            $exists = $this->db->get_where('results', [
                'subject_id' => $subject_id, 
                'student_id' => $sid
            ])->row();

            if($exists) {
                $entry['id'] = $exists->id;
                $update_data[] = $entry;
            } else {
                $insert_data[] = $entry;
            }
        }

        $this->db->trans_start();
        if(!empty($insert_data)) $this->db->insert_batch('results', $insert_data);
        if(!empty($update_data)) $this->db->update_batch('results', $update_data, 'id');
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            echo json_encode(['status' => 'error', 'message' => 'Database error. Marks not saved.']);
        } else {
            echo json_encode(['status' => 'success', 'message' => 'All marks saved successfully!']);
        }
    }



    // LOAD THE REPORT VIEW
public function report()
{
    $data['classes'] = $this->db->order_by('class_numeric', 'ASC')->get('classes')->result();
    $this->load->view('result/report', $data);
}

// AJAX: FETCH TABULATED RESULTS
public function get_report_data()
{
    $class_id = $this->input->post('class_id');

    // 1. Get all subjects for this class (Columns)
    $subjects = $this->db->where('class_id', $class_id)->get('subjects')->result();

    // 2. Get all students (Rows)
    $students = $this->db->where('class_id', $class_id)->order_by('roll_no', 'ASC')->get('students')->result();

    // 3. Get all marks for this class
    $marks = $this->db->where('class_id', $class_id)->get('results')->result();

    // Organize marks into a 2D array [student_id][subject_id] = marks
    $marks_array = [];
    foreach ($marks as $m) {
        $marks_array[$m->student_id][$m->subject_id] = $m->marks;
    }

    echo json_encode([
        'subjects' => $subjects,
        'students' => $students,
        'marks'    => $marks_array
    ]);
}

public function generate_pdf($class_id = NULL)
{
    if (!$class_id) {
        show_404();
    }

    // DATA
    $data['class'] = $this->db->get_where('classes', ['id' => $class_id])->row();

    $data['subjects'] = $this->db
        ->get_where('subjects', ['class_id' => $class_id])
        ->result();

    $data['students'] = $this->db
        ->where('class_id', $class_id)
        ->order_by('roll_no', 'ASC')
        ->get('students')
        ->result();

    $marks_raw = $this->db
        ->get_where('results', ['class_id' => $class_id])
        ->result();

    $data['marks'] = [];
    foreach ($marks_raw as $m) {
        $data['marks'][$m->student_id][$m->subject_id] = $m->marks;
    }

    
    // OPTIONAL: HEADER (if using library)
    $this->load->library('mpdf'); // your custom library
     $mpdf = $this->mpdf->mpdf('A4', 'L');
    $mpdf->SetHTMLHeader($this->mpdf->header());

    // TITLE
    $mpdf->SetTitle("Mark Sheet - " . $data['class']->class_name);

    // BUFFER CLEAN (IMPORTANT)
    if (ob_get_length()) {
        ob_end_clean();
    }

    // HTML VIEW
    $html = $this->load->view('result/pdf_template', $data, true);

    $mpdf->WriteHTML($html);

    // OUTPUT
    $filename = 'Marksheet_' . str_replace(' ', '_', $data['class']->class_name) . '.pdf';
    $mpdf->Output($filename, 'I');
}
public function testimonial($id)
{
    // Fetch Data
    $student = $this->db->get_where('students', ['id' => $id])->row();
    $school = $this->db->get('school_info')->row();

    if (!$student) {
        show_404();
    }

    $this->load->library('mpdf');
    // Initialize mPDF (Unicode enabled)
    $mpdf = $this->mpdf->mpdf('A4', 'P');

    $mpdf->SetHTMLHeader($this->mpdf->header());
    
    $html = $this->load->view('result/testimonial', ['student' => $student, 'school' => $school], true);

    $mpdf->WriteHTML($html);

    if (ob_get_length()) {
        ob_end_clean();
    }

    $mpdf->Output('Testimonial_'.$student->full_name.'.pdf', 'I');
}

}


