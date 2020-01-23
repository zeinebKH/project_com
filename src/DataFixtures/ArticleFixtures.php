<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;


class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i=0;$i < 50;$i++)
        {
            $article = new Article();
            $article
                    ->setNomArticle("megaport super mega pack unite centrale pc gamer")
                    ->setPrix(100)
                    ->setCategorie("equipement info")
                    ->setImage("megaport-super-mega-pack-unite-centrale-pc-gamer (1).jpg")
                    ->setQuantite(123)
                    ->setDescription("azertyyyy")
                    ->setCreatedAt(new \DateTime())
                    ->setUserCreated("zeineb");

            $manager->persist($article);
        }

        $manager->flush();
    }
}
