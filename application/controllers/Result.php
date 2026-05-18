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

  // AJAX: Fetch Students and Subjects filtering by BOTH Class and Year
    public function get_data() {
        $class_id = $this->input->post('class_id');
        $year     = $this->input->post('year'); // <-- Captured Year

        // Get students matching class and year
        $students = $this->db->where([
                                'class_id' => $class_id,
                                'year'     => $year // <-- Added Year Match
                             ])
                             ->order_by('roll_no', 'ASC')
                             ->get('students')->result();

        // Get subjects matching class and year
        $subjects = $this->db->where([
                                'class_id' => $class_id,
                                'year'     => $year // <-- Added Year Match
                             ])
                             ->get('subjects')->result();

        echo json_encode([
            'students' => $students,
            'subjects' => $subjects
        ]);
    }

    // AJAX: Get existing marks matching Class, Subject, and Year
    public function get_existing_marks() {
        $class_id   = $this->input->post('class_id');
        $subject_id = $this->input->post('subject_id');
        $year       = $this->input->post('year'); 

        $results = $this->db->where([
            'class_id'   => $class_id,
            'subject_id' => $subject_id,
            'year'       => $year
        ])->get('results')->result();

        $marks_map = [];
        foreach($results as $row) {
            $marks_map[$row->student_id] = $row->marks;
        }

        echo json_encode($marks_map);
    }

 // AJAX: Batch Save Marks
    public function store_batch() {
        $class_id    = $this->input->post('class_id');
        $subject_id  = $this->input->post('subject_id');
        $year        = $this->input->post('year'); 
        $student_ids = $this->input->post('student_id');
        $marks       = $this->input->post('marks');
        $entry_by    = $this->session->userdata('username'); // Cleaned up variable alignment
        $status      = 1;

        if(empty($subject_id) || empty($year) || empty($student_ids)) {
            echo json_encode(['status' => 'error', 'message' => 'Missing fields. Marks not saved.']);
            return;
        }

        $insert_data = [];
        $update_data = [];

        foreach($student_ids as $key => $sid) {
            $mark_value = $marks[$key];
            if($mark_value === '') continue;

            $entry = [
                'class_id'   => $class_id,
                'subject_id' => $subject_id,
                'year'       => $year,
                'student_id' => $sid,
                'marks'      => $mark_value,
                'entry_by'   => $entry_by,
                'status'     => $status
            ];

            // Check uniqueness combining subject, student, and year
            $exists = $this->db->get_where('results', [
                'subject_id' => $subject_id, 
                'student_id' => $sid,
                'year'       => $year
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
            echo json_encode(['status' => 'error', 'message' => 'Database error.']);
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

    // AJAX: FETCH TABULATED RESULTS (Optimized by Year)
    public function get_report_data()
    {
        $class_id = $this->input->post('class_id');
        $year     = $this->input->post('year'); // <-- Captured year from AJAX

        // Validate inputs to prevent database query errors
        if (empty($class_id) || empty($year)) {
            echo json_encode([
                'subjects' => [],
                'students' => [],
                'marks'    => []
            ]);
            return;
        }

        // 1. Get all subjects for this class and year (Columns)
        $subjects = $this->db->where([
            'class_id' => $class_id,
            'year'     => $year // <-- Added year filter
        ])->get('subjects')->result();

        // 2. Get all students for this class and year (Rows)
        $students = $this->db->where([
            'class_id' => $class_id,
            'year'     => $year // <-- Added year filter
        ])->order_by('roll_no', 'ASC')->get('students')->result();

        // 3. Get all marks for this class and year
        $marks = $this->db->where([
            'class_id' => $class_id,
            'year'     => $year // <-- Added year filter
        ])->get('results')->result();

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

public function generate_pdf($class_id = NULL, $year = NULL)
{
    // Ensure both parameters are present, otherwise drop a 404
    if (!$class_id || !$year) {
        show_404();
    }

    // 1. DATA QUERIES (Scoped by Class AND Year)
    $data['class'] = $this->db->get_where('classes', ['id' => $class_id])->row();
    $data['year']  = $year; // Pass year to the template if you want to display it (e.g., "Academic Year: 2026")

    // Get subjects matching class and year
    $data['subjects'] = $this->db
        ->get_where('subjects', ['class_id' => $class_id, 'year' => $year])
        ->result();

    // Get students matching class and year
    $data['students'] = $this->db
        ->where(['class_id' => $class_id, 'year' => $year])
        ->order_by('roll_no', 'ASC')
        ->get('students')
        ->result();

    // Get results matching class and year
    $marks_raw = $this->db
        ->get_where('results', ['class_id' => $class_id, 'year' => $year])
        ->result();

    // Rebuild the 2D marks matrix
    $data['marks'] = [];
    foreach ($marks_raw as $m) {
        $data['marks'][$m->student_id][$m->subject_id] = $m->marks;
    }

    // 2. PDF GENERATION ENGINE (mPDF)
    $this->load->library('pdf');

    // Initialize mPDF in Landscape orientation ('L') for wide tabulation sheets
    $mpdf = $this->pdf->load('A4', 'L');

    // Set Header
    $mpdf->SetHTMLHeader($this->pdf->header());

    // TITLE (Updated to include the year)
    $mpdf->SetTitle("Mark Sheet - " . $data['class']->class_name . " (" . $year . ")");

    // BUFFER CLEAN (Prevents corrupt PDF output caused by accidental whitespace echo)
    if (ob_get_length()) {
        ob_end_clean();
    }

    // HTML VIEW
    $html = $this->load->view('result/pdf_template', $data, true);

    $mpdf->WriteHTML($html);

    // OUTPUT
    // Example Filename: Marksheet_Class_One_2026.pdf
    $clean_class_name = str_replace(' ', '_', $data['class']->class_name);
    $filename = 'Marksheet_' . $clean_class_name . '_' . $year . '.pdf';
    
    $mpdf->Output($filename, 'I'); // 'I' opens it directly in the browser tab
}


public function testimonial($id)
{
    // Fetch Student
    $student = $this->db
        ->get_where('students', ['id' => $id])
        ->row();

    // Fetch School Info
    $school = $this->db
        ->get('school_info')
        ->row();

    // Student not found
    if (!$student) {
        show_404();
    }

    // Load PDF Library
    $this->load->library('pdf');

    // Initialize mPDF
    $mpdf = $this->pdf->load('A4', 'P');

    // Set Header
    $mpdf->SetHTMLHeader($this->pdf->header());

    // Load HTML View
    $html = $this->load->view(
        'result/testimonial',
        [
            'student' => $student,
            'school'  => $school
        ],
        true
    );

    // Write HTML to PDF
    $mpdf->WriteHTML($html);

    // Clean Output Buffer
    if (ob_get_length()) {
        ob_end_clean();
    }

    // Generate File Name
    $filename = 'Testimonial_' . $student->full_name . '.pdf';

    // Output PDF
    $mpdf->Output($filename, 'I');
}

}


