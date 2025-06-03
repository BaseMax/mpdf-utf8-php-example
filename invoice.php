<?php
require __DIR__ . '/vendor/autoload.php';

use Mpdf\Mpdf;
use Mpdf\Config\ConfigVariables;
use Mpdf\Config\FontVariables;

$html = <<<HTML
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>صورتحساب</title>
    <style>
        body {
            font-family: 'XP Ziba';
            direction: rtl;
            text-align: right;
            line-height: 1.6;
        }
        h1 {
            color: #2E86C1;
            font-size: 24px;
        }
        p {
            font-size: 16px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 15px;
        }
        th, td {
            border: 1px solid #aaa;
            padding: 10px;
        }
        th {
            background-color: #f2f2f2;
        }
        tfoot td {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>صورتحساب فروش</h1>
    <p><strong>تاریخ:</strong> ۱۴۰۳/۰۳/۱۳</p>
    <p><strong>مشتری:</strong> علی رضایی</p>

    <table>
        <thead>
            <tr>
                <th>کالا</th>
                <th>تعداد</th>
                <th>قیمت واحد</th>
                <th>جمع</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>کتاب ریاضی</td>
                <td>۲</td>
                <td>۵۰۰٬۰۰۰ ریال</td>
                <td>۱٬۰۰۰٬۰۰۰ ریال</td>
            </tr>
            <tr>
                <td>دفتر مشق</td>
                <td>۵</td>
                <td>۱۰۰٬۰۰۰ ریال</td>
                <td>۵۰۰٬۰۰۰ ریال</td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" style="text-align: left;">مبلغ کل</td>
                <td>۱٬۵۰۰٬۰۰۰ ریال</td>
            </tr>
        </tfoot>
    </table>
</body>
</html>
HTML;

$config = (new ConfigVariables())->getDefaults();
$fontDirs = $config['fontDir'];

$fontConfig = (new FontVariables())->getDefaults();
$fontData = $fontConfig['fontdata'];

$mpdf = new Mpdf([
    'mode' => 'utf-8',
    'format' => 'A4',
    'margin_left' => 10,
    'margin_right' => 10,
    'margin_top' => 10,
    'margin_bottom' => 10,
    'fontDir' => array_merge($fontDirs, [__DIR__ . '/fonts']),
    'fontdata' => $fontData + [
        'XP Ziba' => [
            'R' => 'XP Ziba.ttf',
            'B' => 'XP Ziba Bd.ttf',
        ],
    ],
    'default_font' => 'XP Ziba',
    'default_direction' => 'rtl',
]);
$mpdf->showImageErrors = true;
$mpdf->debugfonts = true;
// $mpdf->autoLangToFont = true;
$mpdf->autoScriptToLang = true;

$mpdf->WriteHTML($html);
// $mpdf->Output('invoice.pdf', \Mpdf\Output\Destination::INLINE);
$mpdf->Output(__DIR__ . '/invoice.pdf', \Mpdf\Output\Destination::FILE);
print "PDF created successfully: " . __DIR__ . '/invoice.pdf' . "\n";
