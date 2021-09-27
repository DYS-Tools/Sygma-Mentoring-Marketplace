<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/cashflow", name="cashflow")
     */
    public function cashflow(): Response
    {
        $moneyInCirculation = 0;
        $availableRoyalties = 0;
        $totalRoyalties = 0;
        $updateDate = new \DateTime('now');
        $resultDate = $updateDate->format('Y-m-d-H-i-s');

        return $this->render('admin/cashflow.html.twig', [
            'moneyInCirculation' => floatval($moneyInCirculation),
            'availableRoyalties' => floatval($availableRoyalties),
            'totalRoyalties' => floatval($totalRoyalties),
            'updateDate' => $resultDate,
        ]);
    }
}
