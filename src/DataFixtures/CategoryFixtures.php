<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $category1 = new Category();
        $category1->setName('Informatique');
        //$category1->setService();
        $manager->persist($category1);

        $category2 = new Category();
        $category2->setName('Business');
        //$category2->setService();
        $manager->persist($category2);

        $category3 = new Category();
        $category3->setName('Mathématique');
        //$category3->setService();
        $manager->persist($category3);

        $category4 = new Category();
        $category4->setName('Vidéo');
        //$category4->setService();
        $manager->persist($category4);

        $manager->flush();
    }
}
