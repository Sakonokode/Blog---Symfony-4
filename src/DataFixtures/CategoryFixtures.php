<?php
/**
 * Created by PhpStorm.
 * User: coltluger
 * Date: 06/02/19
 * Time: 14:39
 */

namespace Blog\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Blog\Entity\Category;

class CategoryFixtures extends Fixture
{
    public const CATEGORY_GAMES = 'Games';
    public const CATEGORY_RECIPES = 'Recipes';
    public const CATEGORY_TRAVELS = 'Travels';
    public const CATEGORY_NEWS = 'News';
    public const CATEGORY_TOURNAMENTS = 'Tournaments';

    public const CATEGORIES = [
        self::CATEGORY_GAMES,
        self::CATEGORY_RECIPES,
        self::CATEGORY_TRAVELS,
        self::CATEGORY_NEWS,
        self::CATEGORY_TOURNAMENTS,
    ];

    /** @var ObjectManager $manager */
    private $manager;

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager): void
    {
        $this->manager = $manager;

        foreach (self::CATEGORIES as $iValue) {
            $object = new Category();
            $object->setTitle($iValue);
            $this->manager->persist($object);
            $this->addReference($iValue, $object);
        }

        $this->manager->flush();
    }

    /**
     * @return array
     */
    public function getDependencies(): array
    {
        return [];
    }
}