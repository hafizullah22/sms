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
    $class_id      = $this->input->post('class_id');
    $amount        = $this->input->post('amount');
    $month         = $this->input->post('month');
    $year          = $this->input->post('year');
    $payment_type  = $this->input->post('payment_type');

    // Validation
    if (
        empty($class_id) ||
        empty($amount) ||
        empty($month) ||
        empty($year) ||
        empty($payment_type)
    ) {

        $this->session->set_flashdata(
            'error',
            'All fields are required.'
        );

        redirect('payment/create');
    }

    // Get all students from selected class
    $students = $this->db
        ->where('class_id', $class_id)
        ->where('status', 1)
        ->get('students')
        ->result();

    // No students found
    if (empty($students)) {

        $this->session->set_flashdata(
            'error',
            'No students found in selected class.'
        );

        redirect('payment/create');
    }

    $inserted = 0;
    $skipped  = 0;

    foreach ($students as $student) {

        // Check duplicate fee generation
        $exists = $this->db
            ->where([
                'student_id'   => $student->id,
                'class_id'     => $class_id,
                'month'        => $month,
                'year'         => $year,
                'payment_type' => $payment_type
            ])
            ->get('payment')
            ->row();

        // Skip duplicate
        if ($exists) {
            $skipped++;
            continue;
        }

        // Insert fee record
        $this->db->insert('payment', [

            'class_id'      => $class_id,

            'student_id'    => $student->id,

            'payment_type'  => $payment_type,

            'amount'        => $amount,

            'paid_amount'   => 0,

            'due_amount'    => $amount,

            'status'        => 'unpaid',

            'month'         => $month,

            'year'          => $year,

            // 'created_at'    => date('Y-m-d H:i:s')
        ]);

        $inserted++;
    }

    // Success message
    $this->session->set_flashdata(
        'success',
        $inserted . ' fee records generated successfully. '
        . $skipped . ' skipped (already exists).'
    );

    redirect('payment/create');
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
        ->order_by('id', 'DESC')
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

    //echo json_encode(['status' => 'success', 'message' => 'Payment updated successfully!']);

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
        ->order_by('id', 'DESC')
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


}