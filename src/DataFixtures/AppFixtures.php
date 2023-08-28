<?php

namespace App\DataFixtures;

use App\Entity\Pin;
use App\Entity\User;
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
        $users = [];

        // Users
        $admin = new User();
        $admin
            ->setFirstName('Vincent')
            ->setLastName('DONINI')
            ->SetEmail('admin@woder.fr')
            ->setRoles(['ROLE_USER', 'ROLE_ADMIN'])
            ->setPlainPassword('password');
        $users[] = $admin;

        $manager->persist($admin);

        for ($i = 0; $i < 10; $i++) {
            $user = new User();
            $user
                ->setFirstName(mt_rand(0, 1) === 1 ? $this->faker->firstName() : '')
                ->setLastName(mt_rand(0, 1) === 1 ? $this->faker->lastName() : '')
                ->setEmail($this->faker->unique()->email())
                ->setRoles(['ROLE_USER'])
                ->setPlainPassword('password');
            $users[] = $user;

            $manager->persist($user);
        }

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
                    ->setImageName($imageName)
                    ->setUser($users[mt_rand(0, count($users) - 1)]);

                $manager->persist($pin);
            } catch (GuzzleException $e) {
                // Handle exception
            }
        }

        $manager->flush();
    }
}
