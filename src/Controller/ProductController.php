<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProductRepository;
use App\Entity\Product;


class ProductController extends AbstractController
{
    /**
     * @Route("/product", name="product_list")
     */
    public function index(productRepository $repository)
    {

        //Récuperation de tous les produits
    $product_list = $repository->findAll();

        return $this->render('product/index.html.twig', [
             'product_list' => $product_list
        ]);
    }

    /**
    *grace au paramConverter (installé par framworkExtraBundel)
    *symfony va recuperer l'entité product qui correspond a l'identifiant dans l'URI
    *@route("/product/{id}", name="product_show")
    */
    public function show(Product $product)
    {
       return $this->render('product/show.html.twig',[
           'product' => $product
       ]);
    }
}
