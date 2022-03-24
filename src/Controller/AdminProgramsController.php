<?php

namespace App\Controller;

use App\Entity\Programs;
use App\Form\ProgramsType;
use App\Repository\ProgramsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/programs")
 */
class AdminProgramsController extends AbstractController
{
    /**
     * @Route("/", name="app_admin_programs_index", methods={"GET"})
     */
    public function index(ProgramsRepository $programsRepository): Response
    {
        return $this->render('admin_programs/index.html.twig', [
            'programs' => $programsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_admin_programs_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ProgramsRepository $programsRepository): Response
    {
        $program = new Programs();
        $form = $this->createForm(ProgramsType::class, $program);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $programsRepository->add($program);
            return $this->redirectToRoute('app_admin_programs_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_programs/new.html.twig', [
            'program' => $program,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_admin_programs_show", methods={"GET"})
     */
    public function show(Programs $program): Response
    {
        return $this->render('admin_programs/show.html.twig', [
            'program' => $program,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_admin_programs_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Programs $program, ProgramsRepository $programsRepository): Response
    {
        $form = $this->createForm(ProgramsType::class, $program);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $programsRepository->add($program);
            return $this->redirectToRoute('app_admin_programs_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_programs/edit.html.twig', [
            'program' => $program,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_admin_programs_delete", methods={"POST"})
     */
    public function delete(Request $request, Programs $program, ProgramsRepository $programsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$program->getId(), $request->request->get('_token'))) {
            $programsRepository->remove($program);
        }

        return $this->redirectToRoute('app_admin_programs_index', [], Response::HTTP_SEE_OTHER);
    }
}
