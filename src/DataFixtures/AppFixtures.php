<?php

namespace App\DataFixtures;

use App\Entity\Pin;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use function Symfony\Component\String\u;

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
        $client = new Client();

        // Pins
        for ($i = 1; $i <= 20; $i++) {
            try {
                $title = $this->faker->unique()->text(25);
                $imageUrl = 'https://loremflickr.com/800/600';
                $imageName = null;

                $rand = mt_rand(0, 1);
                if($rand){
                    $response = $client->get($imageUrl);
                    $content = $response->getBody()->getContents();
                    $imageName = uniqid(u($title)->snake().'_', true) . '.jpg';
                    file_put_contents('public/uploads/pins/' . $imageName, $content);
                }

                $pin = new Pin();
                $pin
                    ->setTitle($title)
                    ->setDescription($this->faker->text(300))
                    ->setImageName($imageName);

                $manager->persist($pin);
            } catch (GuzzleException $e) {
                // Handle exception
            }
        }

        $manager->flush();
    }
}
