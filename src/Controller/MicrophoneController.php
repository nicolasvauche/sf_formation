<?php

namespace App\Controller;

use App\Repository\MicrophoneRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/microphone', name: 'app_microphone_')]
class MicrophoneController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('microphone/index.html.twig');
    }

    #[Route('/ajax', name: 'ajax')]
    public function ajax(MicrophoneRepository $microphoneRepository): Response
    {
        return $this->json($microphoneRepository->findAll(), 200);
    }
}
