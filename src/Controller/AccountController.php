<?php

namespace App\Controller;

use App\Repository\ServiceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{
    /**
     * @Route("/account", name="app_account")
     */
    public function index(ServiceRepository $serviceRepository): Response
    {
        $user = $this->getUser();
        return $this->render('account/index.html.twig', [
            'controller_name' => 'AccountController',
            'services' => $serviceRepository->findBy(['user' => $user]),
        ]);
    }

    /**
     * @Route("/account/payment", name="account_payment")
     */
    public function accountPayment(): Response
    {
        return $this->render('account/paymentSetting.html.twig', [
        ]);
    }
}
