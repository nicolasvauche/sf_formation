<?php

namespace App\DataFixtures;

use App\Entity\Microphone;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MicrophoneFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $microphone = new Microphone();
        $microphone->setName('Rode NT1-A')
            ->setImage('rode-nt1-a.jpeg')
            ->setNote(5);
        $manager->persist($microphone);

        $microphone = new Microphone();
        $microphone->setName('Neumann TLM 102')
            ->setImage('neumann-tlm-102.jpeg')
            ->setNote(4);
        $manager->persist($microphone);

        $microphone = new Microphone();
        $microphone->setName('Shure SM57')
            ->setImage('shure-sm57.jpg')
            ->setNote(3);
        $manager->persist($microphone);

        $microphone = new Microphone();
        $microphone->setName('Sennheiser e906')
            ->setImage('sennheiser-e906.jpg')
            ->setNote(3);
        $manager->persist($microphone);

        $manager->flush();
    }
}
