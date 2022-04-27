<?php

namespace App\Controller;

use App\Repository\EntryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PhoneBookController extends AbstractController
{

    #[Route('/')]
    public function index(EntryRepository $repository): Response
    {
        $items = $repository->getAll();

        return $this->render('index.html.twig', [
            'items' => $items,
        ]);
    }
}
