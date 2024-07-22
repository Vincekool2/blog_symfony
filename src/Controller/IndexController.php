<?php

//Indique le chemin d'accès du fichier
namespace App\Controller;

//Fait le lien avec les classes / équivalent du require_once mais avec les Namespaces
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

//Ceci est une classe. AbstractController est en héritage pour utiliser ses fonctionnalités
class IndexController extends AbstractController
{
    //Permet de créer une nouvelle page avec l'adresse indiquée
    #[Route('/', name: 'home')]
    public function index()
    {
        var_dump("hi");die();
    }
}
