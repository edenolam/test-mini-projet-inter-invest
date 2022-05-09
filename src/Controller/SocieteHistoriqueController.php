<?php

namespace App\Controller;

use App\Entity\Societe;
use App\Entity\SocieteHistorique;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SocieteHistoriqueController extends AbstractController
{
    /**
     * @Route("historique/{id}", name="societe_historique_show", methods={"GET"})
     */
    public function show(SocieteHistorique $historique): Response
    {
        return $this->render('societe_historique/show.html.twig', [
            'historique' => $historique
        ]);
    }
}
