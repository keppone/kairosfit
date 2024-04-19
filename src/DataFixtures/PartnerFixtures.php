<?php

namespace App\DataFixtures;

use App\Entity\Partner;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Faker\Factory;

class PartnerFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < 100; $i++){
            $partner=new Partner();
            $partner
                ->setName($faker->company)
                ->setDescription($faker->sentences($nb = 3, $asText = true))
                ->setActivate(true)
                ->setEmail($faker->safeEmail)
                ->setCommercialContact($faker->name);
                
            $manager->persist($partner);
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
