<?php

namespace App\Controller;

use App\Repository\ContactRepository;
use App\Repository\HomeRepository;
use App\Repository\ProgramsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontController extends AbstractController
{
    /**
     * @Route("/", name="app_front")
     */
    public function index(HomeRepository $homeRepository): Response
    {
        $home = $homeRepository->findOneBy(["isActive"=>true]);
        return $this->render('front/index.html.twig', [
            'home' => $home,
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
    public function contact(ContactRepository $contactRepository): Response
    {
        $contact = $contactRepository->findOneBy(["isActive"=>true]);
        return $this->render('front/contact.html.twig', [
            'contact' => $contact,
        ]);
    }
}
