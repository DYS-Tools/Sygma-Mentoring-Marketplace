<?php

namespace App\Controller;

use App\Entity\Service;
use App\Form\ServiceType;
use App\Repository\ServiceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/service")
 */
class OrderController extends AbstractController
{
    /**
     * @Route("/{id}/orderInitialization", name="OrderInitialization", methods={"GET"})
     */
    public function orderInitialization(Service $service): Response
    {
        return $this->render('order/initializeOrder.html.twig', [
            'service' => $service,
        ]);
    }

    /**
     * @Route("/{id}/payment", name="OrderPayment", methods={"GET"})
     */
    public function orderPayment(Service $service): Response
    {
        
        return $this->render('order/orderPayment.html.twig', [
            'service' => $service,
        ]);
        

    }
}
