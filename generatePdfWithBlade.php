<?php

require_once __DIR__ . '/vendor/autoload.php';

use Illuminate\View\Factory;
use Illuminate\View\Engines\CompilerEngine;
use Illuminate\View\Compilers\BladeCompiler;
use Illuminate\View\Engines\EngineResolver;
use Illuminate\View\ViewFinderInterface;
use Illuminate\View\FileViewFinder;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;
use Omaralalwi\Gpdf\Gpdf;
use Omaralalwi\Gpdf\GpdfConfig;
use Omaralalwi\Gpdf\Enums\{GpdfDefaultSettings, GpdfSettingKeys, GpdfDefaultSupportedFonts};

// Setup Blade
$filesystem = new Filesystem;
$viewPath = __DIR__ . '/contents';
$cachePath = __DIR__ . '/storage/views';

$bladeCompiler = new BladeCompiler($filesystem, $cachePath);
$engineResolver = new EngineResolver;

// Register the Blade engine
$engineResolver->register('blade', function () use ($bladeCompiler) {
    return new CompilerEngine($bladeCompiler);
});

// Instantiate ViewFinderInterface
$viewFinder = new FileViewFinder($filesystem, [$viewPath]);

// Create an instance of the event dispatcher
$dispatcher = new Dispatcher(new Container);

// Instantiate the Factory
$viewFactory = new Factory($engineResolver, $viewFinder, $dispatcher);

// Define dynamic parameters
$data = [
    'param1' => 'first dynamic param',
    'param2' => 'second dynamic param',
    // Add more parameters as needed
];

// Render the Blade view with dynamic parameters
$view = $viewFactory->make('example-3-with-blade', $data); // Note: no file extension
$html = $view->render();

$gpdfConfigFile = require_once ('config/gpdf.php');
$config = new GpdfConfig($gpdfConfigFile);

$gpdf = new Gpdf($config);

$pdfContent = $gpdf->generate($html);

header('Content-Type: application/pdf');
echo $pdfContent;
