<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\MessageRepository;
use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api')]
class ApiController extends AbstractController
{
    #[Route('/', name: 'app_api')]
    public function index(): Response
    {
        return $this->render('api/index.html.twig', [
            'controller_name' => 'ApiController',
        ]);
    }

    #[View(serializerGroups: ["message-basic"])]
    #[Route('/messages', name: 'app_message_index', methods: ['GET'])]
    public function messages(MessageRepository $messageRepository, String $address, int $radius)
    {
        if($address==null){
            return null;
        }
        if($radius==null){
            $radius = 2;
        }
        return $messageRepository->findAll();
    }

    public function serialize(SerializerInterface $serializer, MessageRepository $messageRepository): Response
    {
        $messages = $messageRepository->findAll();
        $data = $serializer->serialize($messages, 'json', [
            'circular_reference_handler' => function ($object) {
                return $object->getId();
            },
            'ignored_attributes' => ['user']
        ]);
        return new Response($data, 200, [
            'Content-Type' => 'application/json'
        ]);
    }

}
