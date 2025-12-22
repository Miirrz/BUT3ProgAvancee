<?php

namespace App\Controller\Admin;

use App\Entity\Commande;
use App\Entity\Produit;
use App\Entity\User;
use App\Enum\CommandeStatut;
use App\Enum\ProduitStatut;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;

#[AdminDashboard(routePath: '/admin', routeName: 'admin')]
class DashboardController extends AbstractDashboardController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function index(): Response
    {
        // Ventes par mois 
        $query = $this->entityManager->createQuery(
            'SELECT SUM(cp.prixProduit * cp.quantite) as total, SUBSTRING(c.createdAt, 1, 7) as month
             FROM App\Entity\CommandeProduit cp
             JOIN cp.commande c
             WHERE c.statut = :statut
             GROUP BY month
             ORDER BY month'
        )->setParameter('statut', CommandeStatut::LIVREE);
        $ventesParMois = $query->getResult();

        // Les 5 dernières commandes passées
        $lastCommandes = $this->entityManager->getRepository(Commande::class)->findBy([], ['createdAt' => 'DESC'], 5);

        // Ratio de disponibilité des produits
        $produitRepo = $this->entityManager->getRepository(Produit::class);

        $dispo = [
            'en_stock' => $produitRepo->count(['statut' => ProduitStatut::DISPONIBLE]),
            'rupture' => $produitRepo->count(['statut' => ProduitStatut::RUPTURE]),
            'precommande' => $produitRepo->count(['statut' => ProduitStatut::PRECOMMANDE]),
        ];

        $totalProduits = array_sum($dispo);

        $dispoRatio = $totalProduits > 0 ? [
            'en_stock' => ($dispo['en_stock'] / $totalProduits) * 100,
            'rupture' => ($dispo['rupture'] / $totalProduits) * 100,
            'precommande' => ($dispo['precommande'] / $totalProduits) * 100,
        ] : ['en_stock' => 0, 'rupture' => 0, 'precommande' => 0];

        // Products par categorie
        $query = $this->entityManager->createQuery(
            'SELECT cat.category as nomCateg, COUNT(p.id) as compteProduit
             FROM App\Entity\Produit p
             JOIN p.category cat
             GROUP BY cat.category'
        );
        $produitsParCateg = $query->getResult();

        return $this->render('admin/dashboard.html.twig', [
            'ventesParMois' => $ventesParMois,
            'lastCommandes' => $lastCommandes,
            'dispoRatio' => $dispoRatio,
            'produitsParCateg' => $produitsParCateg,
        ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('BUT3ProgAvancee');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Commandes', 'fas fa-shopping-cart', Commande::class);
        yield MenuItem::linkToCrud('Produits', 'fas fa-list', Produit::class);
        yield MenuItem::linkToCrud('Users', 'fas fa-users', User::class);
    }
}
