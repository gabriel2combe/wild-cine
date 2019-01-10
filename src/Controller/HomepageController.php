<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Movie;
use App\Repository\MovieRepository;
use App\DQL\RAND;

$config = new \Doctrine\ORM\Configuration();
$config->addCustomNumericFunction('RAND', function () {
    return new RAND();
});

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
