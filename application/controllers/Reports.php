<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {

     public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('logged_in')) {

        redirect('/');
    }
    }


public function index()
{
    $data['classes'] = $this->db->order_by('class_numeric', 'ASC')->get('classes')->result();
    $this->load->view('reports/index',$data);
}

public function Report($class_id = NULL, $year = NULL, $report_type = NULL)
{
    // Fallback: If parameters aren't passed via URL segments, check for GET/POST parameters
    if ($class_id === NULL) $class_id = $this->input->get_post('class_id');
    if ($year === NULL)     $year     = $this->input->get_post('year');
    if ($report_type === NULL) $report_type = $this->input->get_post('report_type');

    // Guard Clause: Ensure all parameters exist
    if (empty($class_id) || empty($year) || empty($report_type)) {
        show_error('Class ID, Year, and Report Type are required parameters.', 400, 'Missing Parameters');
    }

    // 1. DATA RETRIEVAL
    $data['class'] = $this->db->get_where('classes', ['id' => $class_id])->row();
    $data['year']  = $year;

    if (!$data['class']) {
        show_404('Selected class profile record not found.');
    }

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

    // Check if any students exist before initializing rendering engines
    if (empty($data['students'])) {
        show_error('No student registrations found for the selected Class and Year.', 404, 'No Records Found');
    }

    // 2. DYNAMIC REPORT CONFIGURATION
    $view_template = '';
    $orientation   = 'P'; // Default Portrait ('P')
    $title_prefix  = 'Report';

    switch ($report_type) {
        case '101': // Admit Card
            $view_template = 'reports/admitcard_template';
            $orientation   = 'P';
            $title_prefix  = 'AdmitCards';
            break;
            
        case '102': // Attendance Sheet
            $view_template = 'reports/attendance_template';
            $orientation   = 'L'; // 'L' for Landscape to accommodate table columns
            $title_prefix  = 'AttendanceSheet';
            break;
            
        case '103': // Seat Sticker
            $view_template = 'reports/seat_sticker_template';
            $orientation   = 'P';
            $title_prefix  = 'SeatStickers';
            break;
            
        default:
            show_error('Invalid Report Type configuration requested.', 400, 'Bad Request');
    }

    // 3. MPDF INITIALIZATION & RENDERING
    $this->load->library('pdf');

    // Initialize mPDF dynamically with computed configuration parameters
    $mpdf = $this->pdf->load('A4', $orientation);
    
    // Set Header
    if (method_exists($this->pdf, 'header')) {
        $mpdf->SetHTMLHeader($this->pdf->header());
    }

    // Set Dynamic Title 
    $clean_class_name = str_replace(' ', '_', $data['class']->class_name);
    $mpdf->SetTitle($title_prefix . "_" . $clean_class_name . "_" . $year);

    // BUFFER CLEAN (Prevents compression stream corruption from trailing whitespaces)
    if (ob_get_length()) {
        ob_end_clean();
    }

    // Load Dynamic View Template
    $html = $this->load->view($view_template, $data, true);
    $mpdf->WriteHTML($html);

    // 4. OUTPUT DOWNLOAD STREAM
    $filename = $title_prefix . '_' . $clean_class_name . '_' . $year . '.pdf';
    $mpdf->Output($filename, 'I'); 
}

} //end Controller