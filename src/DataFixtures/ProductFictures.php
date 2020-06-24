<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Product;
use Faker\Factory;


class ProductFictures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        //Instantiation de faker 
        $faker = Factory::create('fr_FR');
    

       // Génerer 50 produits 
       for ($i=0; $i < 50; $i++) { 
           $product = new Product();
           $product
                 
                ->setName($faker->sentence(3))
                ->setDescription($faker->optional()->realText())
                ->setPrice($faker->numberBetween(1000, 300000))
                ->setCreatedAt($faker->dateTimeBetween('-6 month'))
            ;
            
            $manager->persist($product);
       }

       $manager->flush();
    }
}
