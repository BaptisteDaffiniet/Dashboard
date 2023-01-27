<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\UsersType;
use App\Repository\UsersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterController extends AbstractController
{

    private $encodepassword;

    public function __construct(UserPasswordEncoderInterface $encodepassword)
    {
        $this->encodepassword = $encodepassword;
    }

    /**
     * @Route("/register", name="register")
     * @param Request $request
     * @param UsersRepository $usersRepository
     * @param MailController $mailController
     * @return RedirectResponse|Response
     * @throws \Exception
     */
    public function index(Request $request, UsersRepository $usersRepository, MailController $mailController)
    {
        $user = new Users();

        $form = $this->createForm(UsersType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $check_user = $usersRepository->findOneBy(['username' => $user->getUsername()]);
            if ($check_user != null) {
                $error = new FormError("username already exist");
                $form->get('username')->addError($error);
            }
            if ($form->isValid()) {
                $user->setPassword($this->encodepassword->encodePassword($user, $user->getPassword()));

                $user->setCheckToken($this->createchecktoken());
                $user->setEnabled(false);
                $user->setRole(['ROLE_USER']);
                $user->setFacebook_auth(false);
                $user->setGoogle_auth(false);

                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();

                //ajouter ici la partie avec l'email
                $token = $user->getCheckToken();
                $username = $user->getUsername();
                $email = $user->getMail();
                $mailController->send_mail($token, $username, $email);

                return $this->redirectToRoute('register_confirmation');
            }
        }
        return $this->render('register/login.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function createchecktoken()
    {
        return rtrim(strtr(base64_encode(random_bytes(32)), '+/', '-_'), '=');
    }

    /**
     * @Route ("/register/confirmation/{token}/{username}", name="check_register")
     * @param $token
     * @param $username
     * @param UsersRepository $usersRepository
     * @return RedirectResponse
     */
    public function check_register($token, $username, UsersRepository $usersRepository)
    {
        $user = $usersRepository->findOneBy(['username' => $username]);
        if ($user != null) {
            $access_token = $user->getCheckToken();
            if ($token === $access_token) {
                $user->setCheckToken(null);
                $user->setEnabled(true);

                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();

                return $this->redirectToRoute('landing');
            }
        }
        return $this->redirectToRoute('register');
    }

    /**
     * @Route ("/register/confirmation", name="register_confirmation")
     */
    public function confirm_register()
    {
        return $this->render('register/confirm_email.html.twig');
    }
}
