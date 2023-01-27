<?php

namespace App\Controller;

use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class GoogleController extends AbstractController
{
    /**
     * @Route("/connect/google", name="google_connect")
     * @param ClientRegistry $clientRegistry
     * @return Response
     */
    public function connection_google(ClientRegistry $clientRegistry)
    {
        return $clientRegistry->getClient('google')->redirect([],['profile', 'email']);
    }

    /**
     * @Route("/connect/google/check", name="google_check")
     * @param Request $request
     * @param ClientRegistry $clientRegistry
     */
    public function connectCheckAction(Request $request, ClientRegistry $clientRegistry)
    {
    }
}
