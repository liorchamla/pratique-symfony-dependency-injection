<?php

namespace App\Controller;

use App\Database\Database;
use App\Mailer\Email;
use App\Mailer\MailerInterface;
use App\Model\Order;
use App\Texter\Text;
use App\Texter\TexterInterface;

class OrderController
{
    protected $texter;
    protected $mailer;
    protected $database;

    public function __construct(Database $database, MailerInterface $mailer, TexterInterface $texter)
    {
        $this->database = $database;
        $this->mailer = $mailer;
        $this->texter = $texter;
    }

    public function placeOrder()
    {
        $order = new Order($_POST['product'], (int) $_POST['quantity']);

        $email = new Email();
        $email->setSubject("Préparer une commande")
            ->setBody("Vous devez préparer {$order->getQuantity()} pour le produit {$order->getProduct()}")
            ->setTo("stock@monstore.com")
            ->setFrom("web@monstore.com");
        $this->mailer->send($email);

        $this->database->insertOrder($order);

        $textMessage = new Text();
        $textMessage->setTo($_POST['phone'])
            ->setContent("Félicitation, votre commande arrive !");

        $this->texter->send($textMessage);
    }
}
