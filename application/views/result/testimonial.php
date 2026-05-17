<style>
        body { font-family: "solaimanlipi", "freeserif", sans-serif; font-size: 18px;}
        .title-box { text-align: center; margin-top: 20px; margin-bottom: 20px; }
        .title { 
            font-size: 22px; 
            border: 1px solid #000; 
            padding: 5px 20px; 
            display: inline-block; 
            border-radius: 5px;
            background: #f4f4f4;
        }
        .content { font-size: 22px; line-height: 1.5; text-align: justify; margin-top: 20px; }
        .info-table { width: 100%; margin-bottom: 20px;}
        .footer-table { width: 100%; margin-top: 80px; font-size: 20px; }
        .sig-line { border-top: 1px solid #000; width: 200px; text-align: center; padding-top: 5px; }
    </style>

    <table class="info-table">
        <tr>
            <td style="text-align:left; ">স্মারক নং: ....................</td>
            <td style="text-align:right;">তারিখ: '<?php echo date('d/m/Y'); ?> ইং</td>
        </tr>
    </table>

    <div class="title-box">
        <span class="title">&nbsp;প্রত্যয়ন পত্র&nbsp;</span>
    </div>

    <div class="content" >
    এই মর্মে প্রত্যয়ন করা যাইতেছে যে, 
    <b><?php echo !empty($student->full_name) ? $student->full_name : '---'; ?></b>, 
    পিতা: <b><?php echo !empty($student->father_name) ? $student->father_name : '---'; ?></b>, 
    মাতা: <b><?php echo !empty($student->mother_name) ? $student->mother_name : '---'; ?></b>, 
    অত্র বিদ্যালয়ের এক নিয়মিত ছাত্র/ছাত্রী ছিল। 

    বিদ্যালয় রেকর্ড অনুযায়ী তাহার রোল নং: <span style="font-family: dejavusans; font-size: 16px;">
    <b><?php echo !empty($student->roll_no) ? $student->roll_no : '---'; ?></b> </span>
    এবং সে 
    <b><span style="font-family: dejavusans; font-size: 16px;"><?php echo !empty($student->class_id) ? $student->class_id : '---'; ?></b> শ্রেণীতে অধ্যয়নরত ছিল। 
</span>
    <br><br>

    আমার জানামতে সে রাষ্ট্রবিরোধী বা আইন শৃঙ্খলা পরিপন্থী কোন কাজের সহিত জড়িত নহে। 
    অত্র বিদ্যালয়ে অধ্যয়নকালে তাহার স্বভাব ও চরিত্র সন্তোষজনক ছিল। 

    <br><br>

    আমি তাহার জীবনের উত্তরোত্তর সাফল্য ও উজ্জ্বল ভবিষ্যৎ কামনা করি।
</div>

    <table class="footer-table">
        <tr>
            <td style="text-align: left; vertical-align: bottom;">
                <div style="width:150px; border-top:1px solid #000; text-align:center;">প্রস্তুতকারীর স্বাক্ষর</div>
            </td>
            <td style="text-align: right;">
                <div style="display:inline-block; text-align:center;">
                    <div style="margin-bottom: 50px;"></div>
                    <div class="sig-line">প্রধান শিক্ষকের স্বাক্ষর</div>
                </div>
            </td>
        </tr>
    </table>