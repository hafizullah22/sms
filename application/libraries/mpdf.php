<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mpdf {

    protected $CI;

    public function __construct() {
        // Get CodeIgniter instance to access paths if needed
        $this->CI =& get_instance();
    }

    public function mpdf ($format = 'A4', $orientation = 'P') {
        // Load Composer Autoload
        require_once APPPATH . '../vendor/autoload.php';

        $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
        $fontDirs = $defaultConfig['fontDir'];

        $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];

        return new \Mpdf\Mpdf([
            'mode' => 'utf-8',
            'format' => $format,
             'margin_top' => 35,
             'margin_left' => 15,
            'margin_right' => 15,

            'orientation' => $orientation,
            'tempDir' => APPPATH . 'cache/',
            'fontDir' => array_merge($fontDirs, [
                APPPATH . 'fonts', 
            ]),
            'fontdata' => $fontData + [
                'solaimanlipi' => [
                    'R' => 'SolaimanLipi.ttf',
                    'useOTL' => 0xFF,
                    'useKashida' => 75,
                ]
            ],
            'autoScriptToLang' => true,
            'autoLangToFont'   => true,
            'default_font'     => 'dejavusans'
        ]);

  

    }

   // HEADER
    public function header()
    {
        $school = $this->CI->db->get('school_info')->row();

        return '
        <div style="
            text-align:center;
            font-family:solaimanlipi, sans-serif;
            line-height:1.2;
        ">

            <div style="
                font-size:26px;
                font-weight:bold;
                color:#000080;">
                '.$school->school_name_bn.'
            </div>

            <div style="
                font-size:14px;
                margin-top:4px;">
                '.$school->address.'
            </div>

            <div style="
                font-size:13px;
                margin-top:2px;
                font-family:dejavusans;">
                EIIN: '.$school->eiin_number.'
                |
                Established: '.$school->establishment_year.'
            </div>

            <hr style="
                border:0;
                border-top:1px solid #000;
                margin-top:8px;
            ">

        </div>';
    }
}