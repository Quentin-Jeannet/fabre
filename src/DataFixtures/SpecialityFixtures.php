<?php

namespace App\DataFixtures;

use App\Entity\Speciality;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SpecialityFixtures extends Fixture
{
    // ====================================================== //
    // ===================== PROPRIETES ===================== //
    // ====================================================== //
    public const SPECIALITY_DATA_MANAGER = 'data-manager';
    public const SPECIALITY_PHYSICIAN = 'physician';
    // ====================================================== //
    // ====================== METHODES ====================== //
    // ====================================================== //
    public function load(ObjectManager $manager): void
    {


        $speciality = new Speciality();
        $speciality->setName('Data manager');
        $speciality->setIsActive(true);
        $speciality->setSlug('data_manager');
        $manager->persist($speciality);
        $this->addReference(self::SPECIALITY_DATA_MANAGER, $speciality);

        $speciality = new Speciality();
        $speciality->setName('Physician');
        $speciality->setSlug('physician');
        $speciality->setIsActive(true);
        $manager->persist($speciality);
        $this->addReference(self::SPECIALITY_PHYSICIAN, $speciality);

        $manager->flush();
    }
}
