<?php

namespace App\Controller;

use Twig\Environment;
use App\Form\CarFormType;
use App\Repository\CarRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CarController extends AbstractController
{
    protected $twig;
    protected $carRepository;
    protected $em;

    public function __construct(Environment $twig, CarRepository $carRepository, EntityManagerInterface $em)
    {
        $this->twig = $twig;
        $this->carRepository = $carRepository;
        $this->em = $em;
    }

    #[Route('/', name: 'app_home')]
    public function showHome()
    {
        $cars = $this->carRepository->findAll();

        return $this->render('home.html.twig', [
            'cars' => $cars
        ]);
    }

    #[Route('/voiture/{id}', name: 'app_one_car', priority: -1)]
    public function detailsCar($id)
    {
        $car = $this->carRepository->find($id);

        if (!$car) {
            throw $this->createNotFoundException("La voiture n'existe pas.");
        }

        return $this->render('one-car.html.twig', [
            'car' => $car
        ]);
    }

    #[Route('/voiture/{id}/supprimer', name: 'app_delete_car')]
    public function deleteCar($id)
    {
        $car = $this->carRepository->find($id);

        if (!$car) {
            $this->redirectToRoute('app_home');
        }

        $this->em->remove($car);

        $this->em->flush();

        return $this->redirectToRoute('app_home');
    }

    #[Route('/voiture/ajouter', name: 'app_add_car')]
    public function addCar(Request $request)
    {
        $form = $this->createForm(CarFormType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $car = $form->getData();

            $this->em->persist($car);
            $this->em->flush();

            return $this->redirectToRoute('app_one_car', ['id' => $car->getId()]);
        }

        return $this->render('add-car.html.twig', [
            'formView' => $form->createView()
        ]);
    }
}
