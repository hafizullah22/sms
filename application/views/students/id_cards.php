<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">

    <style>

       /* Update the body font to prioritize the Bangla font for complex rendering */
body {
    font-family: 'dejavusans',solaimanlipi, sans-serif;
    margin: 0;
    padding: 0;
    font-size: 14px;
    background: #ffffff;
}

/* Ensure headings use the correct font */
h1, h2, h3, .std-name, .info-row, .back-msg {
    font-family: 'dejavusans', sans-serif;
}

/* Specific fix for English text if it looks weird inside Bangla blocks */
.bn-text {
    font-family: 'solaimanlipi';
    font-size: 12px;
}
    
        .page-wrapper{
            width:100%;
        }

        .student-block{
            margin-bottom:25px;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        .card-table td{
            vertical-align:top;
        }

        /* =========================
            ID CARD
        ========================== */

        .id-card{
            width:330px;
            height:480px;
            border:1px solid #dcdcdc;
            overflow:hidden;
            background:#fff;
            position:relative;
        }

        /* Top Bar */

        .dotted-bar{
            height:10px;
            background:#004d36;
        }

        /* Header */

        .header-bg{
            background:#006a4e;
            height:140px;
            text-align:center;
            color:#fff;
            padding-top:20px;
        }

        .header-bg h1{
            margin:0;
            font-size:22px;
            font-weight:bold;
        }

        .header-bg h2{
            margin:5px 0 0;
            font-size:14px;
            color:#ffeb3b;
        }

        /* Photo */

        .photo-container{
            width:130px;
            height:130px;
            border:4px solid #8bc34a;
            margin:-55px auto 10px;
            background:#f2f2f2;
            text-align:center;
        }

        .photo-container img{
            width:130px;
            height:130px;
        }

        /* Student Info */

        .info-section{
            padding:10px 20px;
        }

        .std-name{
            text-align:center;
            font-size:18px;
            font-weight:bold;
            color:#1a237e;
            border-bottom:1px solid #1a237e;
            padding-bottom:5px;
            margin-bottom:15px;
        }

        .info-row{
            margin-bottom:8px;
            line-height:22px;
        }

        .info-label{
            font-weight:bold;
        }

        /* Signature */

        .signature-area{
            margin-top:30px;
            text-align:right;
            padding-right:20px;
        }

        .sig-text{
            border-top:1px solid #000;
            display:inline-block;
            font-size:10px;
            margin-top:5px;
            padding-top:2px;
        }

        /* =========================
            BACK SIDE
        ========================== */

        .back-logo{
            text-align:center;
            padding-top:40px;
        }

        .logo-circle img{
            width:90px;
            height:90px;
        }

        .back-msg{
            padding:20px;
            text-align:center;
            line-height:24px;
            font-size:13px;
        }

        .back-school-name{
            text-align:center;
            margin-top:10px;
        }

        .back-school-name h3{
            margin:0;
            color:#d32f2f;
            font-size:18px;
        }

        .back-school-name h4{
            margin:5px 0;
            color:#1a237e;
            font-size:14px;
        }

        .contact-info{
            font-size:12px;
            margin-top:10px;
            line-height:20px;
        }

        /* Footer Bar */

        .bottom-bar{
            position:absolute;
            bottom:0;
            width:100%;
        }

        /* Page Break */

        .page-break{
            page-break-after:always;
        }

    </style>
</head>

<body>

<div class="page-wrapper">

<?php
$count = 0;

foreach($students as $student):

$count++;
?>

<!-- Inside your foreach loop -->
<div class="id-card">
    <div class="dotted-bar"></div>
    <div class="header-bg">
        <h1 class="bn-text">আফটার স্কুল মাকতাব</h1>
        <!-- Using a span to ensure the English font is clean -->
        <h2 >AFTER SCHOOL MAKTAB</h2>
    </div>

    <div class="photo-container">
        <?php
        // Ensure the path is correct for your server environment
        $photo_path = !empty($student->photo) 
            ? FCPATH . 'uploads/students/' . $student->photo 
            : FCPATH . 'assets/images/avatars/default.jpg';
        ?>
        <img src="<?= $photo_path; ?>">
    </div>

    <div class="info-section">
        <div class="std-name">
            <span class="en-text"><?= $student->full_name; ?></span>
        </div>

        <div class="info-row">
            <span class="info-label bn-text">পিতা:</span> <span class="en-text"><?= $student->father_name; ?></span>
        </div>

        <div class="info-row">
            <span class="info-label bn-text">শ্রেণী:</span> <?= $student->class_id; ?>
        </div>

        <div class="info-row">
            <span class="info-label bn-text">রোল:</span> <?= $student->roll ?? '-'; ?>
        </div>

        <!-- Added more spacing or line-height if Bangla conjuncts get clipped -->
        <div class="info-row" style="line-height: 1.2;">
            <span class="info-label bn-text">গ্রাম:</span> <?= $student->permanent_address; ?>
        </div>

        <div class="info-row">
            <span class="info-label bn-text">মোবাইল:</span> <?= $student->guardian_phone; ?>
        </div>
    </div>
    
    <!-- Rest of your code... -->
</div>

<br>
<br>

<?php
if($count % 2 == 0 && $count < count($students)):
?>

<div class="page-break"></div>

<?php endif; ?>

<?php endforeach; ?>

</div>

</body>
</html>