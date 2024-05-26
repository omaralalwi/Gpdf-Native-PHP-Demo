<?php

require_once __DIR__ . '/vendor/autoload.php';

use Omaralalwi\Gpdf\Gpdf;
use Omaralalwi\Gpdf\GpdfConfig;
use Omaralalwi\Gpdf\Enums\{GpdfDefaultSettings, GpdfSettingKeys as confKeys, GpdfDefaultSupportedFonts};

$html = file_get_contents(__DIR__ . '/contents/example-3-arabic-content.html');

// pass config file
$gpdfConfigFile = require_once 'config/gpdf.php';
$config = new GpdfConfig($gpdfConfigFile);

// another way by pass configs instantly (inline)
// NOTE: When pass config inline, you must provide Font dir and font cache config keys, to get their real path depend on current file path
//$config = new GpdfConfig([
//    confKeys::FONT_DIR => realpath(__DIR__.'/public/vendor/gpdf/fonts/'),
//    confKeys::FONT_CACHE => realpath(__DIR__.'/public/vendor/gpdf/fonts/'),
//    confKeys::DEFAULT_FONT => GpdfDefaultSupportedFonts::TAJAWAL,
//    confKeys::IS_JAVASCRIPT_ENABLED => true,
//]);

$gpdf = new Gpdf($config);
$pdfContent = $gpdf->generate($html);

header('Content-Type: application/pdf');
echo $pdfContent;
