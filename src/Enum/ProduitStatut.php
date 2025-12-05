<?php

namespace App\Enum;

enum ProduitStatut : string {
    case DISPONIBLE = "En Stock";
    case RUPTURE = "Rupture de Stock";
    case PRECOMMANDE = "En Précommande";
}
