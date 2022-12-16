<?php

namespace App\Controller;

use App\Entity\Microphone;
use App\Repository\MicrophoneRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/microphone', name: 'app_microphone_')]
class MicrophoneController extends AbstractController
{
    #[Route(path: "/get", name: "get")]
    public function get(MicrophoneRepository $microphoneRepository)
    {
        return $this->json($microphoneRepository->findAll());
    }
}
