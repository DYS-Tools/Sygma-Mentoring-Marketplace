<?php

namespace App\Controller;

use App\Entity\Service;
use App\Form\ServiceType;
use App\Repository\ServiceRepository;
use App\Service\Payment;
use Doctrine\Common\Annotations\PhpParser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/order")
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

    /**
     * @Route("valid/pay/", name="succes_pay")
     */
    public function succesPayment(Payment $payment,Request $request, PhpParser $phpParser): Response
    {
        return $this->render('Payment/SuccessPayment.html.twig', [
          
        ]);
    }

    /**
     * @Route("invalid/pay/", name="invalid_pay")
     */
    public function invalidPayment(Payment $payment,Request $request, PhpParser $phpParser): Response
    {

        return $this->render('Payment/InvalidPayment.html.twig', [
          
        ]);
    }
}
