<?php

use App\Controller\OrderController;
use App\DependencyInjection\LoggerAwareCompilerPass;
use App\DependencyInjection\TextSenderCompilerPass;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Dumper\PhpDumper;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

require __DIR__ . '/vendor/autoload.php';

$cachePath = __DIR__ . '/cache/container.php';

$start = microtime(true);
if (!file_exists($cachePath)) {

    $container = new ContainerBuilder();

    $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/config'));
    $loader->load('services.yml');

    $container->addCompilerPass(new LoggerAwareCompilerPass());
    $container->addCompilerPass(new TextSenderCompilerPass());

    $container->compile();

    $dumper = new PhpDumper($container);
    file_put_contents($cachePath, $dumper->dump());
}

require $cachePath;
$container = new \ProjectServiceContainer();

$time = (microtime(true) - $start) / 1000;
var_dump("Time Container : $time");

$controller = $container->get(OrderController::class);


$httpMethod = $_SERVER['REQUEST_METHOD'];

if ($httpMethod === 'POST') {
    $controller->placeOrder();
    return;
}

include __DIR__ . '/views/form.html.php';
