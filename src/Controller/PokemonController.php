<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\PokemonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;


class PokemonController extends AbstractController
{
    private array $pokemons;

    public function __construct() {

        $this->pokemons = [
            [
                'id' => 1,
                'title' => 'Carapuce',
                'content' => 'Pokemon eau',
                'isPublished' => true,
                'img' => 'https://velog.velcdn.com/images/lifeisbeautiful/post/4292a50f-b619-46b3-8168-2e0266492a66/image.gif'
            ],
            [
                'id' => 2,
                'title' => 'Salamèche',
                'content' => 'Pokemon feu',
                'isPublished' => true,
                'img' => 'https://www.numerama.com/content/uploads/2016/07/200.gif'
            ],
            [
                'id' => 3,
                'title' => 'Bulbizarre',
                'content' => 'Pokemon plante',
                'isPublished' => true,
                'img' => 'https://ekladata.com/KaNDmpeKdpKO1_YpBhlNrr3SrwM.gif'
            ],
            [
                'id' => 4,
                'title' => 'Pikachu',
                'content' => 'Pokemon electrique',
                'isPublished' => true,
                'img' => 'https://i.pinimg.com/originals/7d/8e/ce/7d8ece07bdf7e7aeba520ee0a5adcaa8.gif'
            ],
            [
                'id' => 5,
                'title' => 'Rattata',
                'content' => 'Pokemon normal',
                'isPublished' => false,
                'img' => 'https://pa1.aminoapps.com/6026/f8cf9e22fcc298e3b0172e7fdb9615aad60b156d_hq.gif'
            ],
            [
                'id' => 6,
                'title' => 'Roucool',
                'content' => 'Pokemon vol',
                'isPublished' => true,
                'img' => 'https://pa1.aminoapps.com/6175/dd4ce6c626d8e84594952a05b810dd9d8d3ce654_hq.gif'
            ],
            [
                'id' => 7,
                'title' => 'Aspicot',
                'content' => 'Pokemon insecte',
                'isPublished' => false,
                'img' => 'https://static.wikia.nocookie.net/pokemonfanon/images/b/b2/Weedle_Poison_Sting.gif'
            ],
            [
                'id' => 8,
                'title' => 'Nosferapti',
                'content' => 'Pokemon poison',
                'isPublished' => false,
                'img' => 'https://64.media.tumblr.com/f6951b30983aebc0c0169d5ddc4e5329/tumblr_o0vb6atheJ1tqptlzo1_500.gif'
            ],
            [
                'id' => 9,
                'title' => 'Mewtwo',
                'content' => 'Pokemon psy',
                'isPublished' => true,
                'img' => 'https://i.kym-cdn.com/photos/images/original/002/052/274/5ec.gif'
            ],
            [
                'id' => 10,
                'title' => 'Ronflex',
                'content' => 'Pokemon normal',
                'isPublished' => false,
                'img' => 'https://www.serieously.com/app/uploads/2020/02/Ronflex.gif'
            ]

        ];
    }
    #[Route('/pokemons', name: 'list_pokemon')]
    public function listPokemon()
    {




        return $this->render('list_pokemon.html.twig', [
            'pokemons' => $this->pokemons
        ]);

    }


    #[Route('/pokemon-categories', name: 'list_pokemon_categories')]
    public function listPokemonCategories()
    {
        $categories = [
            'Red', 'Green', 'Blue', 'Yellow', 'Gold', 'Silver', 'Crystal'
        ];


        $html = $this->renderView('list_pokemon.html.twig', [
            'categories' => $categories
        ]);

        return new Response($html, 200);
    }


    #[Route('/pokemon-show/{idPokemon}', name: 'show_pokemon')]
    public function showPokemon($idPokemon): Response
    {


        $pokemonFound = null;

        foreach ($this->pokemons as $pokemon) {
            if($pokemon['id'] === (int)$idPokemon) {
                $pokemonFound = $pokemon;
            }
        }

        return $this->render('pokemon_show.html.twig', [
            'pokemon' => $pokemonFound
        ]);



    }


    #bDD LOADER
    #[Route('/bddPokemon', name: 'bddpokemon')]
    public function bddPokemon(PokemonRepository $pokemonRepository)
    {





        return $this->render('bddPokemon.html.twig', ['pokemon' => $pokemonRepository->findAll()]);

    }

    #[Route('/bddPokemon/{idPokemon}', name: 'show_bddpokemon')]
    public function bddPokemon_show($idPokemon, PokemonRepository $pokemonRepository): Response
    {

$pokemon =$pokemonRepository ->find($idPokemon);

        return $this->render('bddPokemon_show.html.twig', ['pokemon' => $pokemon]);

    }

}