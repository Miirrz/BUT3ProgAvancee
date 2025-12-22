<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        foreach ($this::categories as $nom) {
            $categorie = new Category();
            $categorie->setCategory($nom);
            
            $manager->persist($categorie);
        }

        $manager->flush();
    }

    const categories = [
        "Armure",
        "Arme",
        "Bouclier",
        "Anneau",
        "Flèche",
        "Carreau",
        "Consommable"
    ];
}
