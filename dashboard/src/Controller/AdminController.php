<?php

namespace App\Controller;

use App\Repository\UsersRepository;
use http\Client\Curl\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="administration")
     * @param UsersRepository $usersRepository
     * @return Response
     */
    public function index(UsersRepository $usersRepository): Response
    {
        $users = $usersRepository->findAll();
        return $this->render('admin/login.html.twig', [
            'users' => $users
        ]);
    }

    /**
     * @Route("/manage_user/{id}/admin", name="manage_user")
     * @param $id
     * @param UsersRepository $usersRepository
     * @return Response
     */
    public function manage_user($id, UsersRepository $usersRepository): Response
    {
        $user = $usersRepository->find($id);
        return $this->render('admin/manage_user.html.twig', [
            'user' => $user
        ]);
    }

    /**
     * @Route("/delete_user/{id}/admin", name="delete_user")
     * @param $id
     * @param UsersRepository $usersRepository
     * @return RedirectResponse
     */
    public function delete_user($id, UsersRepository $usersRepository)
    {
        $user = $usersRepository->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();
        return $this->redirectToRoute('administration');
    }
}
