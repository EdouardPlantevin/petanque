<?php

namespace App\Controller;

use App\Entity\Message;
use App\Form\MessageType;
use App\Repository\MessageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChatController extends AbstractController
{
    #[Route('/chat', name: 'app_chat')]
    public function index(
        Request $request,
        EntityManagerInterface $manager,
        MessageRepository $messageRepository
    ): Response
    {
        $message = new Message();
        $formChat = $this->createForm(MessageType::class, $message);

        $emptyForm = clone $formChat; // to reset input after submit

        $formChat->handleRequest($request);

        if ($formChat->isSubmitted() && $formChat->isValid()) {
            $manager->persist($message);
            $manager->flush();
            $formChat = $emptyForm;
        }

        return $this->render('chat/index.html.twig', [
            'formChat' => $formChat,
            'messages' => $messageRepository->findBy([], ['createAt' => 'DESC'], 10)
        ]);
    }
}