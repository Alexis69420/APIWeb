<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\MessageRepository;
use FOS\RestBundle\Controller\Annotations\View;

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

    #[View()]
    #[Route('/message', name: 'app_message_index', methods: ['GET'])]
    public function messages(MessageRepository $messageRepository)
    {
        return [
            "messages" => $messageRepository->findAll()
        ];
    }
}
