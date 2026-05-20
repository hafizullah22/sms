<style>
    body {
        font-family: DejaVu Sans, Arial, sans-serif;
        font-size: 12px;
        margin: 0;
        padding: 0;
        color: #000;
    }

    .container {
        max-width: 800px;
        margin: 20px auto;
        background: #fff;
    }

   /* Header & Branding */
    .header-container {
        text-align: center;
        margin-bottom: 20px;
        padding-bottom: 10px;
    }

   

    .report-title {
        display: inline-block;
        background: #1c1717;
        color: #fff;
        padding: 5px 15px;
        border-radius: 5px;
        font-size: 11pt;
        margin-top: 10px;
        font-weight: bold;
    }

    .info {
        margin-bottom: 15px;
    }

    .info strong {
        display: inline-block;
        width: 120px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
    }

    table th, table td {
        border: 1px solid #000;
        padding: 8px;
        text-align: left;
    }

    table th {
        background: #f1f1f1;
    }

    
</style>


<body>

<div class="container">

    
<!-- HEADER SECTION -->
<div class="header-container">
    <div class="report-title">
      Payment Statement
    </div>
</div>
    <!-- STUDENT INFO -->
    <div class="info">
        <p><strong>Student Name:</strong> <?= htmlspecialchars($student_name ?? '-') ?></p>
        <p><strong>Class:</strong> <?= htmlspecialchars($class_name ?? '-') ?></p>
        <p><strong>Roll Number:</strong> <?= htmlspecialchars($roll_no ?? '-') ?></p>
    </div>

    <!-- PAYMENT TABLE -->

     <?php
        $months = [
                    1=>'January',2=>'February',3=>'March',4=>'April',
                    5=>'May',6=>'June',7=>'July',8=>'August',
                    9=>'September',10=>'October',11=>'November',12=>'December'
                 ];

        $type = [1=>'Tuition Fee',2=>'Exam Fee',3=>'Admission Fee',4=>'Other'];
     ?>
    <table>
        <thead>
            <tr>
                <th>SL</th>
                <th>Payment ID</th>
                <th>Month</th>
                <th>Payment Date</th>
                <th>Payment For</th>
                <th>Amount</th>
            </tr>
        </thead>

        <tbody>
            <?php if (!empty($payments)): ?>
                <?php $i = 1; foreach ($payments as $pay): ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td><?= $pay->id ?></td>
                        <td><?= $months[$pay->month] ?? '-' ?></td>
                        <td><?= $pay->pay_date ?></td>
                        <td><?= $type[$pay->payment_type] ?? '-' ?></td>
                        <td>৳ <?= number_format($pay->paid_amount, 2) ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="5" style="text-align:right; font-weight:bold;">Total Paid:</td>
                    <td style="font-weight:bold; color:#000;"><?= number_format($total_paid ?? 0, 2) ?></td>
                </tr>
            <?php else: ?>
                <tr>
                    <td colspan="5" style="text-align:center;">No payments found</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    

   
</div>

