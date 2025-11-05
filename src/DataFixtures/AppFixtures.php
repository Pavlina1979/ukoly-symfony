<?php

namespace App\DataFixtures;

use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Ukol;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $ukol = new Ukol;
        $ukol->setNazev('Nakrmit rybičky');
        $ukol->setPopis('Furt na to zapomínáš, už mě nebaví kupovat každý týden nové ryby!!!');
        $ukol->setDokdy(new DateTime('12/12/2025 12:00 PM'));
        $ukol->setDokonceno(false);

        $manager->persist($ukol);

        $ukol = new Ukol;
        $ukol->setNazev('Naučit se učit');
        $ukol->setPopis('Projít nějaké články ohldně schopnosti lépe se učit.');
        $ukol->setDokdy(new DateTime('12/12/2025 12:00 PM'));
        $ukol->setDokonceno(false);

        $manager->persist($ukol);

        $manager->flush();
    }
}
