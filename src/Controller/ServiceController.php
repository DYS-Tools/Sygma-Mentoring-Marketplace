<?php

namespace App\Controller;

use App\Entity\Service;
use App\Form\ServiceType;
use App\Repository\ServiceRepository;
use App\Service\Upload;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/service")
 */
class ServiceController extends AbstractController
{
    /**
     * page my service 
     * @Route("/myService", name="my_service", methods={"GET"})
     */
    public function myServiceInAccount(ServiceRepository $serviceRepository): Response
    {
        $user = $this->getUser();

        return $this->render('account/myService.html.twig', [
            'services' => $serviceRepository->findBy(['user' => $user ]),
        ]);
    }
    
    /**
     * @Route("/service_new", name="service_new", methods={"GET","POST"})
     */
    public function new(Request $request,Upload $upload): Response
    {
        $service = new Service();
        $form = $this->createForm(ServiceType::class, $service);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            // for upload service 
            $fileName1 = $upload->uploadImgService($form->get('image')->getData());

            $user = $this->getUser();
            $service->setUser($user); 
            $service->setImage($fileName1);

            $entityManager->persist($service);
            $entityManager->flush();

            return $this->redirectToRoute('my_service');
        }

        return $this->render('service/new.html.twig', [
            'service' => $service,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/service/{id}", name="service_show", methods={"GET"})
     */
    public function show(Service $service): Response
    {
        return $this->render('service/show.html.twig', [
            'service' => $service,
        ]);
    }

    /**
     * @Route("/service/{id}/edit", name="service_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Service $service,Upload $upload): Response
    {
        $form = $this->createForm(ServiceType::class, $service);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $fileName1 = $upload->uploadImgService($form->get('image')->getData());
            $service->setImage($fileName1);

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('my_service');
        }

        return $this->render('service/edit.html.twig', [
            'service' => $service,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/service/{id}", name="service_delete", methods={"POST"})
     */
    public function delete(Request $request, Service $service): Response
    {
        if ($this->isCsrfTokenValid('delete'.$service->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($service);
            $entityManager->flush();
        }

        return $this->redirectToRoute('my_service');
    }
    
}
