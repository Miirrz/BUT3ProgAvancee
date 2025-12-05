<?php

namespace App\DataFixtures;

use App\Entity\Commande;
use App\Entity\CommandeProduit;
use App\Entity\Produit;
use App\Entity\User;
use App\Enum\CommandeStatut;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CommandeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $userRepository = $manager->getRepository(User::class);
        $produitRepository = $manager->getRepository(Produit::class);

        $users = $userRepository->findAll();
        $produits = $produitRepository->findAll();

        for ($i = 0; $i < 10; $i++) {
            $commande = new Commande();
            $commande->setCreatedAt(new DateTimeImmutable());
            $commande->setStatut(CommandeStatut::PREPARATION);
            $commande->setUser($users[mt_rand(0, count($users) - 1)]);
            $commande->setReference($this->generateReference());

            shuffle($produits);

            for ($j = 0; $j < mt_rand(1, count($produits) -1); $j++) {
                $commandeProduit = new CommandeProduit();
                $commandeProduit->setProduit($produits[$j]);
                $commandeProduit->setQuantite(mt_rand(1, 3));
                $commandeProduit->setPrixProduit($produits[$j]->getPrice());
                $commande->addCommandeProduit($commandeProduit);
                $manager->persist($commandeProduit);
            }

            $manager->persist($commande);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
            ProduitFixtures::class,
        ];
    }

    private function generateReference(): string
    {
        return 'CMD-' . strtoupper(uniqid());
    }
}
