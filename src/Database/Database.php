<?php

namespace App\Database;

use App\Logger\LoggerAwareInterface;
use App\Model\Order;

class Database implements LoggerAwareInterface
{
    protected $logger;

    public function setLogger(\App\Logger\DumpLogger $logger)
    {
        $this->logger = $logger;
    }

    public function insertOrder(Order $order)
    {
        $this->logger->log("LOG D'UNE REQUETE !");
        var_dump("REQUETE DATABASE POUR INSERER LA COMMANDE");
    }
}
