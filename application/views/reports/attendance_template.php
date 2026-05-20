<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: dejavusans, Arial, sans-serif; color: #333; }
        .header-section { text-align: center; margin-bottom: 20px; }
        .title { font-size: 18px; font-weight: bold; text-transform: uppercase; }
        .meta-info { font-size: 13px; color: #555; margin-top: 5px; }
        .attendance-table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        .attendance-table th, .attendance-table td { border: 1px solid #444; padding: 8px 5px; font-size: 12px; }
        .attendance-table th { background-color: #f2f4f4; text-align: center; }
        .text-center { text-align: center; }
        .bn { font-family: 'solaimanlipi', nikosh, dejavusans, sans-serif; }
        .en { font-family: Arial, dejavusans, sans-serif; }
    </style>
</head>
<body>

<div class="header-section">
    <div class="title">Examination Attendance Sheet</div>
    <div class="meta-info">
        <strong>Class:</strong> <?= $class->class_name ?> | 
        <strong>Academic Year:</strong> <?= $year ?>
    </div>
</div>

<table class="attendance-table">
    <thead>
        <tr>
            <th width="5%">Roll</th>
            <th width="25%">Student Name</th>
            <?php foreach($subjects as $sub): ?>
                <th class="<?= (preg_match('/[\x{0980}-\x{09FF}]/u', $sub->subject_name)) ? 'bn' : 'en'; ?>" style="font-size: 11px;">
                    <?= $sub->subject_name ?>
                </th>
            <?php endforeach; ?> </tr>
    </thead>
    <tbody>
        <?php foreach($students as $st): ?>
        <tr>
            <td class="text-center"><strong><?= $st->roll_no ?></strong></td>
            <td style="font-weight: bold;"><?= $st->full_name ?></td>
            <?php foreach($subjects as $sub): ?>
                <td style="height: 35px;"></td>
            <?php endforeach; ?> </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>