<?php

namespace App\Controller;

use App\Repository\CarRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class CarController extends AbstractController
{
    protected $twig;
    protected $carRepository;

    public function __construct(Environment $twig, CarRepository $carRepository)
    {
        $this->twig = $twig;
        $this->carRepository = $carRepository;
    }

    #[Route('/', name: 'app_home')]
    public function showHome()
    {
        $cars = $this->carRepository->findAll();

        return $this->render('home.html.twig', [
            'cars' => $cars
        ]);
    }

    #[Route('/voiture/{id}', name: 'app_one_car')]
    public function carDetails($id)
    {
        $car = $this->carRepository->find($id);

        if (!$car) {
            throw $this->createNotFoundException("La voiture n'existe pas.");
        }

        return $this->render('one-car.html.twig', [
            'car' => $car
        ]);
    }
}
