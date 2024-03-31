<?php

namespace App\DataFixtures;

use App\Entity\Members;
use App\Entity\Pets;
use App\Entity\PetsType;
use App\Entity\Videos;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{

    protected $faker;

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager): void
    {
        $members = new Members();
        $members->setName($this->faker->name);
        $members->setEmail($this->faker->email);
        $members->setPhone($this->faker->phoneNumber);
        $members->setCity($this->faker->city);
        $manager->persist($members);

        $animalTypes = ['Chien', 'Chat', 'Oiseau', 'Poisson', 'Reptile', 'Rongeur', 'Autre'];
        $animalTypesObject = [];
        foreach ($animalTypes as $type) {
            $petsType = new PetsType();
            $petsType->setLabel($type);
            $animalTypesObject[] = $petsType;
            $manager->persist($petsType);
        }


        $petsArray = [];
        for ($i = 0; $i < 10; $i++) {
            $pets = new Pets();
            $pets->setName($this->faker->firstName);
            $pets->setAge($this->faker->numberBetween(1, 20));
            $pets->setArrivalDate($this->faker->dateTimeBetween('-1 years', 'now'));
            $pets->setStaff($members);
            $pets->setType($animalTypesObject[$this->faker->numberBetween(0, count($animalTypesObject) - 1)]);
            $petsArray[] = $pets;
            $manager->persist($pets);
        }

        for ($i = 0; $i < 10; $i++) {
            $videos = new Videos();
            $videos->setUrl("https://www.youtube.com/watch?v=" . $this->faker->uuid);
            $videos->setTitle("Video " . $i + 1);
            $videos->setDescription($this->faker->realText(255));
            $videos->setAddDate($this->faker->dateTimeBetween('-1 years', 'now'));
            for ($j = 0; $j < $this->faker->numberBetween(1, 5); $j++) {
                $videos->addPet($petsArray[$this->faker->numberBetween(0, count($petsArray) - 1)]);
            }
            $manager->persist($videos);
        }

        $manager->flush();
    }
}
