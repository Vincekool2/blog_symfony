<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Pokemon;
use App\Repository\PokemonRepository;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Type;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;


class PokemonController extends AbstractController
{



    #[Route('/pokemon-show/{idPokemon}', name: 'show_bddpokemon')]
    public function showPokemon($idPokemon): Response
    {





        return $this->render('bddPokemon_show.html.twig');
    }


    #bDD LOADER
    #[Route('/bddPokemon', name: 'bdd_pokemon')]
    public function bddPokemon(PokemonRepository $pokemonRepository)
    {





        return $this->render('bddPokemon.html.twig', ['pokemon' => $pokemonRepository->findAll()]);

    }




    #[Route('/bddPokemonSearch', name: 'pokemon_search')]
    public function searchPokemon(Request $request, PokemonRepository $pokemonRepository): Response
    {
        $searchPokemon = [];
        if ($request->request->has('Title')) {
            $titlePokemon = $request->request->get('Title');
            $searchPokemon = $pokemonRepository->findOneLike($titlePokemon);

        if (count($searchPokemon) === 0) {
            $html = $this->renderView('404.html.twig');
            return new Response($html, 404);
        }

        }
        return $this->render('pokemon_search.html.twig', ['pokemon' => $searchPokemon
        ]);

    }



    #[Route('/delete_pokemon/{id}', name: 'delete_pokemon')]
    public function deletePokemon(int $id , PokemonRepository $pokemonRepository, EntityManagerInterface $entityManager ): Response
    {
        $pokemon = $pokemonRepository->find($id);



        if ($pokemon === null) {
            $html = $this->renderView('404.html.twig');
            return new Response($html, 404);
        }
        $entityManager->remove($pokemon);

        $entityManager->flush();
        return $this->redirectToRoute('bdd_pokemon');


    }
    #[Route('/insert_pokemon', name: 'insert_pokemon')]
    public function insertPokemon( PokemonRepository $pokemonRepository, EntityManagerInterface $entityManager )
    {
        $pokemon = new Pokemon (
            'Grotadmorv',
            'Grotadmorv est un immonde mélange de plusieurs produits toxiques, on peut y apercevoir sa grande langue bleu-gris.',
            'https://www.pokepedia.fr/images/thumb/8/8f/Grotadmorv-RFVF.png/500px-Grotadmorv-RFVF.png',
            'Poison',
    );
        $entityManager->persist($pokemon);
        $entityManager->flush();

        return $this->render('insert_pokemon.html.twig');

    }

}