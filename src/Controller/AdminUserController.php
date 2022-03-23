<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Form\AdminUserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * @Route("/admin/user")
 */
class AdminUserController extends AbstractController
{
    /**
     * @Route("/", name="app_user_index", methods={"GET"})
     */
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('admin_user/index.html.twig', [
            'users' => $userRepository->getByRoleUser(),
            'type'=>'user',
        ]);
    }

    /**
     * @Route("/admin", name="app_admin_index", methods={"GET"})
     */
    public function indexAdmin(UserRepository $userRepository): Response
    {
        return $this->render('admin_user/index.html.twig', [
            'users' => $userRepository->getByRoleAdmin(),
            'type'=>'admin',
        ]);
    }

    /**
     * @Route("/new", name="app_user_new", methods={"GET", "POST"})
     */
    public function new(Request $request, UserRepository $userRepository, EntityManagerInterface $entityManagerInterface, UserPasswordHasherInterface $userPasswordHasherInterface): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // dd($user->getSpeciality());
            $roles = ["ROLE_USER"];
            array_push($roles, strtoupper($user->getSpeciality()));
            $user->setRoles($roles);
            $password = $user->getPassword();
            $user->setPassword($userPasswordHasherInterface->hashPassword($user, $password));
            $entityManagerInterface->persist($user);
            $entityManagerInterface->flush();
            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_user/new.html.twig', [
            'user' => $user,
            'form' => $form,
            'type' => 'user'
        ]);
    }

    /**
     * @Route("/admin/new", name="app_admin_new", methods={"GET", "POST"})
     */
    public function newAdmin(Request $request, UserRepository $userRepository, EntityManagerInterface $entityManagerInterface, UserPasswordHasherInterface $userPasswordHasherInterface): Response
    {
        $user = new User();
        $form = $this->createForm(AdminUserType::class, $user);
        $form->handleRequest($request);
        // dd($form->isValid());
        if ($form->isSubmitted() && $form->isValid()) {
            $user->setRoles(["ROLE_USER", "ROLE_ADMIN"]);
            $password = $user->getPassword();
            $user->setPassword($userPasswordHasherInterface->hashPassword($user, $password));
            $entityManagerInterface->persist($user);
            $entityManagerInterface->flush();
            return $this->redirectToRoute('app_admin_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_user/new.html.twig', [
            'user' => $user,
            'form' => $form,
            'type' => 'admin'
        ]);
    }

    /**
     * @Route("/{type}/{id}", name="app_admin_user_show", methods={"GET"})
     */
    public function show(string $type, User $user): Response
    {
        return $this->render('admin_user/show.html.twig', [
            'user' => $user,
            'type' => $type,
        ]);
    }

    /**
     * @Route("/{type}/{id}/edit", name="app_admin_edit", methods={"GET", "POST"})
     * @Route("/{type}/{id}/edit", name="app_user_edit", methods={"GET", "POST"})
     */
    public function editAdmin(Request $request, User $user, UserRepository $userRepository, string $type): Response
    {
        $form = $this->createForm(AdminUserType::class, $user);
        if($type=="user"){
            $form = $this->createForm(UserType::class, $user);
        }
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->add($user, true);
            if($type=="admin"){
                return $this->redirectToRoute('app_admin_index', [], Response::HTTP_SEE_OTHER);
            }else{
                return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
            }
        }
        return $this->renderForm('admin_user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
            'type' => $type
        ]);
    }

    /**
     * @Route("/{id}", name="app_admin_user_delete", methods={"POST"})
     */
    public function delete(Request $request, User $user, UserRepository $userRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $userRepository->remove($user);
        }

        return $this->redirectToRoute('app_admin_user_index', [], Response::HTTP_SEE_OTHER);
    }
}
