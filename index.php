<?php

use App\Controller\OrderController;
use App\Database\Database;
use App\Mailer\GmailMailer;
use App\Texter\SmsTexter;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

require __DIR__ . '/vendor/autoload.php';

$container = new ContainerBuilder();


$controllerDefinition = new Definition(OrderController::class, [
    new Reference('database'),
    new Reference('mailer.gmail'),
    new Reference('texter.sms')
]);
$controllerDefinition->addMethodCall('wakeup', ["Message de réveil"]);

$container->setDefinition('controller.order', $controllerDefinition);

$databaseDefinition = new Definition(Database::class);
$container->setDefinition('database', $databaseDefinition);
// $database = new Database();

$texterDefinition = new Definition(SmsTexter::class);
$texterDefinition->setArguments(["service.sms.com", "apikey123"]);
$container->setDefinition('texter.sms', $texterDefinition);
// $texter = new SmsTexter("service.sms.com", "apikey123");

$mailerDefinition = new Definition(GmailMailer::class, ["lior@gmail.com", "123456"]);
$container->setDefinition('mailer.gmail', $mailerDefinition);
// $mailer = new GmailMailer("lior@gmail.com", "123456");

$controller = $container->get('controller.order');

$httpMethod = $_SERVER['REQUEST_METHOD'];

if ($httpMethod === 'POST') {
    $controller->placeOrder();
    return;
}

include __DIR__ . '/views/form.html.php';
