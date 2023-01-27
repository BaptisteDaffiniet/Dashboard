<?php

namespace App\Controller;

use App\Entity\DeviseConversion;
use App\Entity\SteamAppNews;
use App\Entity\SteamProfile;
use App\Entity\SteamRecentGames;
use App\Entity\Weather;
use App\Entity\YoutubeVideo;
use App\Form\DeviseConversionType;
use App\Form\SteamAppNewsType;
use App\Form\SteamProfileType;
use App\Form\SteamRecentGamesType;
use App\Form\WeatherType;
use App\Form\YoutubeVideoType;
use App\Repository\DeviseConversionRepository;
use App\Repository\SteamAppNewsRepository;
use App\Repository\SteamProfileRepository;
use App\Repository\SteamRecentGamesRepository;
use App\Repository\WeatherRepository;
use App\Repository\YoutubeVideoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class WidgetController extends AbstractController
{
    private $client;
    private $weatherapikey;
    private $steamapikey;
    private $conversionapikey;
    private $youtubekey;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->client = $httpClient;
        $this->weatherapikey = "8806ba7224b94d32fe13139ebb0f6645";
        $this->steamapikey = "83FA676A91B60DA610F1F23B2EE718C2";
        $this->conversionapikey = "6wpziaq1pjkdxd30m12a";
        $this->youtubekey = 'AIzaSyDJFEuC8QzWEdScuNrZjHW3C3eLgMz-EiY';
    }

    /**
     * @param $town
     * @return array
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     */
    public function callweatherapi($town)
    {
        $url = "https://api.openweathermap.org/data/2.5/weather?q=$town&appid=$this->weatherapikey&lang=fr&units=metric";
        try {
            $response = $this->client->request('GET', $url);
            return $response->toArray();
        } catch (TransportExceptionInterface $e) {
            return ["no data"];
        }
    }

    /**
     * @param $gameid
     * @return array
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     */
    public function callsteamappnewsapi($gameid)
    {
        $url = "http://api.steampowered.com/ISteamNews/GetNewsForApp/v0002/?appid=$gameid&count=1&maxlength=220&format=json";
        try {
            $response = $this->client->request('GET', $url);
            return $response->toArray();
        } catch (TransportExceptionInterface $e) {
            return ["no data"];
        }
    }

    /**
     * @param $gameid
     * @return string
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     */
    public function getsteamgamename($gameid)
    {
        $url = "http://api.steampowered.com/ISteamUserStats/GetSchemaForGame/v2/?key=$this->steamapikey&appid=$gameid";
        try {
            $response = $this->client->request('GET', $url);
            $tab = $response->toArray();
            return $tab["game"]["gameName"];
        } catch (TransportExceptionInterface $e) {
            return "undefined";
        }
    }

    /**
     * @param $profileid
     * @return array
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     */
    public function callsteamprofileapi($profileid)
    {
        $url = "http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=$this->steamapikey&steamids=$profileid";
        try {
            $response = $this->client->request('GET', $url);
            return $response->toArray();
        } catch (TransportExceptionInterface $e) {
            return ["no data"];
        }
    }

    /**
     * @param $profileid
     * @return array
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     */
    public function callsteamrecentgames($profileid)
    {
        $url = "http://api.steampowered.com/IPlayerService/GetRecentlyPlayedGames/v0001/?key=$this->steamapikey&steamid=$profileid&format=json&count=1";
        try {
            $response = $this->client->request('GET', $url);
            return $response->toArray();
        } catch (TransportExceptionInterface $e) {
            return ["no data"];
        }
    }

    /**
     * @param $target
     * @param $format
     * @return array|string[]
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     */
    public function calldeviseconversionapi($target, $format)
    {
        $url = "https://currencydatafeed.com/api/data.php?token=$this->conversionapikey&currency=$target/$format";
        try {
            $response = $this->client->request('GET', $url);
            return $response->toArray();
        } catch (TransportExceptionInterface $e) {
            return ["no data"];
        }
    }

    /**
     * @param $video_id
     * @return array|string[]
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     */
    public function callyoutubevideoapi($video_id)
    {
        $url = "https://www.googleapis.com/youtube/v3/videos?id=$video_id&key=$this->youtubekey&part=snippet,statistics";
        try {
            $response = $this->client->request('GET', $url);
            return $response->toArray();
        } catch (TransportExceptionInterface $e) {
            return ["no data"];
        }
    }

    /**
     * @Route("/widgets", name="widgets")
     * @param WeatherRepository $weatherRepository
     * @param SteamAppNewsRepository $steamAppNewsRepository
     * @param SteamProfileRepository $steamProfileRepository
     * @param SteamRecentGamesRepository $steamRecentGamesRepository
     * @param DeviseConversionRepository $deviseConversionRepository
     * @param YoutubeVideoRepository $youtubeVideoRepository
     * @return Response
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     */
    public function index(WeatherRepository $weatherRepository, SteamAppNewsRepository $steamAppNewsRepository, SteamProfileRepository $steamProfileRepository, SteamRecentGamesRepository $steamRecentGamesRepository, DeviseConversionRepository $deviseConversionRepository, YoutubeVideoRepository $youtubeVideoRepository): Response
    {
        $weather = $weatherRepository->findby(['user_id' => $this->getUser()->getId()]);
        $weathers = [];
        for ($a = 0; $a < sizeof($weather); $a++) {
            $weathers[$a] = ['town' => $weather[$a]->getTown(), 'service' => $weather[$a]->getServiceName(), 'id_widget' => $weather[$a]->getId(), 'timer' => $weather[$a]->getTimer()];
        }

        $steamappnew = $steamAppNewsRepository->findby(['user_id' => $this->getUser()->getId()]);
        $steamappnews = [];
        for ($a = 0; $a < sizeof($steamappnew); $a++) {
            $steamappnews[$a] = ['game_id' => $steamappnew[$a]->getGameId(), 'service' => $steamappnew[$a]->getServiceName(), 'id_widget' => $steamappnew[$a]->getId(), 'gamename' => $this->getsteamgamename($steamappnew[$a]->getGameId()), 'timer' => $steamappnew[$a]->getTimer()];
        }

        $steamprofile = $steamProfileRepository->findby(['user_id' => $this->getUser()->getId()]);
        $steamprofiles = [];
        for ($a = 0; $a < sizeof($steamprofile); $a++) {
            $steamprofiles[$a] = ['profile_id' => $steamprofile[$a]->getProfileId(), 'service' => $steamprofile[$a]->getServiceName(), 'id_widget' => $steamprofile[$a]->getId(), 'timer' => $steamprofile[$a]->getTimer()];
        }

        $steamrecentgame = $steamRecentGamesRepository->findby(['user_id' => $this->getUser()->getId()]);
        $steamrecentgames = [];
        for ($a = 0; $a < sizeof($steamrecentgame); $a++) {
            $steamrecentgames[$a] = ['profile_id' => $steamrecentgame[$a]->getProfileId(), 'service' => $steamrecentgame[$a]->getServiceName(), 'id_widget' => $steamrecentgame[$a]->getId(), 'timer' => $steamrecentgame[$a]->getTimer()];
        }

        $deviseconversion = $deviseConversionRepository->findBy(['user_id' => $this->getUser()->getId()]);
        $deviseconversions = [];
        for ($a = 0; $a < sizeof($deviseconversion); $a++) {
            $deviseconversions[$a] = ['devise_target' => $deviseconversion[$a]->getDeviseTarget(), 'devise_format' => $deviseconversion[$a]->getDeviseFormat(), 'quantity' => $deviseconversion[$a]->getQuantity(), 'service' => $deviseconversion[$a]->getServiceName(), 'id_widget' => $deviseconversion[$a]->getId(), 'timer' => $deviseconversion[$a]->getTimer()];
        }

        $youtubevideo = $youtubeVideoRepository->findBy(['user_id' => $this->getUser()->getId()]);
        $youtubevideos = [];
        for ($a = 0; $a < sizeof($youtubevideo); $a++) {
            $youtubevideos[$a] = ['video_id' => $youtubevideo[$a]->getVideoId(), 'service' => $youtubevideo[$a]->getServiceName(), 'id_widget' => $youtubevideo[$a]->getId(), 'timer' => $youtubevideo[$a]->getTimer()];
        }

        return $this->render('widget/login.html.twig', [
            'weathers' => $weathers,
            'steamappnews' => $steamappnews,
            'steamprofiles' => $steamprofiles,
            'steamrecentgames' => $steamrecentgames,
            'deviseconversion' => $deviseconversions,
            'youtubevideos' => $youtubevideos
        ]);
    }

    /**
     * @Route("/widgets/delete_weather_widgets/{id}", name="delete_weather_widget")
     * @param $id
     * @param WeatherRepository $weatherRepository
     * @return RedirectResponse
     */
    public function delete_weather_widget($id, WeatherRepository $weatherRepository)
    {
        $weather = $weatherRepository->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($weather);
        $em->flush();
        return $this->redirectToRoute('widgets');
    }

    /**
     * @Route("/widgets/delete_steamnews_widgets/{id}", name="delete_steamnews_widget")
     * @param $id
     * @param SteamAppNewsRepository $steamAppNewsRepository
     * @return RedirectResponse
     */
    public function delete_steamnews_widget($id, SteamAppNewsRepository $steamAppNewsRepository)
    {
        $weather = $steamAppNewsRepository->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($weather);
        $em->flush();
        return $this->redirectToRoute('widgets');
    }

    /**
     * @Route("/widgets/delete_steamprofile_widgets/{id}", name="delete_steamprofile_widget")
     * @param $id
     * @param SteamProfileRepository $steamProfileRepository
     * @return RedirectResponse
     */
    public function delete_steamprofile_widget($id, SteamProfileRepository $steamProfileRepository)
    {
        $weather = $steamProfileRepository->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($weather);
        $em->flush();
        return $this->redirectToRoute('widgets');
    }

    /**
     * @Route("/widgets/delete_steamrecentgames_widgets/{id}", name="delete_steamrecentgames_widget")
     * @param $id
     * @param SteamRecentGamesRepository $steamRecentGamesRepository
     * @return RedirectResponse
     */
    public function delete_steamrecentgames_widget($id, SteamRecentGamesRepository $steamRecentGamesRepository)
    {
        $weather = $steamRecentGamesRepository->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($weather);
        $em->flush();
        return $this->redirectToRoute('widgets');
    }

    /**
     * @Route("/widgets/delete_deviseconversion_widgets/{id}", name="delete_deviseconversion_widget")
     * @param $id
     * @param DeviseConversionRepository $deviseConversionRepository
     * @return RedirectResponse
     */
    public function delete_deviseconversion_widget($id, DeviseConversionRepository $deviseConversionRepository)
    {
        $weather = $deviseConversionRepository->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($weather);
        $em->flush();
        return $this->redirectToRoute('widgets');
    }

    /**
     * @Route("/widgets/delete_youtubevideo_widgets/{id}", name="delete_youtubevideo_widget")
     * @param $id
     * @param YoutubeVideoRepository $youtubeVideoRepository
     * @return RedirectResponse
     */
    public function delete_youtubevideo_widget($id, YoutubeVideoRepository $youtubeVideoRepository)
    {
        $weather = $youtubeVideoRepository->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($weather);
        $em->flush();
        return $this->redirectToRoute('widgets');
    }

    /**
     * @Route("/widgets/manage_widgets", name="manage_widgets")
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function manage_widgets(Request $request)
    {
        $widget_weather = new Weather();

        $steamappnews = new SteamAppNews();

        $steamprofile = new SteamProfile();

        $steamrecentgames = new SteamRecentGames();

        $deviseconversion = new DeviseConversion();

        $youtubevideo = new YoutubeVideo();

        $user = $this->getUser();
        $userid = $user->getId();

        $form_weather = $this->createForm(WeatherType::class, $widget_weather);
        $form_steamappnews = $this->createForm(SteamAppNewsType::class, $steamappnews);
        $form_steamprofile = $this->createForm(SteamProfileType::class, $steamprofile);
        $form_steamrecentgames = $this->createForm(SteamRecentGamesType::class, $steamrecentgames);
        $form_deviseconversion = $this->createForm(DeviseConversionType::class, $deviseconversion);
        $form_youtubevideo = $this->createForm(YoutubeVideoType::class, $youtubevideo);

        $form_weather->handleRequest($request);
        $form_steamappnews->handleRequest($request);
        $form_steamprofile->handleRequest($request);
        $form_steamrecentgames->handleRequest($request);
        $form_deviseconversion->handleRequest($request);
        $form_youtubevideo->handleRequest($request);

        if ($form_weather->isSubmitted()) {
            $formdata = $form_weather->getData();
            if ($formdata->getTimer() <= 0) {
                $error = new FormError("le timer doit être supérieur a 1 seconde");
                $form_weather->get('timer')->addError($error);
            }
            if ($form_weather->isValid()) {
                $widget_weather->setName("weather api");
                $widget_weather->setServiceName("meteo");
                $widget_weather->setUserId($userid);

                $em = $this->getDoctrine()->getManager();
                $em->persist($widget_weather);
                $em->flush();

                return $this->redirectToRoute('manage_widgets');
            }
        }

        if ($form_steamappnews->isSubmitted()) {
            $formdata = $form_steamappnews->getData();
            if ($formdata->getTimer() <= 0) {
                $error = new FormError("le timer doit être supérieur a 1 seconde");
                $form_steamappnews->get('timer')->addError($error);
            }
            if ($form_steamappnews->isValid()) {
                $steamappnews->setName('steam app news');
                $steamappnews->setServiceName('steam');
                $steamappnews->setUserId($userid);

                $em = $this->getDoctrine()->getManager();
                $em->persist($steamappnews);
                $em->flush();

                return $this->redirectToRoute('manage_widgets');
            }
        }

        if ($form_steamprofile->isSubmitted()) {
            $formdata = $form_steamprofile->getData();
            if ($formdata->getTimer() <= 0) {
                $error = new FormError("le timer doit être supérieur a 1 seconde");
                $form_steamprofile->get('timer')->addError($error);
            }
            if ($form_steamprofile->isValid()) {
                $steamprofile->setName('steam profile');
                $steamprofile->setServiceName('steam');
                $steamprofile->setUserId($userid);

                $em = $this->getDoctrine()->getManager();
                $em->persist($steamprofile);
                $em->flush();

                return $this->redirectToRoute('manage_widgets');
            }
        }

        if ($form_steamrecentgames->isSubmitted()) {
            $formdata = $form_steamrecentgames->getData();
            if ($formdata->getTimer() <= 0) {
                $error = new FormError("le timer doit être supérieur a 1 seconde");
                $form_steamrecentgames->get('timer')->addError($error);
            }
            if ($form_steamrecentgames->isValid()) {
                $steamrecentgames->setGamenumber(1);
                $steamrecentgames->setName('steam recents games');
                $steamrecentgames->setServiceName('steam');
                $steamrecentgames->setUserId($userid);

                $em = $this->getDoctrine()->getManager();
                $em->persist($steamrecentgames);
                $em->flush();

                return $this->redirectToRoute('manage_widgets');
            }
        }

        if ($form_deviseconversion->isSubmitted()) {
            $formdata = $form_deviseconversion->getData();
            if ($formdata->getTimer() <= 0) {
                $error = new FormError("le timer doit être supérieur à 1 seconde");
                $form_deviseconversion->get('timer')->addError($error);
            }
            if ($formdata->getQuantity() <= 0) {
                $error = new FormError("la quantité doit être supérieur à 0");
                $form_deviseconversion->get('quantity')->addError($error);
            }
            if ($form_deviseconversion->isValid()) {
                $deviseconversion->setServiceName('devise conversion');
                $deviseconversion->setUserId($userid);
                $deviseconversion->setName('devise conversion');

                $em = $this->getDoctrine()->getManager();
                $em->persist($deviseconversion);
                $em->flush();

                return $this->redirectToRoute('manage_widgets');
            }
        }

        if ($form_youtubevideo->isSubmitted()) {
            $formdata = $form_youtubevideo->getData();
            if ($formdata->getTimer() <= 0) {
                $error = new FormError("le timer doit être supérieur à 1 seconde");
                $form_youtubevideo->get('timer')->addError($error);
            }
            if ($form_youtubevideo->isValid()) {
                $youtubevideo->setServiceName("youtube video");
                $youtubevideo->setName("youtube video");
                $youtubevideo->setUserId($userid);

                $em = $this->getDoctrine()->getManager();
                $em->persist($youtubevideo);
                $em->flush();

                return $this->redirectToRoute('manage_widgets');
            }
        }

        return $this->render('widget/manage_widget.html.twig', [
            'form_weather' => $form_weather->createView(),
            'form_steamappnew' => $form_steamappnews->createView(),
            'form_steamprofile' => $form_steamprofile->createView(),
            'form_steamrecentgames' => $form_steamrecentgames->createView(),
            'form_deviseconversion' => $form_deviseconversion->createView(),
            'form_youtubevideo' => $form_youtubevideo->createView()
        ]);
    }


    /**
     * @Route("/ajax/weather", name="ajax_weather")
     * @param Request $request
     * @return JsonResponse|Response
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     */
    public function weather_request_ajax(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            $data = $_POST['city'];
            $test = $this->callweatherapi($data);
            return new JsonResponse(array(
                'city' => $test['name'],
                'temperature' => $test['main']['temp'],
                'description' => $test['weather'][0]['description']
            ), 200);
        }
        return $this->redirectToRoute('widgets');
    }

    /**
     * @Route("/ajax/steamapp", name="ajax_steamapp")
     * @param Request $request
     * @return JsonResponse|Response
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     */
    public function steamapp_request_ajax(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            $data = $_POST['gameid'];
            $test = $this->callsteamappnewsapi($data);
            return new JsonResponse(array(
                'title' => $test['appnews']['newsitems'][0]['title'],
                'author' => $test['appnews']['newsitems'][0]['author'],
                'content' => $test['appnews']['newsitems'][0]['contents']
            ), 200);
        }
        return $this->redirectToRoute('widgets');
    }

    /**
     * @Route("/ajax/steamprofile", name="ajax_steamprofile")
     * @param Request $request
     * @return JsonResponse|RedirectResponse
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     */
    public function steamprofile_request_ajax(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            $data = $_POST['profileid'];
            $test = $this->callsteamprofileapi($data);
            return new JsonResponse(array(
                'profilename' => $test['response']['players'][0]['personaname'],
                'steamid' => $test['response']['players'][0]['steamid'],
                'url' => $test['response']['players'][0]['profileurl'],
                'avatar' => $test['response']['players'][0]['avatarmedium']
            ), 200);
        }
        return $this->redirectToRoute('widgets');
    }

    /**
     * @Route("/ajax/steamrecentgames", name="ajax_steamrecentgames")
     * @param Request $request
     * @return JsonResponse|RedirectResponse
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     */
    public function steamrecentgames_request_ajax(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            $data1 = $_POST['steamid'];
            $test = $this->callsteamrecentgames($data1);
            return new JsonResponse(array(
                'game_name' => $test['response']['games'][0]['name'],
                'game_id' => $test['response']['games'][0]['appid'],
                'play_time' => $test['response']['games'][0]['playtime_2weeks'],
            ), 200);
        }
        return $this->redirectToRoute('widgets');
    }

    /**
     * @Route("/ajax/deviseconversion", name="ajax_deviseconversion")
     * @param Request $request
     * @return JsonResponse|RedirectResponse
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     */
    public function deviseconversion_request_ajax(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            $target = $_POST['target'];
            $format = $_POST['format'];
            $quantity = $_POST['quantity'];
            $test = $this->calldeviseconversionapi($target, $format);
            $nb = $test['currency'][0]['value'] * $quantity;
            return new JsonResponse(array(
                'amount' => $nb,
            ), 200);
        }
        return $this->redirectToRoute('widgets');
    }

    /**
     * @Route("/ajax/youtubevideo", name="ajax_youtubevideo")
     * @param Request $request
     * @return JsonResponse|RedirectResponse
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     */
    public function youtubevideo_request_ajax(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            $id = $_POST['videoid'];
            $test = $this->callyoutubevideoapi($id);
            return new JsonResponse(array(
                'title' => $test['items'][0]['snippet']['title'],
                'description' => $test['items'][0]['snippet']['description'],
                'views' => $test['items'][0]['statistics']['viewCount'],
                'likes' => $test['items'][0]['statistics']['likeCount'],
            ), 200);
        }
        return $this->redirectToRoute('widgets');
    }
}
