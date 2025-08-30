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
    'format' => 'A4',
    'fontDir' => array_merge($fontDirs, [__DIR__ . '/fonts']),
    'fontdata' => $fontData + [
        'scheherazade' => [
            'R' => 'ScheherazadeNew-Regular.ttf',
            'B' => 'ScheherazadeNew-Bold.ttf',
            'useKashida' => 75, // better justification for RTL text
        ],
    ],
    'default_font' => 'scheherazade',
    'default_direction' => 'rtl',
]);

$mpdf->SetDisplayMode('fullpage');
$mpdf->SetTitle('Test PDF with Custom Font');
$mpdf->SetAuthor('Your Name');
$mpdf->SetCreator('Your Application Name');
$mpdf->SetSubject('Test PDF Subject');
$mpdf->SetKeywords('PDF, Custom Font, mPDF');

// RTL + language detection (important for Farsi)
$mpdf->autoLangToFont = true;
$mpdf->autoScriptToLang = true;

// Debugging (optional, can be removed later)
$mpdf->debugfonts = false;

// Example Farsi text
$html = '<p style="font-family: scheherazade; font-size:18px;" lang="fa" dir="rtl">
عباس پشت میز خود نشسته بود، جرعه‌ای چای می‌نوشید و در مخزن گیت‌هابی که به تازگی فورک کرده بود اسکرول می‌کرد. پروژه امیدوارکننده به نظر می‌رسید، اما چیزی درست نبود.

او روی تب Issues کلیک کرد.
ده‌ها باگ کوچک و ناسازگاری مثل گیاهانی که آب نخورده‌اند در انتظار بودند؛ هرکدام برچسبی مثل "good first issue" یا "help wanted" داشتند.

عباس با خودش فکر کرد: "عالیه، وقتشه دست به کار بشم."

اولین کار ساده بود: صفحات ورود (login) و ثبت‌نام (register) کاملاً متفاوت به نظر می‌رسیدند — فونت‌ها ناسازگار، دکمه‌ها نامرتب و رنگ‌ها ناهمگون بودند. کاربری که قصد ثبت‌نام داشت، احساس می‌کرد وارد دو برنامه کاملاً متفاوت شده است.

او مخزن را کشید (pull کرد)، ویرایشگر خود را باز کرد و شروع به اصلاح فاصله‌ها، هم‌تراز کردن آیکون‌ها و بهبود طراحی کرد. همچنین یک لوگوی مرتب به بالای صفحه ورود اضافه کرد تا ساختارش مشابه صفحه ثبت‌نام شود.
</p>';

$mpdf->WriteHTML($html);

// Output PDF
$mpdf->Output('test.pdf', \Mpdf\Output\Destination::FILE);

echo "PDF generated with Scheherazade font.\n";

exit(0);
