<?php

require_once __DIR__ . '/vendor/autoload.php';

use Omaralalwi\Gpdf\Gpdf;
use Omaralalwi\Gpdf\GpdfConfig;
use Omaralalwi\Gpdf\Enums\{GpdfDefaultSettings, GpdfSettingKeys, GpdfDefaultSupportedFonts};

function populateDynamicParams($html, $params) {
    foreach ($params as $key => $value) {
        $html = str_replace("{{$key}}", $value, $html);
    }
    return $html;
}

// Define multiple dynamic parameters in an associative array
$params = [
    'param1' => 'first dynamic param',
    'param2' => 'second dynamic param',
    'param3' => 'third dynamic param',
    // Add more parameters as needed
];

// Load the HTML template
$html = file_get_contents(__DIR__ . '/contents/example-4-dynamic-content.html');
$html = populateDynamicParams($html, $params);

$gpdfConfigFile = require_once ('config/gpdf.php');
$config = new GpdfConfig($gpdfConfigFile);

$gpdf = new Gpdf($config);
$pdfContent = $gpdf->generate($html);

header('Content-Type: application/pdf');
echo $pdfContent;
