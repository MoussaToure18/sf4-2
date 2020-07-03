<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Product;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker\Factory;


class ProductFictures extends Fixture implements DependentFixtureInterface
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

            //recuperation aléatoire d'une catégory par une reference 
            $categoryReference = 'category_' . $faker->numberBetween(0, 2);
            /** @var Category $category */
            $category = $this->getReference($categoryReference);
            
            $product->setCategory($category);

            $manager->persist($product);
       }

       $manager->flush();
    }

    /**
     * Liste des classes de fixtures qui doivent etre charger avant celle ci
     */
    public function getDependencies()
    {
        return[
            CategoryFixtures::class
        ];
    }
}
