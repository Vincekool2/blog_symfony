<?php

//Indique le chemin d'accès du fichier
namespace App\Controller;
//Fait le lien avec les classes / equivalent du require_once mais avec les Namespaces
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


//Ceci est une classe. AbstractController est en heritage pour utiliser ses fonctionnalités
class ArticleController extends AbstractController
{

    //Permet de créer une nouvelle page avec l'adresse indiquée
    #[Route('/categories', name: 'list_category')]
    public function listCategory(){
        $categories = [
            'Red', 'Green', 'Blue', 'Yellow', 'Gold', 'Silver', 'Crystal'
        ];

        $html=$this->renderview('page/Category.html.twig', [
            'categories' => $categories
        ]);
        //Retourne un status 200
        return new Response($html, 200);
    }
}



