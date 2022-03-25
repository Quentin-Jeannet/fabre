<?php

namespace App\DataFixtures;

use App\Entity\Contact;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ContactFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $contact = new Contact();
        $contact->setIsActive(true);
        $contact->setTitle("Contacts");
        $contact->setContent('<p>Do not hesitate to contact us for any further information regarding  :</p>
        <ul>
        <li>The study : Roberta VALENTI - <a href="mailto:nerlyfestudy@pierre-fabre.com">nerlyfestudy@pierre-fabre.com</a></li>
        <li>The organization of this meeting : Christelle TOUCHET - <a href="mailto:christelle.touchet@pierre-fabre.com">christelle.touchet@pierre-fabre.com</a></li>
        <li>Transport & logistics : EQUATOUR Agency - Sophie SZCZUDLAK - <a href="mailto:sophie@equatour.net">sophie@equatour.net</a></li>
        </ul>
        ');
        $manager->persist($contact);

        $manager->flush();
    }
}
