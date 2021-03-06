<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\ServiceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(ServiceRepository $serviceRepository,CategoryRepository $categoryRepository): Response
    {
        //for search engine
        //$serviceStringArray = implode($serviceRepository->findAll());
        $serviceStringArray = ['foo', 'bar', 'baz'];
        //dd($serviceStringArray);

        return $this->render('home/index.html.twig', [
            'services' => $serviceRepository->findAll(),
            'categories' => $categoryRepository->findAll(),
            'servicesStringArray' => $serviceStringArray,

        ]);
    }
}
