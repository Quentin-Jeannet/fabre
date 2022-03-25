<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminDashboardController extends AbstractController
{
    /**
     * @Route("/admin", name="app_admin")
     * @Route("/admin/dashboard", name="app_admin_dashboard")
     */
    public function index(UserRepository $userRepository): Response
    {
        //
        $physicians = $userRepository->getByRole("ROLE_PHYSICIAN");
        $dataManagers = $userRepository->getByRole("ROLE_DATA_MANAGER");
        //
        return $this->render('admin_dashboard/index.html.twig', [
            'physicians' => count($physicians),
            'dataManagers'=> count($dataManagers)
        ]);
    }
}
