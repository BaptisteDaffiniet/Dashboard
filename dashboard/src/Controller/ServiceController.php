<?php

namespace App\Controller;

use App\Form\ServiceCreatorType;
use App\Entity\Services;
use App\Repository\ServicesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ServiceController extends AbstractController
{
    /**
     * @Route("/services", name="services")
     * @param ServicesRepository $servicesRepository
     * @return Response
     */
    public function index(ServicesRepository $servicesRepository): Response
    {
        $services = $servicesRepository->findAll();

        return $this->render('service/login.html.twig', [
            'services' => $services,
        ]);
    }

    /**
     * @Route("/services/{id}/admin", name="manage_service")
     * @param $id
     * @param ServicesRepository $servicesRepository
     * @return Response
     */
    public function manage_service($id, ServicesRepository $servicesRepository): Response
    {
        $service = $servicesRepository->find($id);
        return $this->render('service/manage_service.html.twig', [
            'service' => $service
        ]);
    }

    /**
     * @Route("/services/create", name="create_service")
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function create_service(Request $request) {
        $service = new Services();

        $form = $this->createForm(ServiceCreatorType::class, $service);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($service);
            $em->flush();

            return $this->redirectToRoute('services');
        }
        return $this->render('service/create_service.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/service/delete/{id}", name="delete_service")
     * @param $id
     * @param ServicesRepository $servicesRepository
     * @return RedirectResponse
     */
    public function delete_service($id, ServicesRepository $servicesRepository) {
        $service = $servicesRepository->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($service);
        $em->flush();
        return $this->redirectToRoute('services');
    }
}
