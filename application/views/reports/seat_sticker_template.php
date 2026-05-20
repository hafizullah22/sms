<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: dejavusans, solaimanlipi,Arial, sans-serif; margin: 0; padding: 0; }
        .sticker-box {
            width: 48%;
            float: left;
            border: 2px dashed #333;
            box-sizing: border-box;
            padding: 15px;
            margin: 1%;
            text-align: center;
            border-radius: 5px;
        }
        .school-title { font-size: 11px; letter-spacing: 1px; color: #666; font-weight: bold; text-transform: uppercase; }
        .sticker-title { font-size: 14px; font-weight: bold; background: #e3e3e3; margin: 5px 0; padding: 3px; }
        .roll-display { font-size: 24px; font-weight: bold; margin: 5px 0; color: #2c3e50; }
        .student-name { font-size: 13px; font-weight: bold; margin-bottom: 5px; }
        .class-year { font-size: 12px; color: #555; }
        /* Clears floats after every pair of stickers to preserve grid consistency */
        .clearfix { clear: both; }
    </style>
</head>
<body>

<?php $count = 0; ?>
<?php foreach($students as $st): ?>
    <div class="sticker-box">
        <div class="school-title">Final Examination</div>
        <div class="sticker-title">SEAT STICKER</div>
        <div class="roll-display">ROLL: <?= $st->roll_no ?></div>
        <div class="student-name"><?= $st->full_name ?></div>
        <div class="class-year">Class: <?= $class->class_name ?> | Year: <?= $year ?></div>
    </div>

    <?php $count++; ?>
    <?php if($count % 2 == 0): ?>
        <div class="clearfix"></div>
    <?php endif; ?>
<?php endforeach; ?>

</body>
</html>