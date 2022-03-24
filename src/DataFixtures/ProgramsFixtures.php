<?php

namespace App\DataFixtures;

use App\Entity\Programs;
use DateTimeImmutable;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ProgramsFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $program = new Programs();
        $program->setUpdatedAt(New DateTimeImmutable());
        $program->setImageName('programme-im.png');
        $program->setName('On-site program');
        $manager->persist($program);

        $manager->flush();
    }
}
