<?php

require_once __DIR__. '/vendor/autoload.php';

use Omaralalwi\Gpdf\Gpdf;
use Omaralalwi\Gpdf\GpdfConfig;
use Omaralalwi\Gpdf\Enums\{GpdfDefaultSettings, GpdfSettingKeys, GpdfDefaultSupportedFonts};
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

// Initialize Twig
$loader = new FilesystemLoader(__DIR__. '/contents/');
$twig = new Environment($loader);

// Define dynamic parameters
$params = [
    'param1' => 'first dynamic param',
    'param2' => 'second dynamic param',
    // Add more parameters as needed
];

// Render the HTML template with dynamic parameters
$template = $twig->load('example-3-with-twig.twig'); // Note the.twig extension
$html = $template->render($params);

$gpdfConfigFile = require_once ('config/gpdf.php');
$config = new GpdfConfig($gpdfConfigFile);

$gpdf = new Gpdf($config);

$pdfContent = $gpdf->generate($html);

header('Content-Type: application/pdf');
echo $pdfContent;
