<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Movie;
use App\Repository\MovieRepository;


//$em = EntityManager::create($dbParams, $config);

class HomepageController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository(Movie::class);
        $nextMovies = $repository->findByNextRelease();
        $todayMovies = $repository->findSomeTodayRelease(3);
        return $this->render('homepage/index.html.twig', [
            'nextMovies' => $nextMovies,
            'todayMovies' =>  $todayMovies,
        ]);
    }
}
