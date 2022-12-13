<?php

namespace App\Controller;

use App\Repository\MicrophoneRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(MicrophoneRepository $microphoneRepository): Response
    {
        return $this->render('default/index.html.twig', [
            'microphones' => $microphoneRepository->findAll(),
        ]);
    }
}
