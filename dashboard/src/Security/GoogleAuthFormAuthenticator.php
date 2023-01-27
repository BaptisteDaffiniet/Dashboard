<?php

namespace App\Security;

use App\Entity\Users;
use Doctrine\ORM\EntityManagerInterface;
use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use KnpU\OAuth2ClientBundle\Client\OAuth2ClientInterface;
use KnpU\OAuth2ClientBundle\Security\Authenticator\SocialAuthenticator;
use League\OAuth2\Client\Provider\GoogleUser;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class GoogleAuthFormAuthenticator extends SocialAuthenticator
{
    private $clientRegistry;
    private $em;
    private $router;
    private $encodepassword;

    /**
     * GoogleAuthFormAuthenticator constructor.
     * @param ClientRegistry $clientRegistry
     * @param EntityManagerInterface $em
     * @param RouterInterface $router
     * @param UserPasswordEncoderInterface $encodepassword
     */
    public function __construct(ClientRegistry $clientRegistry, EntityManagerInterface $em, RouterInterface $router, UserPasswordEncoderInterface $encodepassword)
    {
        $this->clientRegistry = $clientRegistry;
        $this->em = $em;
        $this->router = $router;
        $this->encodepassword = $encodepassword;
    }

    public function supports(Request $request)
    {
        return $request->attributes->get('_route') === 'google_check';
    }

    public function getCredentials(Request $request)
    {
        return $this->fetchAccessToken($this->getGoogleClient());
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        /** @var GoogleUser $googleUser */
        $googleUser = $this->getGoogleClient()
            ->fetchUserFromToken($credentials);

        $existingUser = $this->em->getRepository(Users::class)
            ->findOneBy(['google_token' => $googleUser->getId(), 'google_auth' => true]);
        if ($existingUser) {
            return $existingUser;
        }

        $user = new Users();
        $user->setGoogle_token($googleUser->getId());
        $user->setUsername($googleUser->getName());
        $user->setPassword($this->encodepassword->encodePassword($user, 'nothing'));
        $user->setRole(['ROLE_USER']);
        $user->setMail($googleUser->getEmail());
        $user->setFacebook_auth(false);
        $user->setGoogle_auth(true);
        $user->setCheckToken(null);
        $user->setEnabled(true);
        $this->em->persist($user);
        $this->em->flush();

        return $user;
    }

    /**
     * @return OAuth2ClientInterface
     */
    private function getGoogleClient()
    {
        return $this->clientRegistry->getClient('google');
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        $targetUrl = $this->router->generate('widgets');

        return new RedirectResponse($targetUrl);
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        $message = strtr($exception->getMessageKey(), $exception->getMessageData());

        return new Response($message, Response::HTTP_FORBIDDEN);
    }

    /**
     * @param Request $request
     * @param AuthenticationException|null $authException
     * @return RedirectResponse
     */
    public function start(Request $request, AuthenticationException $authException = null)
    {
        return new RedirectResponse(
            '/login', // might be the site, where users choose their oauth provider
            Response::HTTP_TEMPORARY_REDIRECT
        );
    }
}
