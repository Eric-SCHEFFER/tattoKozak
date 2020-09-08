<?php

namespace App\DataFixtures;

use App\Entity\Slogan;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $slogan = new Slogan();
        $slogan->settexte("La peau dans l'art");
        $manager->persist($slogan);

        $manager->flush();
    }
}
