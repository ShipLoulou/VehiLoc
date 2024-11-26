<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Car;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        $nameCar = ['Renault Twingo', 'Renault Clio', 'BMX IX (Electric)', 'Renault Zoé', 'Citroën Ami', 'Opel Corsa'];

        for ($index = 0; $index < count($nameCar); $index++) {
            $car = new Car;
            $car
                ->setName($nameCar[$index])
                ->setDescription('ou similaire | Saint-Étienne')
                ->setMonthlyPrice($faker->numberBetween($min = 28, $max = 40))
                ->setDailyPrice($faker->numberBetween($min = 800, $max = 700))
                ->setPlaces(4)
                ->setMotor('Manuelle')
            ;

            $manager->persist($car);
        }

        $manager->flush();
    }
}
