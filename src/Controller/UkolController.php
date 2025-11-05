<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Ukol;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\UkolRepository;
use App\Form\UkolType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

final class UkolController extends AbstractController
{

    // metoda, která vykresluje úvodní stránku se seznamem všech úkolů načtených z databáze

    #[Route('/', name: 'ukoly')]
    public function zobrazUkoly(UkolRepository $repositar): Response
    {
        /*
        $ukoly = $repositar->findBy(
            ['dokonceno' => false]
        );
        */

        $ukoly = $repositar->findAll();

        return $this->render('ukol/ukoly.html.twig', [
            'ukoly' => $ukoly,
        ]);
    }

    // metoda, která vykresluje stránku s formulářem pro vytváření nového úkolu v databázi

    #[Route('ukol/novy', name: 'ukol_novy')]
    public function novyUkol(Request $request, EntityManagerInterface $entityManager): Response
    {
        $ukol = new Ukol();
        $formular = $this->createForm(UkolType::class, $ukol);

        $formular->handleRequest($request);

        if ($formular->isSubmitted() && $formular->isValid()) {

            $entityManager->persist($ukol);
            $entityManager->flush();

            $this->addFlash('zprava', "Úkol '{$ukol->getNazev()}' byl přidán");

            return $this->redirectToRoute('ukoly');
        }

        return $this->render('ukol/novy.html.twig', [
            'formular' => $formular
        ]);
    }

    // metoda, která vykresluje stránku s formulářem pro editaci zvoleného úkolu

    #[Route('ukol/upravit/{id<\d+>}', name: 'ukol_upravit')]
    public function upravitUkol(Ukol $ukol, Request $request, EntityManagerInterface $entityManager): Response
    {
        $formular = $this->createForm(UkolType::class, $ukol);

        $formular->handleRequest($request);

        if ($formular->isSubmitted() && $formular->isValid()) {

            $entityManager->flush();

            $this->addFlash('zprava', "Úkol '{$ukol->getNazev()}' byl úspěšně upraven");

            return $this->redirectToRoute('ukoly');
        }

        return $this->render('ukol/upravit.html.twig', [
            'formular' => $formular
        ]);
    }

    // a konečně metoda která maže konkrétní úkol z databáze.

    #[Route('ukol/smazat/{id<\d+>}', name: 'ukol_smazat')]
    public function smazatUkol(Ukol $ukol, UkolRepository $repositar, EntityManagerInterface $entityManager, int $id): Response
    {
        $ukolKeSmazani = $repositar->find($id);

        $jmenoUkolu = $ukol->getNazev();

        $entityManager->remove($ukolKeSmazani);
        $entityManager->flush();

        $this->addFlash('zprava', "Úkol '{$jmenoUkolu}' byl úspěšně smazán");

        return $this->redirectToRoute('ukoly');
    }


    // Tyto poslední 4 metody slouží pro filtrování úkolů - dle jména nebo dle statusu hotovo/nutno udělat

    #[Route('/jmeno_asc', name: 'ukoly_dle_jmena_asc')]
    public function jmenoVzestupne(UkolRepository $repositar): Response
    {
        $ukoly = $repositar->findBy(
            [],
            ['nazev' => 'ASC']
        );

        return $this->render('ukol/ukoly.html.twig', [
            'ukoly' => $ukoly,
        ]);
    }

    #[Route('/jmeno_desc', name: 'ukoly_dle_jmena_desc')]
    public function jmenoSestupne(UkolRepository $repositar): Response
    {
        $ukoly = $repositar->findBy(
            [],
            ['nazev' => 'DESC']
        );

        return $this->render('ukol/ukoly.html.twig', [
            'ukoly' => $ukoly,
        ]);
    }

    #[Route('/hotove_ukoly', name: 'ukoly_hotove')]
    public function ukolyHotove(UkolRepository $repositar): Response
    {
        $ukoly = $repositar->findBy(
            ['dokonceno' => true]
        );

        return $this->render('ukol/ukoly.html.twig', [
            'ukoly' => $ukoly,
        ]);
    }

    #[Route('/cekajici_ukoly', name: 'ukoly_cekajici')]
    public function cekajiciHotove(UkolRepository $repositar): Response
    {
        $ukoly = $repositar->findBy(
            ['dokonceno' => false]
        );

        return $this->render('ukol/ukoly.html.twig', [
            'ukoly' => $ukoly,
        ]);
    }
}
