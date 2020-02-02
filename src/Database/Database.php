<?php

namespace App\Database;

use App\Model\Order;

class Database
{
    public function insertOrder(Order $order)
    {
        var_dump("REQUETE DATABASE POUR INSERER LA COMMANDE");
    }
}
