<?php
require __DIR__ . '/vendor/autoload.php';

use Mpdf\Mpdf;
use Mpdf\Config\ConfigVariables;
use Mpdf\Config\FontVariables;

$config = (new ConfigVariables())->getDefaults();
$fontDirs = $config['fontDir'];

$fontConfig = (new FontVariables())->getDefaults();
$fontData = $fontConfig['fontdata'];

$mpdf = new Mpdf([
    'mode' => 'utf-8',
    'fontDir' => array_merge($fontDirs, [__DIR__ . '/fonts']),
    'fontdata' => $fontData + [
        'amiri' => [
            'R' => 'Amiri-Regular.ttf',
            // 'B' => 'vazirmatn-bold.ttf',
            // 'I' => 'vazirmatn-regular.ttf',
            // 'BI' => 'vazirmatn-bold.ttf',
        ],
    ],
    'default_font' => 'amiri',
    'default_direction' => 'rtl',
]);
$mpdf->SetDisplayMode('fullpage');
$mpdf->SetTitle('Test PDF with Custom Font');
$mpdf->SetAuthor('Your Name');
$mpdf->SetCreator('Your Application Name');
$mpdf->SetSubject('Test PDF Subject');
$mpdf->SetKeywords('PDF, Custom Font, mPDF');
$mpdf->useAdobeCJK = true; // Enable CJK support if needed
$mpdf->useSubstitutions = true; // Enable font substitutions

$mpdf->debugfonts = true;


// $mpdf->autoLangToFont = true;
$mpdf->autoScriptToLang = true;
// $mpdf->autoLangToFont = false;
// $mpdf->autoScriptToLang = false;
// print_r($mpdf->fontdata);

$html = '<p style="font-family: amiri;" lang="fa" dir="rtl">متن تست با فونت امیری</p>';

$mpdf->WriteHTML($html);

$mpdf->Output('test.pdf', \Mpdf\Output\Destination::FILE);

echo "PDF generated with custom font.\n";
