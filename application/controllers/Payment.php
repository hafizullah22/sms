<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Controller {

      public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('logged_in')) {

        redirect('/');
    }
    }

    public function create() {
        $data['classes'] = $this->db->order_by('class_numeric', 'ASC')->get('classes')->result();
        $data['students'] = $this->db->order_by('roll_no', 'ASC')->get('students')->result();
        $this->load->view('payment/create', $data);
    }

public function store()
{
    $class_id     = $this->input->post('class_id', true);
    $amount       = $this->input->post('amount', true);
    $month        = $this->input->post('month', true);
    $year         = $this->input->post('year', true);
    $payment_type = $this->input->post('payment_type', true);

    // Validation
    if (!$class_id || !$amount || !$month || !$year || !$payment_type) {
        return $this->_flash('error', 'Validation Error', 'All fields are required.', 'payment/create');
    }

    // Get active students
    $students = $this->db->where(['class_id' => $class_id,'status'   => 1])->get('students')->result();

    if (!$students) {
        return $this->_flash('error', 'No Students', 'No students found in selected class.', 'payment/create');
    }

    // Existing payments (single query)
    $existingIds = array_column(
    $this->db->select('student_id')->where([
        'class_id'     => $class_id,
                'month'        => $month,
                'year'         => $year,
                'payment_type' => $payment_type
            ])
            ->get('payment')
            ->result_array(),
        'student_id'
    );

    $insertData = [];
    $inserted = 0;
    $skipped  = 0;

    foreach ($students as $student) {

        if (in_array($student->id, $existingIds)) {
            $skipped++;
            continue;
        }

        $insertData[] = [
            'class_id'     => $class_id,
            'student_id'   => $student->id,
            'payment_type' => $payment_type,
            'amount'       => $amount,
            'paid_amount'  => 0,
            'due_amount'   => $amount,
            'status'       => 'unpaid',
            'month'        => $month,
            'year'         => $year
        ];

        $inserted++;
    }

    if ($insertData) {
        $this->db->insert_batch('payment', $insertData);
    }

    $paymentLabel = ($payment_type == 1) ? 'Tuition Fee' : 'Exam Fee';

    // Message builder
    if ($inserted > 0 && $skipped == 0) {

        return $this->_flash(
            'success',
            'Success!',
            "{$paymentLabel} Generated Successfully For {$inserted} students of the Class:{$class_id }, Month:{$month}",
            'payment/create'
        );

    } elseif ($inserted > 0 && $skipped > 0) {

        return $this->_flash(
            'error',
            'Partially Processed!',
            "Already Set payment of {$class_id }, Month:{$month}. {$inserted} created, {$skipped} skipped.",
            'payment/create'
        );

    }

    return $this->_flash(
        'error',
        'Duplicate Entry!',
         "{$paymentLabel} Not Generated For  The Class:{$class_id }, Month:{$month}",
        'payment/create'
    );
}

/**
 * Helper function (recommended)
 */
private function _flash($type, $title, $text, $redirect)
{
    $this->session->set_flashdata('msg_type', $type);
    $this->session->set_flashdata('msg_title', $title);
    $this->session->set_flashdata('msg_text', $text);

    return redirect($redirect);
}

public function payment_search()
{

    $this->load->view('payment/search');
}

public function payment_collection($student_id=null)
{
   

    $student_id = $this->input->get('student_id');

    // Get student info (important for UI)
    $data['student'] = $this->db
        ->where('id', $student_id)
        ->get('students')
        ->row();

    // Payment history
    $data['payment'] = $this->db
        ->where('student_id', $student_id)
        ->order_by('month', 'ASC')
        ->get('payment')
        ->result();

    $this->load->view('payment/collection', $data);
}

public function payment_update()
{
    $payment_id = $this->input->post('payment_id');
    $amount_paid = $this->input->post('paid_amount');

    // Get payment record
    $payment = $this->db
        ->where('id', $payment_id)
        ->get('payment')
        ->row();

    if (!$payment) {
        echo json_encode(['status' => 'error', 'message' => 'Payment record not found.']);
        return;
    }

    // Calculate new paid and due amounts
    $new_paid_amount = $payment->paid_amount + $amount_paid;
    $new_due_amount  = $payment->due_amount - $amount_paid;

    // Determine new status
    if ($new_due_amount <= 0) {
        $status = 'paid';
        $new_due_amount = 0; // No negative dues
    } elseif ($new_paid_amount > 0) {
        $status = 'partial';
    } else {
        $status = 'unpaid';
    }

    // Update payment record
    $this->db
        ->where('id', $payment_id)
        ->update('payment', [
            'paid_amount' => $new_paid_amount,
            'due_amount'  => $new_due_amount,
            'status'      => $status,
            'pay_date'    => date('Y-m-d H:i:s')
        ]);

    $this->session->set_flashdata('msg_type', 'success');
    $this->session->set_flashdata('msg_title', 'Success');
    $this->session->set_flashdata('msg_text', 'Paid');


    redirect('payment/payment_collection?student_id=' . $payment->student_id);
}


public function receipt($student_id)
{
    // Student info
    $student = $this->db
        ->where('id', $student_id)
        ->get('students')
        ->row();

    if (!$student) {
        show_error("Student not found.");
    }

    // All payments of student
    $payments = $this->db
        ->where('student_id', $student_id)
        ->where_in('status',['paid','partial'])
        ->order_by('month', 'ASC')
        ->get('payment')
        ->result();

    // Total paid amount
    $total_paid = $this->db
        ->select_sum('paid_amount')
        ->where('student_id', $student_id)
        ->get('payment')
        ->row()
        ->paid_amount;

    $data = [
        'student_name' => $student->full_name,
        'class_name'   => $student->class_id,
        'roll_no'      => $student->roll_no,
        'session_year' => $student->session_year,
        'payments'     => $payments,
        'total_paid'   => $total_paid
    ];

    // PDF
       $this->load->library('pdf');
    $mpdf = $this->pdf->load('A4', 'P');
    $mpdf->SetHTMLHeader($this->pdf->header());

    $mpdf->SetTitle('Payment Statement - ' . $student->full_name);

    $html = $this->load->view('payment/receipt', $data, true);

    if (ob_get_length()) {
        ob_end_clean();
    }

    $mpdf->WriteHTML($html);
    $mpdf->Output('Payment_Statement_' . $student->full_name . '.pdf', 'I');
}

public function test()
{
    $pass = "admin@2026#";
    echo password_hash($pass,true);
}
}