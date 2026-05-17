<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pdf
{
    protected $CI;

    public function __construct()
    {
        $this->CI =& get_instance();

        require_once FCPATH . 'vendor/autoload.php';
    }

    public function load($format = 'A4', $orientation = 'P')
    {
        $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
        $fontDirs = $defaultConfig['fontDir'];

        $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];

        return new \Mpdf\Mpdf([

            'mode' => 'utf-8',

            'format' => $format,

            'orientation' => $orientation,

            'margin_top' => 35,
            'margin_left' => 15,
            'margin_right' => 15,
            'margin_bottom' => 15,

            // IMPORTANT
            'tempDir' => APPPATH . 'cache/mpdf',

            // Font directory
            'fontDir' => array_merge($fontDirs, [
                APPPATH . 'fonts',
            ]),

            // Custom fonts
            'fontdata' => $fontData + [

                'solaimanlipi' => [
                    'R' => 'SolaimanLipi.ttf',
                    'useOTL' => 0xFF,
                    'useKashida' => 75,
                ],

            ],

            // Auto language/font detection
            'autoScriptToLang' => true,
            'autoLangToFont'   => true,

            // Default font
            'default_font' => 'solaimanlipi',
        ]);
    }

    // HEADER
    public function header()
    {
        $school = $this->CI->db->get('school_info')->row();

        return '
        <div style="
            text-align:center;
            font-family:solaimanlipi;
            line-height:1.3;
        ">

            <div style="
                font-size:24px;
                font-weight:bold;
                color:#0d47a1;">
                '.$school->school_name_bn.'
            </div>

            <div style="
                font-size:13px;
                margin-top:4px;">
                '.$school->address.'
            </div>

            <div style="
                font-size:12px;
                margin-top:3px;
                font-family:dejavusans;">
                EIIN: '.$school->eiin_number.'
                |
                Established: '.$school->establishment_year.'
            </div>

            <hr style="
                border:0;
                border-top:1px solid #999;
                margin-top:8px;
            ">

        </div>';
    }
}