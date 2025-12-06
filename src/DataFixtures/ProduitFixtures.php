<?php

namespace App\DataFixtures;

use App\Entity\Image;
use App\Entity\Produit;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Enum\ProduitStatut;

class ProduitFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        foreach ($this::produits as $nom => $image) {
            $produit = new Produit();
            $produit->setName($nom);
            $produit->setPrice( mt_rand(200,50000) / 100 );
            $produit->setDescription("Description du produit");
            $produit->setStock(mt_rand(0,30));
            if ($produit->getStock() === 0) {
                $produit->setStatut(ProduitStatut::RUPTURE);
            } else {
                $produit->setStatut(ProduitStatut::DISPONIBLE);
            }
            $produitImage = new Image();
            $produitImage->setUrl($image);
            $produit->setImage($produitImage);
            
            $manager->persist($produit);
        }

        $manager->flush();
    }

    const produits = [
        "Fiole d'Estus" => "https://darksouls.wiki.fextralife.com/file/Dark-Souls/2005.png",
        "Dague" => "https://darksouls.wiki.fextralife.com/file/Dark-Souls/Wpn_Dagger.png",
        "Lance" => "https://darksouls.wiki.fextralife.com/file/Dark-Souls/spear.png",
        "Rondache" => "https://darksouls.wiki.fextralife.com/file/Dark-Souls/buckler.png",
        "Zweihander" => "https://darksouls.wiki.fextralife.com/file/Dark-Souls/zweihander.png",
        "Skull Lantern" => "https://darksouls.wiki.fextralife.com/file/Dark-Souls/skull_lantern.png",
        "Poing en os de dragon" => "https://darksouls.wiki.fextralife.com/file/Dark-Souls/dragon_bone_fist_1.png",
        "Anneau d'Havel" => "https://darksouls.wiki.fextralife.com/file/Dark-Souls/4000.png",
        "Masque du père" => "https://darksouls.wiki.fextralife.com/file/Dark-Souls/mask_of_the_father.png",
        "Anneau de grâce protectrice" => "https://darksouls.wiki.fextralife.com/file/Dark-Souls/4029.png",
        "Anneau de cloranthy" => "https://darksouls.wiki.fextralife.com/file/Dark-Souls/4004.png",
        "Anneau de grâce protectrice" => "https://darksouls.wiki.fextralife.com/file/Dark-Souls/4029.png",
        "Grand bouclier d'Artorias" => "https://darksouls.wiki.fextralife.com/file/Dark-Souls/greatshield_of_artorias_1.png",
        "Claymore" => "https://darksouls.wiki.fextralife.com/file/Dark-Souls/claymore.png",
        "Humanité" => "https://darksouls.wiki.fextralife.com/file/Dark-Souls/2112.png",
        "Espadon du clair de lune" => "https://darksouls.wiki.fextralife.com/file/Dark-Souls/moonlight_greatsword.png",
        "Casque du chevalier d'élite" => "https://darksouls.wiki.fextralife.com/file/Dark-Souls/elite_knight_helm.png",
        "Armure du chevalier d'élite" => "https://darksouls.wiki.fextralife.com/file/Dark-Souls/elite_knight_armor.png",
        "Gantelets du chevalier d'élite" => "https://darksouls.wiki.fextralife.com/file/Dark-Souls/elite_knight_gauntlets.png",
        "Jambières du chevalier d'élite" => "https://darksouls.wiki.fextralife.com/file/Dark-Souls/elite_knight_leggings.png",
        "Os du retour" => "https://darksouls.wiki.fextralife.com/file/Dark-Souls/2034.png",
        "Touffe de mousse violette" => "https://darksouls.wiki.fextralife.com/file/Dark-Souls/2016.png"
    ];
}
