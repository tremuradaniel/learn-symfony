<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Author;
use App\Entity\Pdf;
use App\Entity\Video;

class InheritanceEntitiesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i=1; $i<=2; $i++)
        {
            $author = new Author;
            $author->setName('author name ' . $i);
            $manager->persist($author);

            for ($i=1; $i<=2; $i++)
            {
                $pdf = new Pdf;
                $pdf->setFileName('pdf name of user ' . $i);
                $pdf->setDescription('pdf description of user' . $i);
                $pdf->setSize(5454);
                $pdf->setOrientation('portrait');
                $pdf->setPageNumber(123);
                $pdf->setAuthor($author);
                $manager->persist($pdf);
            }

            for ($i=1; $i<=2; $i++)
            {
                $video = new Video;
                $video->setFileName('video name of user ' . $i);
                $video->setDescription('video description of user' . $i);
                $video->setSize(222);
                $video->setDuration(100);
                $video->setFormat('mp4');
                $video->setAuthor($author);
                $manager->persist($video);
            }
        }

        $manager->flush();
    }
}
