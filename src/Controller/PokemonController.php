<?php

namespace App\Controller;

use App\Entity\Pokemon;
use App\Entity\Type;
use App\Repository\PokemonRepository;
use App\Repository\TypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\Exception\ClientException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

#[Route('/pokemon', name: 'app_pokemon_')]
class PokemonController extends AbstractController
{
    private HttpClientInterface $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('pokemon/index.html.twig');
    }

    #[Route('/load', name: 'load')]
    public function load(TypeRepository $typeRepository, PokemonRepository $pokemonRepository): Response
    {
        if ($pokemonRepository->count([]) === 0) {
            try {
                $response = $this->client->request(
                    'GET',
                    'https://pokebuildapi.fr/api/v1/random/team'
                );

                $statusCode = $response->getStatusCode();
                $contentType = $response->getHeaders()['content-type'][0];

                if ($statusCode === 200 && $contentType === 'application/json') {
                    $content = $response->toArray();

                    foreach ($content as $apiPokemon) {
                        $pokemon = $pokemonRepository->findOneBy(['pokedexId' => $apiPokemon['pokedexId']]);
                        if (!$pokemon) {
                            $pokemon = new Pokemon();
                            $pokemon->setPokedexId($apiPokemon['pokedexId'])
                                ->setName($apiPokemon['name'])
                                ->setSlug($apiPokemon['slug'])
                                ->setImage($apiPokemon['image'])
                                ->setGeneration($apiPokemon['apiGeneration']);
                        }

                        foreach ($apiPokemon['apiTypes'] as $apiType) {
                            $type = $typeRepository->findOneBy(['name' => $apiType['name']]);
                            if (!$type) {
                                $type = new Type();
                                $type->setName($apiType['name'])
                                    ->setImage($apiType['image']);
                                $typeRepository->save($type, true);
                            }

                            $pokemon->addType($type);
                        }

                        $pokemonRepository->save($pokemon, true);
                    }
                }
            } catch (ClientException $e) {
                dd($e);
            }
        }

        return $this->redirectToRoute('app_home');
    }

    #[Route('/unload', name: 'unload')]
    public function unload(TypeRepository $typeRepository, PokemonRepository $pokemonRepository): Response
    {
        foreach ($pokemonRepository->findAll() as $pokemon) {
            $pokemonRepository->remove($pokemon, true);
        }

        foreach ($typeRepository->findAll() as $type) {
            $typeRepository->remove($type, true);
        }

        return $this->redirectToRoute('app_home');
    }
}
