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

    // "nom du produit => "Lien de l'Image"
    const produits = [
        "Fiole d'Estus" => "https://darksouls.wiki.fextralife.com/file/Dark-Souls/2005.png",
        "Dague" => "https://darksouls.wiki.fextralife.com/file/Dark-Souls/Wpn_Dagger.png",
        "Lance" => "https://darksouls.wiki.fextralife.com/file/Dark-Souls/spear.png",
        "Rondache" => "https://darksouls.wiki.fextralife.com/file/Dark-Souls/buckler.png"
    ];
}
