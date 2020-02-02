<?php

use App\Controller\OrderController;
use App\Database\Database;
use App\Mailer\GmailMailer;
use App\Mailer\MailerInterface;
use App\Mailer\SmtpMailer;
use App\Texter\FaxTexter;
use App\Texter\SmsTexter;
use App\Texter\TexterInterface;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\Reference;

require __DIR__ . '/vendor/autoload.php';

$container = new ContainerBuilder();

$loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/config'));
$loader->load('services.yml');

// $databaseDefinition = new Definition(Database::class);
// $container->setDefinition('database', $databaseDefinition);
// $container->setAlias(Database::class, 'database');
// $database = new Database();

// $texterDefinition = new Definition(SmsTexter::class);
// $texterDefinition->setArguments(["service.sms.com", "apikey123"]);
// $container->setDefinition('texter.sms', $texterDefinition);

// $texterFaxDefinition = new Definition(FaxTexter::class);
// $container->setDefinition('texter.fax', $texterFaxDefinition);
// $texter = new SmsTexter("service.sms.com", "apikey123");

// $mailerDefinition = new Definition(GmailMailer::class, ["lior@gmail.com", "123456"]);
// $container->setDefinition('mailer.gmail', $mailerDefinition);

// $mailerSmtpDefintion = new Definition(SmtpMailer::class, ['smtp://localhost', 'root', '123456']);
// $container->setDefinition('mailer.smtp', $mailerSmtpDefintion);
// $mailer = new GmailMailer("lior@gmail.com", "123456");

// $container->setAlias(MailerInterface::class, 'mailer.smtp');
// $container->setAlias(TexterInterface::class, 'texter.fax');
// $container->setAlias(Database::class, 'database');

// $controllerDefinition = new Definition(OrderController::class, [
//     new Reference(Database::class),
//     new Reference(MailerInterface::class),
//     new Reference(TexterInterface::class)
// ]);
// $controllerDefinition->addMethodCall('wakeup', ["Message de réveil"]);

// $container->setDefinition('controller.order', $controllerDefinition);
// $container->setAlias(OrderController::class, 'controller.order');

$controller = $container->get(OrderController::class);

$httpMethod = $_SERVER['REQUEST_METHOD'];

if ($httpMethod === 'POST') {
    $controller->placeOrder();
    return;
}

include __DIR__ . '/views/form.html.php';
