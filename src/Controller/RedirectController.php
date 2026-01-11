<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RedirectController extends AbstractController
{
    #[Route('/change-locale/{locale}', name: 'change_locale')]
    public function changeLocale(Request $request, string $locale): Response
    {
        $request->getSession()->set('_locale', $locale);
        $request->setLocale($locale);

        $referer = $request->headers->get('referer');
        if ($referer) {
            return $this->redirect($referer);
        }

        return $this->redirectToRoute('accueil');
    }

    #[Route('/{path<.+>}', name: 'catch_all', priority: -1)]
    public function catchAll(): Response
    {
        return $this->redirectToRoute('accueil');
    }
}
