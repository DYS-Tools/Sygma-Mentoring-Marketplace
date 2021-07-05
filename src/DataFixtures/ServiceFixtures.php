<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Service;

class ServiceFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $service1 = new Service();
        $service1->setTitle('Mentorat sur le développement web')
            ->setDescription('1H : Conseils et debuggage des applications web')
            ->setImage('1baiedumontsaintmichelpuntostudiofotoag1920x960-60d7402229507.jpg')
            ->setPrice(15)
        ;

        $manager->persist($service1);

        $service2 = new Service();
        $service2->setTitle('Cours sur Adobe Photoshop')
            ->setDescription('2H : Approfondir photoshop')
            ->setImage('demo-1.jpg')
            ->setPrice(400)
        ;

        $manager->persist($service2);

        $service3 = new Service();
        $service3->setTitle('Cours sur Adobe Lightroom')
            ->setDescription('2H : Approfondir LightRoom')
            ->setImage('demo-2.jpg')
            ->setPrice(40)
        ;

        $manager->persist($service3);

        $service4 = new Service();
        $service4->setTitle('Coaching photographie nature')
            ->setDescription('1H : La photographie animal')
            ->setImage('demo-3.jpg')
            ->setPrice(50)
        ;

        $manager->persist($service4);

        $service4 = new Service();
        $service4->setTitle('Apprehender les animaux')
            ->setDescription('0.5H : connaitre les animaux')
            ->setImage('demo-4.jpg')
            ->setPrice(100)
        ;

        $manager->persist($service4);

        /*
        private $id;
        private $title;
        private $description;
        private $image;
        private $price;
        private $category;
        */

        $manager->flush();
    }
}
