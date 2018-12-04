<?php
/**
 * Created by PhpStorm.
 * User: billyvivant
 * Date: 04/12/18
 * Time: 14:44
 */

namespace App\DataFixtures;


use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;

class ArticleFixtures extends Fixture implements DependentFixtureInterface

{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        for ($c=0;$c < 5;$c++) {

            for ($i=0; $i<10;$i++) {
                $article = new Article();
                $article->setTitle(mb_strtolower($faker->sentence));
                $article->setContent($faker->text);
                $manager->persist($article);
                $article->setCategory($this->getReference('categorie_' . $c));
                $manager->flush();
            }
        }
    }

    public function getDependencies()
    {
        return [CategoryFixtures::class];
    }
}