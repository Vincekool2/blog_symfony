<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Pokemon;
use App\Form\PokemonType;
use App\Repository\PokemonRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


class PokemonController extends AbstractController
{


    #[Route('/pokemon-show/{idPokemon}', name: 'show_bddpokemon')]
    public function showPokemon($idPokemon): Response
    {


        return $this->render('bddPokemon_show.html.twig', ['pokemon' => $idPokemon]);
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
        return $this->render('pokemon_search.html.twig', ['pokemon' => $searchPokemon]);

    }


    #[Route('/delete_pokemon/{id}', name: 'delete_pokemon')]
    public function deletePokemon(int $id, PokemonRepository $pokemonRepository, EntityManagerInterface $entityManager): Response
    {
        $pokemon = $pokemonRepository->find($id);


        if ($pokemon === null) {
            $html = $this->renderView('404.html.twig');
            return new Response($html, 404);
        }
        $entityManager->remove($pokemon);

        $entityManager->flush();
        return $this->render('delete_pokemon.html.twig', ['pokemon' => $pokemon]);


    }

    #[Route('/insert_pokemon', name: 'insert_pokemon')]
    public function insertPokemon(PokemonRepository $pokemonRepository, EntityManagerInterface $entityManager, Request $request)
    {
        $pokemon = null;


        if ($request->getMethod() === "POST") {

            $title = $request->request->get('title');
            $description = $request->request->get('description');
            $image = $request->request->get('image');
            $type = $request->request->get('type');

            $pokemon = new Pokemon();

            $pokemon->setTitle($title);
            $pokemon->setDescription($description);
            $pokemon->setImage($image);
            $pokemon->setType($type);

            $entityManager->persist($pokemon);
            $entityManager->flush();
        }
        return $this->render('insert_pokemon.html.twig', ['pokemon' => $pokemon]);


    }

    #[Route('/pokemons/insert/form-builder', name: 'insert_pokemon_form_builder')]
    public function insertPokemonFormBuilder(Request $request, EntityManagerInterface $entityManager)
    {

        //Nouvelle instance de la classe Pokemon
        $pokemon = new Pokemon();

        // J'instancie le gabarit du formulaire et le lie à l'entité
        $pokemonForm = $this->createForm(PokemonType::class, $pokemon);

        // Lien entre le formulaire et la requête
        $pokemonForm->handleRequest($request);


        // Verifie si le formulaire a été envoyé et que ces données sont correctes
        if ($pokemonForm->isSubmitted() && $pokemonForm->isValid()) {
            $entityManager->persist($pokemon);
            $entityManager->flush();
        }

        return $this->render('pokemon_insert_form_builder.html.twig', ['pokemonForm' => $pokemonForm->createView()
        ]);
    }

    #[Route('/pokemons/update/{id}', name: 'pokemon_update')]
    public function pokemonUpdate (PokemonRepository $pokemonRepository, EntityManagerInterface $entityManager, Request $request, int $id)
    {
        //Selectionne un pokemon dans la bdd avec a l'id dans l'url
        $pokemon = $pokemonRepository->find($id);
        //Si l'id n'est pas valide l'utilisateur est redirigé vers un page d'erreur
        if ($pokemon === null) {
            $html = $this->renderView('404.html.twig');
            return new Response($html, 404);
        }
        // J'instancie le gabarit du formulaire et le lie à l'entité
        $pokemonUpdateForm = $this->createForm(PokemonType::class, $pokemon);

        //fait le lien entre le formulaire et la requête
        $pokemonUpdateForm->handleRequest($request);

        //si le modification a bien été envoyé et que les donnees sont valides ce if commit(persist) puis push(flush).
        if ($pokemonUpdateForm->isSubmitted() && $pokemonUpdateForm->isValid()) {
            $entityManager->persist($pokemon);
            $entityManager->flush();
        }
        // je retourne le rendu pour l'affichage twig avec le formulaire
        return $this->render('pokemon_update.html.twig', ['pokemon' => $pokemonUpdateForm->createView()]);
    }
}