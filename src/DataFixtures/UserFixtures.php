<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use App\DataFixtures\SpecialityFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture implements DependentFixtureInterface
{
    // ====================================================== //
    // ===================== PROPRIETES ===================== //
    // ====================================================== //
    private $encoder;
    // ====================================================== //
    // ==================== CONSTRUCTEUR ==================== //
    // ====================================================== //
    public function __construct(UserPasswordHasherInterface $userPasswordHasherInterface)
    {
        $this->encoder = $userPasswordHasherInterface;
    }
    // ====================================================== //
    // ====================== METHODES ====================== //
    // ====================================================== //
    public function load(ObjectManager $manager): void
    {
        // --- ADMIN/SUPERADMIN --- //
        $user = new User();
        $user->setName('meneux');
        $user->setFirstname('christian');
        $user->setEmail('cmeneux@graphikchannel.com');
        $user->setRoles(['ROLE_USER', 'ROLE_ADMIN', 'ROLE_SUPERADMIN']);
        $user->setInstitutionName('Graphik Channel');
        $user->setBusinessAddress('11 rue Jouye Rouve');
        $user->setZipcode(75020);
        $user->setCity('Paris');
        $user->setCountry('FR');
        $user->setMobilePhone('0662163737');
        $user->setIsWaitingCertificate(false);
        $encodedPassword = $this->encoder->hashPassword($user, "pass");
        $user->setPassword($encodedPassword);
        $manager->persist($user);

        // --- ADMIN/SUPERADMIN --- //
        $user = new User();
        $user->setName('nesci');
        $user->setFirstname('henri');
        $user->setEmail('henrinesci@gmail.com');
        $user->setRoles(['ROLE_USER', 'ROLE_ADMIN']);
        $user->setInstitutionName('Affaires de Santé');
        $user->setBusinessAddress('23 rue Balzac');
        $user->setZipcode(75008);
        $user->setCity('Paris');
        $user->setCountry('FR');
        $user->setMobilePhone('0631299943');
        $user->setIsWaitingCertificate(false);
        $encodedPassword = $this->encoder->hashPassword($user, "pass");
        $user->setPassword($encodedPassword);
        $manager->persist($user);

        $user = new User();
        $user->setName('jeannet');
        $user->setFirstname('quentin');
        $user->setEmail('quentin@graphikchannel.com');
        $user->setRoles(['ROLE_USER', 'ROLE_ADMIN', 'ROLE_SUPERADMIN']);
        $user->setInstitutionName('Graphik Channel');
        $user->setBusinessAddress('11 rue Jouye Rouve');
        $user->setZipcode(75020);
        $user->setCity('Paris');
        $user->setCountry('FR');
        $user->setMobilePhone('0678787879');
        $user->setIsWaitingCertificate(false);
        $encodedPassword = $this->encoder->hashPassword($user, "pass");
        $user->setPassword($encodedPassword);
        $manager->persist($user);

        // ------- PHYSICIAN ------ //
        $user = new User();
        $user->setName('Einstein');
        $user->setFirstname('Albert');
        $user->setEmail('einstein@gmail.com');
        $user->setRoles(['ROLE_USER', 'ROLE_PHYSICIAN']);
        $user->setSpeciality($this->getReference(SpecialityFixtures::SPECIALITY_PHYSICIAN));
        $user->setInstitutionName('Université de Genève');
        $user->setBusinessAddress('24 rue du Général-Dufour');
        $user->setZipcode(1211);
        $user->setCity('Zurich');
        $user->setCountry('CH');
        $user->setMobilePhone('0707070707');
        $user->setIsWaitingCertificate(true);
        $encodedPassword = $this->encoder->hashPassword($user, "pass");
        $user->setPassword($encodedPassword);
        $manager->persist($user);

        // ------- DATA MANAGER ------ //
        $user = new User();
        $user->setName('Jean');
        $user->setFirstname('Data');
        $user->setEmail('jdata@gmail.com');
        $user->setRoles(['ROLE_USER', 'ROLE_DATA_MANAGER']);
        $user->setSpeciality($this->getReference(SpecialityFixtures::SPECIALITY_DATA_MANAGER));
        $user->setInstitutionName('Paris School of Business');
        $user->setBusinessAddress('59 rue Nationale');
        $user->setZipcode(75013);
        $user->setCity('Paris');
        $user->setCountry('FR');
        $user->setMobilePhone('0708090504');
        $user->setIsWaitingCertificate(false);
        $encodedPassword = $this->encoder->hashPassword($user, "pass");
        $user->setPassword($encodedPassword);
        $manager->persist($user);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            SpecialityFixtures::class,
        ];
    }
}
