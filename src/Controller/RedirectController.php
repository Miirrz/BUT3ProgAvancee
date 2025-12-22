<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RedirectController extends AbstractController
{
    #[Route('/{path<.+>}', name: 'catch_all', priority: -1)]
    public function catchAll(): Response
    {
        return $this->redirectToRoute('accueil');
    }
}
