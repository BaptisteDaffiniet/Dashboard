<?php

namespace App\Controller;

use App\Entity\Users;
use App\Repository\UsersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\User;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user")
     */
    public function index(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    /**
     * @Route("/user/create", name="create_user")
     * @param ValidatorInterface $validator
     * @return Response
     */
    public function create_user(ValidatorInterface $validator): Response
    {
        $usermanager = $this->getDoctrine()->getManager();

        $user = new Users();
        $user->setUsername("Neil");
        $user->setMail("cauetneil@gmail.com");
        $user->setPassword(MD5("123456"));
        $user->setRole(["ROLE_USER"]);

        $errors = $validator->validate($user);
        if (count($errors) != 0) {
            return new Response("error when creating user.", 400);
        } else {
            $usermanager->persist($user);
            $usermanager->flush();
            return new Response("new user created. Id of the new user is " . $user->getId(), 200);
        }
    }

    /**
     * @Route("/user/{id}", name="get_current_user")
     * @param $id
     * @param UsersRepository $usersRepository
     * @return Response
     */
    public function show_current_account($id, UsersRepository $usersRepository): Response
    {
        $current_user = $usersRepository->find($id);
        if (!$current_user) {
            return new Response("cannot find user with id " . $id, 400);
        }

        return new Response("user is " . $current_user->getUsername());
    }
}
