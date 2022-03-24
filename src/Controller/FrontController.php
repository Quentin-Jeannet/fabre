<?php

namespace App\Controller;

use App\Repository\ProgramsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontController extends AbstractController
{
    /**
     * @Route("/", name="app_front")
     */
    public function index(): Response
    {
        return $this->render('front/index.html.twig', [
            'controller_name' => 'FrontController',
        ]);
    }
    /**
     * @Route("/remote", name="app_remote")
     */
    public function remote(): Response
    {
        return $this->render('front/remote.html.twig', [
            'controller_name' => 'FrontController',
        ]);
    }
    /**
     * @Route("/face-to-face", name="app_face")
     */
    public function faceToFace(ProgramsRepository $programsRepository): Response
    {
        $program = $programsRepository->findOneBy(["name" => "On-site program"]);
        return $this->render('front/face-to-face.html.twig', [
            'program' => $program,
        ]);
    }
    /**
     * @Route("/contact", name="app_contact")
     */
    public function contact(): Response
    {
        return $this->render('front/contact.html.twig', [
            'controller_name' => 'FrontController',
        ]);
    }
}
