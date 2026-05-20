<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Official Student Admit Cards</title>
    <style>
        .admit-card-page {
            page-break-after: always;
            font-family: dejavusans, Arial, sans-serif;
            color: #333;
        }
        /* Prevents trailing blank layout generation on the very last record */
        .admit-card-page:last-child {
            page-break-after: avoid;
        }
        .card-border {
            border: 1px solid #070707;
            padding: 25px;
            margin-top: 15px;
            position: relative;
        }
        .report-title {
            display: inline-block;
            background: #000;
            color: #fff;
            padding: 5px 15px;
            border-radius: 4px;
            font-size: 11pt;
            font-weight: bold;
            margin-bottom: 15px;
            text-transform: uppercase;
            text-align:center;
        }
        .info-table {
            width: 100%;
            margin-bottom: 25px;
            font-family: Arial, dejavusans, sans-serif;
        }
        .info-table td {
            padding: 6px;
            font-size: 14px;
            vertical-align: middle;
        }
        .subject-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            font-family: dejavusans, Arial, sans-serif;
        }
        .subject-table th, .subject-table td {
            border: 1px solid #0d0d0e;
            padding: 10px 8px;
            text-align: left;
            font-size: 13px;
        }
        .subject-table th {
            background-color: #f2f4f4;
            font-weight: bold;
        }
        
        /* Dynamic Multi-Lingual Font Support Overrides */
        .bn {
            font-family: 'solaimanlipi', nikosh, dejavusans, sans-serif;
        }
        .en {
            font-family: Arial, dejavusans, sans-serif;
        }

        .footer-signatures {
            margin-top: 50px;
            width: 100%;
        }
        .signature-line {
            border-top: 1px dashed #333;
            text-align: center;
            font-size: 12px;
            padding-top: 5px;
            width: 200px;
            font-family: dejavusans, Arial, sans-serif;
        }
    </style>
</head>
<body>

<?php foreach($students as $st): ?>
<div class="admit-card-page">
    <div class="card-border">
        
        <div class="report-title">
            Admit Card
        </div>
        
        <table class="info-table">
            <tr>
                <td width="20%"><strong>Student Name:</strong></td>
                <td width="45%" style="border-bottom: 1px solid #eee;"><?= $st->full_name ?></td>
                <td width="15%"><strong>Year:</strong></td>
                <td width="20%" style="border-bottom: 1px solid #eee;"><?= $year ?></td>
            </tr>
            <tr>
                <td><strong>Roll No:</strong></td>
                <td style="border-bottom: 1px solid #eee;"><span style="font-size: 16px; font-weight: bold;"><?= $st->roll_no ?></span></td>
                <td><strong>Class:</strong></td>
                <td style="border-bottom: 1px solid #eee;"><?= $class->class_name ?></td>
            </tr>
        </table>

        <h4 style="margin: 10px 0 5px 0; color: #2c3e50;">Permitted Examination Subjects List</h4>
        <table class="subject-table">
            <thead>
                <tr>
                    <th>Subject Name</th>
                    <th width="30%">Candidate Signature</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($subjects)): ?>
                    <?php foreach($subjects as $sub): ?>
                        <tr>
                            <td style="font-weight: bold;" class="<?= (preg_match('/[\x{0980}-\x{09FF}]/u', $sub->subject_name)) ? 'bn' : 'en'; ?>">
                                <?= $sub->subject_name; ?>
                            </td>
                            <td></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="2" style="text-align: center; color: red;">No active subjects assigned to this class.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <div style="margin-top: 25px; font-size: 11px; color: #555; background: #f9f9f9; padding: 12px; border: 1px solid #e3e3e3; border-radius: 4px;">
            <strong style="color: #333;">Instructions for the Candidate:</strong>
            <ol style="margin: 5px 0 0 0; padding-left: 15px; line-height: 1.5;">
                <li>Candidates must bring this printed copy to the examination hall on all testing days.</li>
                <li>Please arrive at least 15 minutes before the scheduled exam start time.</li>
                <li>No electronic communication gadgets are permitted inside the evaluation hall environment.</li>
            </ol>
        </div>

        <table class="footer-signatures" align="center">
            <tr>
                <td align="left">
                    <div class="signature-line" style="margin-top: 20px;">Class Teacher's Signature</div>
                </td>
                <td align="right">
                    <div class="signature-line" style="margin-top: 20px;">Controller of Examinations</div>
                </td>
            </tr>
        </table>

    </div>
</div>
<?php endforeach; ?>

</body>
</html>