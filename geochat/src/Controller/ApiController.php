<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\MessageRepository;

#[Route('/api')]
class ApiController extends AbstractController
{
    #[Route('/api', name: 'app_api')]
    public function index(): Response
    {
        return $this->render('api/index.html.twig', [
            'controller_name' => 'ApiController',
        ]);
    }

    #[Route('/message', name: 'app_message_index', methods: ['GET'])]
    public function messages(MessageRepository $messageRepository): Response
    {
        return $this->json($messageRepository->findAll(), 200, [], ['groups' => 'message:read']);
    }
}
