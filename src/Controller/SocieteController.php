<?php

namespace App\Controller;

use App\Entity\Adresse;
use App\Entity\AdresseHistorique;
use App\Entity\FormeJuridique;
use App\Entity\Societe;
use App\Entity\SocieteHistorique;
use App\Form\AdresseType;
use App\Form\SocieteType;
use App\Repository\SocieteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class SocieteController extends AbstractController
{
    /**
     * @Route("/", name="societe_index", methods={"GET"})
     */
    public function index(SocieteRepository $societeRepository): Response
    {

        return $this->render('societe/index.html.twig', [
            'societes' => $societeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="societe_new", methods={"GET", "POST"})
     */
    public function new(Request $request, SocieteRepository $societeRepository): Response
    {
        $societe = new Societe();
        $form = $this->createForm(SocieteType::class, $societe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $societe->setCreatedAt(new \DateTimeImmutable('now'));
            $societeRepository->add($societe);
            return $this->redirectToRoute('societe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('societe/new.html.twig', [
            'societe' => $societe,
            'form_societe' => $form
        ]);
    }

    /**
     * @Route("/{id}", name="societe_show", methods={"GET", "POST"})
     */
    public function show(Societe $societe, Request $request, EntityManagerInterface $manager, SocieteHistorique $historique): Response
    {
       $adresse = new Adresse();
        $form = $this->createForm(AdresseType::class, $adresse);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $adresse->setSociete($societe);
            $manager->persist($adresse);
            $manager->flush();
            return $this->redirectToRoute('societe_show', ['id' => $societe->getId()], Response::HTTP_SEE_OTHER);
        }
        return $this->render('societe/show.html.twig', [
            'societe' => $societe,
            'historique' => $historique,
            'formAdresse' => $form->createView()
        ]);
    }


    /**
     * @Route("/{id}/edit", name="societe_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Societe $societe, FormeJuridique $formeJuridique, EntityManagerInterface $manager): Response
    {
        $form = $this->createForm(SocieteType::class, $societe);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $societe->setUpdatedAt(new \DateTimeImmutable('now'));
            $societe_historique = new SocieteHistorique();
            $societe_historique->setSociete($societe);
            $societe_historique->setNom($societe->getNom());
            $societe_historique->setSiren($societe->getSiren());
            $societe_historique->setVilleImmatriculation($societe->getVilleImmatriculation());
            $societe_historique->setCreatedAt($societe->getUpdatedAt());
            $societe_historique->setCapital($societe->getCapital());
            $societe_historique->setFormJuridique($societe->getFormeJuridique());
            foreach ($societe->getAdresses() as $adress){
                $adresseHistorique = new AdresseHistorique();
                $adresseHistorique->setSocieteHistorique($societe_historique);
                $adresseHistorique->setNumero($adress->getNumero());
                $adresseHistorique->setTypeVoie($adress->getTypeVoie());
                $adresseHistorique->setNomVoie($adress->getNomVoie());
                $adresseHistorique->setVille($adress->getVille());
                $adresseHistorique->setCodepostal($adress->getCodePostale());
                $manager->persist($adresseHistorique);
            }
            $manager->persist($societe_historique);
            $manager->persist($societe);
            $manager->flush();
            return $this->redirectToRoute('societe_show', ['id' => $societe->getId()], Response::HTTP_SEE_OTHER);
        }
        return $this->renderForm('societe/edit.html.twig', [
            'societe' => $societe,
            'form_societe' => $form,
        ]);
    }

}
