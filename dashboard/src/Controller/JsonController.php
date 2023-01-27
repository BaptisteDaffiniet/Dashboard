<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JsonController extends AbstractController
{
    /**
     * @Route("/about.json", name="aboutjson")
     * @return JsonResponse
     */
    public function index(): Response
    {
        return new JsonResponse(
            array(
                "customer" => array(
                    "host" => $_SERVER['REMOTE_ADDR']
                ),
                "server" => array(
                    "current_time" => strtotime(date('d M Y h:i:s')),
                    "services" => array(
                        array(
                            "name" => "weather",
                            "widgets" => array(
                                array(
                                    "name" => "city informations",
                                    "description" => "affiche des informations sur la ville concernant la météo",
                                    "params" => array(
                                        array(
                                            "name" => "town",
                                            "type" => "string"
                                        ),
                                        array(
                                            "name" => "timer",
                                            "type" => "integer"
                                        )
                                    )
                                ),
                            ),
                        ),
                        array(
                            "name" => "steam",
                            "widgets" => array(
                                array(
                                    "name" => "steamappnews",
                                    "description" => "affiche la dernière news d'un jeu vidéo",
                                    "params" => array(
                                        array(
                                            "name" => "gameid",
                                            "type" => "string"
                                        ),
                                        array(
                                            "name" => "timer",
                                            "type" => "integer"
                                        )
                                    ),
                                ),
                                array(
                                    "name" => "steamprofile",
                                    "description" => "affiche les informations d'un profile steam",
                                    "params" => array(
                                        array(
                                            "name" => "profileid",
                                            "type" => "string"
                                        ),
                                        array(
                                            "name" => "timer",
                                            "type" => "integer"
                                        )
                                    ),
                                ),
                                array(
                                    "name" => "steamrecentgames",
                                    "description" => "affiche le jeu joué sur les 2 dernières semaines par la personne ayant renseigné son steamID",
                                    "params" => array(
                                        array(
                                            "name" => "profileid",
                                            "type" => "string"
                                        ),
                                        array(
                                            "name" => "timer",
                                            "type" => "integer"
                                        )
                                    )
                                )
                            ),
                        ),
                        array(
                            "name" => "devise conversion",
                            "widgets" => array(
                                array(
                                    "name" => "devise conversion",
                                    "description" => "permet d'avoir le montant converti entre une devise A et une devise B",
                                    "params" => array(
                                        array(
                                            "name" => "devise target",
                                            "type" => "string"
                                        ),
                                        array(
                                            "name" => "devise_format",
                                            "type" => "string"
                                        ),
                                        array(
                                            "name" => "quantity",
                                            "type" => "string"
                                        ),
                                        array(
                                            "name" => "timer",
                                            "type" => "integer"
                                        )
                                    ),
                                ),
                            )
                        ),
                        array(
                            "name" => "youtube video",
                            "widgets" => array(
                                "name" => "youtube videos",
                                "description" => "permet d'avoir des informations sur des vidéos youtube",
                                "params" => array(
                                    array(
                                        "name" => "video_id",
                                        "type" => "string"
                                    ),
                                    array(
                                        "name" => "timer",
                                        "type" => "integer"
                                    ),
                                ),
                            ),
                        ),
                    ),
                ),
            ), 200);
    }
}
