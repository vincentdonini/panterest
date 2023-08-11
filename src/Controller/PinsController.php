<?php

namespace App\Controller;

use App\Entity\Pin;
use App\Repository\PinRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PinsController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function index(
        PinRepository $pinRepository
    ): Response
    {
        $pins = $pinRepository->findAll();

        return $this->render('pins/index.html.twig', [
            'pins' => $pins,
        ]);
    }

    /**
     * @Route("/pins/{id}", name="app_pins_details")
     */
    public function details(
        PinRepository $pinRepository,
        Pin $pin
    ): Response
    {
        return $this->render('pins/details.html.twig', [
            'pin' => $pin,
        ]);
    }
}
