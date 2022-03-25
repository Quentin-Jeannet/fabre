<?php

namespace App\DataFixtures;

use App\Entity\Home;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class HomeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $home = new Home();
        $home->setIsActive(true);
        $home->setContent('<p>Dear colleague, dear investigator,<p> 
        <p>On behalf of the Global Pierre Fabre Breast Cancer team we wish to thank for your willingness to participate to this international study aimed at characterizing the safety profile of neratinib in the real-world setting.</p>
        <p>As the study is about to start patient registration, it is our pleasure to invite you to the NERLYFE Study Investigator Meeting, to be held at the Crowne Plaza, in Berlin, Germany on the 2nd of May 2022 (11.30 am – 4.00 pm CEST), as an opportunity to deep dive into the NERLYFE study procedures and exchange with the study Steering Committee and participating investigators how to optimize patient registration and data collection.</p> 
        <p>You can find the program and meeting information. For participants not being able to come in person, we are happy to provide the possibility to participate to a virtual session starting at 1.30 pm and ending at 4.00 pm CEST. You will receive a specific link to connect. 
        In order to proceed to your registration, can you please complete this registration survey. 
        Two participants are invited to attend from each site: one PI/subPI and one additional member of the study team (data manager preferred). 
        If your attendance is not possible, we would hence be thankful if you could forward this invitation to the other members of the study team at your site.</p> 
        <p>Sincerely,</p>
        <p> Roberta Valenti<br>
        On behalf of the Global Pierre Fabre Breast Cancer team</p>');
        $manager->persist($home);

        $manager->flush();
    }
}
