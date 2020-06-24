<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProductRepository;

class HomeController extends AbstractController
{
    /**
    *Page d'accueil, affichage des nouveaux produits
     * @Route("/", name="home")
     */
    public function index(ProductRepository $repository)
    {
        //findAll() / findBy() / findOneBy() / find()
        // findBy() va effectuer une comparaison d'égalité, alors que nous souhaitons effectuer une comparaison de supériorité
        // solution: créer notre propre méthode dans le ProductRepository
        
        /*$repository->findBy([
            'createdAt' => new \DateTime('-1 month')
        ]);
        */

        //on utilise nos propre méthode pour récuperer les nouveautés
        $Result = $repository->findNews();

        return $this->render('home/index.html.twig', [
            'new_products' => $Result
        ]);
    }
}
