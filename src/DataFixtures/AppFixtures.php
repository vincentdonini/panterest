<?php

namespace App\DataFixtures;

use App\Entity\Pin;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class AppFixtures extends Fixture
{
    private Generator $faker;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }
    public function load(ObjectManager $manager): void
    {

        // Pins
        $pins = [];
        for ($i = 1; $i <= 20; $i++) {
            $pin = new Pin();
            $pin
                ->setTitle($this->faker->unique()->word())
                ->setDescription($this->faker->text(300))
                ->setImageName(null);
            $pins[] = $pin;
            $manager->persist($pin);
        }

        $manager->flush();
    }
}
