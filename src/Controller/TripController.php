<?php

namespace App\Controller;

use App\Repository\TripRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;



/**
 * Route permettant l'accèes à l'affichage de plusieurs trips
 */
class TripController extends AbstractController
{
    #[Route('/trips', name: 'app_trips', methods: ['GET'])]
    public function index(TripRepository $tr): Response
    {
        return $this->render('trip/index.html.twig', [
            'trips' => $tr->findBy(
                [],
                ['id' => 'ASC'],
                10
            ), // Récupère toute les trips
            'title' => 'Trips',
            'description' => 'Les trips disponilbes sur la plateforme. 100% made by you !'
        ]);
    }


    /**
     * Route permettant l'accèes à l'affichage d'un Trip seul
     */
    #[Route('/trip/{ref}', name: 'app_trip', methods: ['GET'])]
    public function show(TripRepository $tr, string $ref): Response
    {
        $trip = $tr->findOneBy(
            ['ref' => $ref],
        );
        return $this->render('trip/show.html.twig', [
            'trip' => $trip,
            'title' => $trip->getTitle(),
            'description' => $trip->getDescription() ?? $trip->getTitle()
        ]);
    }
}
