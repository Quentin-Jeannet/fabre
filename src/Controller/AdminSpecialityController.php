<?php

namespace App\Controller;

use App\Entity\Speciality;
use App\Form\SpecialityType;
use App\Repository\SpecialityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/speciality")
 */
class AdminSpecialityController extends AbstractController
{
    /**
     * @Route("/", name="app_admin_speciality_index", methods={"GET"})
     */
    public function index(SpecialityRepository $specialityRepository): Response
    {
        return $this->render('admin_speciality/index.html.twig', [
            'specialities' => $specialityRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_admin_speciality_new", methods={"GET", "POST"})
     */
    public function new(Request $request, SpecialityRepository $specialityRepository): Response
    {
        $speciality = new Speciality();
        $form = $this->createForm(SpecialityType::class, $speciality);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $specialityRepository->add($speciality);
            return $this->redirectToRoute('app_admin_speciality_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_speciality/new.html.twig', [
            'speciality' => $speciality,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_admin_speciality_show", methods={"GET"})
     */
    public function show(Speciality $speciality): Response
    {
        return $this->render('admin_speciality/show.html.twig', [
            'speciality' => $speciality,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_admin_speciality_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Speciality $speciality, SpecialityRepository $specialityRepository): Response
    {
        $form = $this->createForm(SpecialityType::class, $speciality);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $specialityRepository->add($speciality);
            return $this->redirectToRoute('app_admin_speciality_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_speciality/edit.html.twig', [
            'speciality' => $speciality,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_admin_speciality_delete", methods={"POST"})
     */
    public function delete(Request $request, Speciality $speciality, SpecialityRepository $specialityRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$speciality->getId(), $request->request->get('_token'))) {
            $specialityRepository->remove($speciality);
        }

        return $this->redirectToRoute('app_admin_speciality_index', [], Response::HTTP_SEE_OTHER);
    }
}
