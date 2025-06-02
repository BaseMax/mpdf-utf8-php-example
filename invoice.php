<?php
require __DIR__ . '/vendor/autoload.php';

use Mpdf\Mpdf;

$html = '
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: "Vazirmatn-Medium", sans-serif;
            direction: rtl;
            text-align: right;
        }
        h1 {
            color: #2E86C1;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #aaa;
            padding: 8px;
        }
    </style>
</head>
<body>
    <h1>صورتحساب</h1>
    <p>تاریخ: ۱۴۰۳/۰۳/۱۳</p>
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
    </table>
    <h3>مبلغ کل: ۱٬۵۰۰٬۰۰۰ ریال</h3>
</body>
</html>
';

$mpdf = new Mpdf([
    'mode' => 'utf-8',
    'format' => 'A4',
    'default_font' => 'Vazirmatn-Medium', // fonts/Vazirmatn-Medium.ttf file
]);

$mpdf->WriteHTML($html);
$mpdf->Output('invoice.pdf', \Mpdf\Output\Destination::INLINE);
