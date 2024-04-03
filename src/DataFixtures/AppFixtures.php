<?php

namespace App\DataFixtures;

use App\Entity\Member;
use App\Entity\Pet;
use App\Entity\PetType;
use App\Entity\Video;
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
        $member = new Member();
        $member->setName($this->faker->name);
        $member->setEmail($this->faker->email);
        $member->setPhone($this->faker->phoneNumber);
        $member->setCity($this->faker->city);
        $manager->persist($member);

        $animalTypes = ['Chien', 'Chat', 'Oiseau', 'Poisson', 'Reptile', 'Rongeur', 'Autre'];
        $animalTypesObject = [];
        foreach ($animalTypes as $type) {
            $petType = new PetType();
            $petType->setLabel($type);
            $petType->setCost($this->faker->numberBetween(10, 100));
            $animalTypesObject[] = $petType;
            $manager->persist($petType);
        }

        $videoArray = [];
        for ($i = 0; $i < 10; $i++) {
            $video = new Video();
            $video->setUrl("https://www.youtube.com/watch?v=" . $this->faker->uuid);
            $video->setTitle("Video " . $i + 1);
            $video->setDescription($this->faker->realText(255));
            $video->setAddDate($this->faker->dateTimeBetween('-1 years', 'now'));
            $video->setMember($member);
            $videoArray[] = $video;
            $manager->persist($video);
        }

        $petsArray = [];
        for ($i = 0; $i < 10; $i++) {
            $pet = new Pet();
            $pet->setName($this->faker->firstName);
            $pet->setAge($this->faker->numberBetween(1, 20));
            $pet->setArrivalDate($this->faker->dateTimeBetween('-1 years', 'now'));
            $pet->setType($animalTypesObject[$this->faker->numberBetween(0, count($animalTypesObject) - 1)]);
            $pet->setVideo($videoArray[$this->faker->numberBetween(0, count($videoArray) - 1)]);
            $petsArray[] = $pet;
            $manager->persist($pet);
        }

        $manager->flush();
    }
}
