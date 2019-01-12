<?php

namespace App\Controller;

use App\Entity\Commentary;
use App\Form\CommentaryType;
use App\Repository\CommentaryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/commentary")
 */
class CommentaryController extends AbstractController
{
    /**
     * @Route("/", name="commentary_index", methods={"GET"})
     */
    public function index(CommentaryRepository $commentaryRepository): Response
    {
        return $this->render('commentary/index.html.twig', ['commentaries' => $commentaryRepository->findAll()]);
    }

    /**
     * @Route("/new", name="commentary_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $commentary = new Commentary();
        $form = $this->createForm(CommentaryType::class, $commentary);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($commentary);
            $entityManager->flush();

            return $this->redirectToRoute('commentary_index');
        }

        return $this->render('commentary/new.html.twig', [
            'commentary' => $commentary,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="commentary_show", methods={"GET"})
     */
    public function show(Commentary $commentary): Response
    {
        return $this->render('commentary/show.html.twig', ['commentary' => $commentary]);
    }

    /**
     * @Route("/{id}/edit", name="commentary_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Commentary $commentary): Response
    {
        $form = $this->createForm(CommentaryType::class, $commentary);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('commentary_index', ['id' => $commentary->getId()]);
        }

        return $this->render('commentary/edit.html.twig', [
            'commentary' => $commentary,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="commentary_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Commentary $commentary): Response
    {
        if ($this->isCsrfTokenValid('delete'.$commentary->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($commentary);
            $entityManager->flush();
        }

        return $this->redirectToRoute('commentary_index');
    }
}
