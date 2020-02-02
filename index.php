<?php

use App\Controller\OrderController;
use App\Database\Database;
use App\Mailer\GmailMailer;
use App\Texter\SmsTexter;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;

require __DIR__ . '/vendor/autoload.php';

$container = new ContainerBuilder();

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

$controller = new OrderController($container->get('database'), $container->get('mailer.gmail'), $container->get('texter.sms'));

$httpMethod = $_SERVER['REQUEST_METHOD'];

if ($httpMethod === 'POST') {
    $controller->placeOrder();
    return;
}

include __DIR__ . '/views/form.html.php';
