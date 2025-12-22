<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Image;
use App\Entity\Produit;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Enum\ProduitStatut;

class ProduitFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        foreach ($this::produits as $nom => [$image,$categorie]) {
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

            $produitCategorie = new Category();
            $produitCategorie->setCategory($categorie);
            $produit->setCategory($produitCategorie);
            
            $manager->persist($produit);
        }

        $manager->flush();
    }

    const produits = [
        "Fiole d'Estus" => ["https://darksouls.wiki.fextralife.com/file/Dark-Souls/2005.png","Consommable"],
        "Dague" => ["https://darksouls.wiki.fextralife.com/file/Dark-Souls/Wpn_Dagger.png","Arme"],
        "Lance" => ["https://darksouls.wiki.fextralife.com/file/Dark-Souls/spear.png","Arme"],
        "Rondache" => ["https://darksouls.wiki.fextralife.com/file/Dark-Souls/buckler.png","Bouclier"],
        "Zweihander" => ["https://darksouls.wiki.fextralife.com/file/Dark-Souls/zweihander.png","Arme"],
        "Skull Lantern" => ["https://darksouls.wiki.fextralife.com/file/Dark-Souls/skull_lantern.png","Arme"],
        "Poing en os de dragon" => ["https://darksouls.wiki.fextralife.com/file/Dark-Souls/dragon_bone_fist_1.png","Arme"],
        "Anneau d'Havel" => ["https://darksouls.wiki.fextralife.com/file/Dark-Souls/4000.png","Anneau"],
        "Masque du père" => ["https://darksouls.wiki.fextralife.com/file/Dark-Souls/mask_of_the_father.png","Armure"],
        "Anneau de grâce protectrice" => ["https://darksouls.wiki.fextralife.com/file/Dark-Souls/4029.png","Anneau"],
        "Anneau de cloranthy" => ["https://darksouls.wiki.fextralife.com/file/Dark-Souls/4004.png","Anneau"],
        "Anneau de grâce protectrice" => ["https://darksouls.wiki.fextralife.com/file/Dark-Souls/4029.png","Anneau"],
        "Grand bouclier d'Artorias" => ["https://darksouls.wiki.fextralife.com/file/Dark-Souls/greatshield_of_artorias_1.png","Bouclier"],
        "Claymore" => ["https://darksouls.wiki.fextralife.com/file/Dark-Souls/claymore.png","Arme"],
        "Humanité" => ["https://darksouls.wiki.fextralife.com/file/Dark-Souls/2112.png","Consommable"],
        "Espadon du clair de lune" => ["https://darksouls.wiki.fextralife.com/file/Dark-Souls/moonlight_greatsword.png","Arme"],
        "Casque du chevalier d'élite" => ["https://darksouls.wiki.fextralife.com/file/Dark-Souls/elite_knight_helm.png","Armure"],
        "Armure du chevalier d'élite" => ["https://darksouls.wiki.fextralife.com/file/Dark-Souls/elite_knight_armor.png","Armure"],
        "Gantelets du chevalier d'élite" => ["https://darksouls.wiki.fextralife.com/file/Dark-Souls/elite_knight_gauntlets.png","Armure"],
        "Jambières du chevalier d'élite" => ["https://darksouls.wiki.fextralife.com/file/Dark-Souls/elite_knight_leggings.png","Armure"],
        "Os du retour" => ["https://darksouls.wiki.fextralife.com/file/Dark-Souls/2034.png","Consommable"],
        "Touffe de mousse violette" => ["https://darksouls.wiki.fextralife.com/file/Dark-Souls/2016.png","Consommable"]
    ];
}
