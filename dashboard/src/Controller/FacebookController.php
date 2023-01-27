<?php

namespace App\Controller;

use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class FacebookController extends AbstractController
{
    /**
     * @Route("/connect/facebook", name="facebook_connect")
     * @param ClientRegistry $clientRegistry
     * @return RedirectResponse
     */
    public function connection_facebook(ClientRegistry $clientRegistry)
    {
        return $clientRegistry->getClient('facebook_main')->redirect([],['public_profile', 'email']);
    }

    /**
     * @Route("/connect/facebook/check", name="facebook_check")
     * @param Request $request
     * @param ClientRegistry $clientRegistry
     */
    public function connectCheckAction(Request $request, ClientRegistry $clientRegistry)
    {
    }
}