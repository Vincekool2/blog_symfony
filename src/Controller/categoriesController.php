<?php


//Indique le chemin d'accès du fichier
namespace App\Controller;

//Fait le lien avec les classes / equivalent du require_once mais avec les Namespaces
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


//Ceci est une classe. AbstractController est en heritage pour utiliser ses fonctionnalités
class categoriesController extends AbstractController
{
    //Permet de créer une nouvelle page avec l'adresse indiquée
    #[Route('/cate', name: 'cate')]
    public function index(){
        $categories = [
            'Red', 'Green', 'Blue', 'Yellow', 'Gold', 'Silver', 'Crystal'
        ];

        $html=$this->renderview('categories.html.twig', [
            'categories' => $categories
        ]);
        //Retourne un status 200
        return new Response($html, 200);
    }
}
