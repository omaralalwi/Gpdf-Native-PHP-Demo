<?php

require_once __DIR__ . '/vendor/autoload.php';

use Omaralalwi\Gpdf\Gpdf;
use Omaralalwi\Gpdf\GpdfConfig;
use Omaralalwi\Gpdf\Enums\{GpdfDefaultSettings, GpdfSettingKeys, GpdfDefaultSupportedFonts};

$htmlFile = __DIR__ . '/contents/example-1.html';
$content = file_get_contents($htmlFile);

// first way with default settings
$gpdfConfigFile = require_once ('config/gpdf.php');
$config = new GpdfConfig($gpdfConfigFile);

$gpdf = new Gpdf($config);
$pdfContent = $gpdf->generateWithStore($content,__DIR__ . '/storage/downloads/');
$pdfContent = $gpdf->generate($content);

header('Content-Type: application/pdf');

echo $pdfContent;
