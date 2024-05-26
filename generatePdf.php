<?php

require_once __DIR__ . '/vendor/autoload.php';

use Omaralalwi\Gpdf\Gpdf;
use Omaralalwi\Gpdf\GpdfConfig;
use Omaralalwi\Gpdf\Enums\{GpdfDefaultSettings, GpdfSettingKeys, GpdfDefaultSupportedFonts};

// get content from html file
$htmlFile = __DIR__ . '/contents/example-1.html';
$content = file_get_contents($htmlFile);

// first way with default settings
$gpdfConfigFile = require_once ('config/gpdf.php');
$config = new GpdfConfig($gpdfConfigFile);

// second way customize configs , Must pass font dir and font cache when pass inline settings
//$config = new GpdfConfig([
//    GpdfSettingKeys::FONT_DIR => __DIR__ . '/public/vendor/gpdf/fonts/',
//    GpdfSettingKeys::FONT_CACHE => GpdfDefaultSettings::FONT_CACHE,
//    GpdfSettingKeys::DEFAULT_FONT => GpdfDefaultSupportedFonts::DEJAVU_SANS,
//    GpdfSettingKeys::IS_JAVASCRIPT_ENABLED => true,
//]);

$gpdf = new Gpdf($config);
$pdfContent = $gpdf->generate($content);

header('Content-Type: application/pdf');

echo $pdfContent;
