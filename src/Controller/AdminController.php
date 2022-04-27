<?php

namespace App\Controller;

use App\Entity\Entry;
use App\Repository\EntryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{

    #[Route('/admin/add')]
    public function add(Request $request, EntryRepository $repository): Response
    {
        $entry = new Entry();
        $form = $this->createFormBuilder($entry)
            ->add('first_name', TextType::class, ['label' => 'Imię', 'required' => false])
            ->add('last_name', TextType::class, ['label' => 'Nazwisko', 'required' => false])
            ->add('name', TextType::class, ['label' => 'Nazwa', 'required' => false])
            ->add('number_1', TextType::class, ['label' => 'Numer 1'])
            ->add('number_2', TextType::class, ['label' => 'Numer 2', 'required' => false])
            ->add('additional', TextType::class, ['label' => 'Informacje dodatkowe', 'required' => false])
            ->add('save', SubmitType::class, ['label' => 'Dodaj numer'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entry = $form->getData();
            $repository->add($entry);

            return $this->redirectToRoute('app_phonebook_index');
        }

        return $this->renderForm('admin/add.html.twig', [
            'form' => $form,
        ]);
    }
}
