<?php

//Indique le chemin d'accès du fichier
namespace App\Controller;

//Fait le lien avec les classes / equivalent du require_once mais avec les Namespaces
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

//Ceci est une classe. AbstractController est en heritage pour utiliser ses fonctionnalités
class IndexController extends AbstractController
{
    //Permet de créer une nouvelle page avec l'adresse indiquée
    #[Route('/', name: 'home')]
    public function index()
    {
        //die() met fin a la lecture du code de la fonction
        return $this->render('view.html.twig');
    }
}