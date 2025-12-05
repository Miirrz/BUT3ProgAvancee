<?php

namespace App\Enum;

enum CommandeStatut : string {
    case PREPARATION = "En Préparation";
    case EXPEDIE = "Expédiée";
    case LIVREE = "Livrée";
    case ANNULEE = "Annulée";
}
