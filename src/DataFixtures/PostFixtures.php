<?php
/**
 * Created by PhpStorm.
 * User: coltluger
 * Date: 30/01/19
 * Time: 14:52
 */

namespace Blog\DataFixtures;

use Blog\Entity\Post;
use Blog\Entity\User;
use Blog\Repository\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class PostFixtures extends Fixture implements DependentFixtureInterface
{
    public const POSTS = [
        'Post 1' => [
            'title' => 'Mortal Kombat 11 move and Fatality inputs for currently revealed roster',
            'description' => 'We have officially started filling in our Mortal Kombat 11 moves database where you\'ll be able to find all inputs for all techniques for the upcoming title\'s cast of characters.',
            'content' => 'Wondering how to pull off Geras\' Sand Simulacrum? How about Skarlet\'s Krimson Shield? We\'ve got you covered with Mortal Kombat 11 inputs here on EventHubs.
                We have officially started filling in our Mortal Kombat 11 moves database where you\'ll be able to find all inputs for all techniques for the upcoming title\'s cast of characters.
                At this point we\'ve seen seven fighters showcased including Sonya Blade, Baraka, Skarlet, Scorpion, Raiden, Sub-Zero and Geras. We\'ve kicked off our database with these seven characters, and you can now look through and see all of their techniques including Fatalities.
                As per the usual with our move listings, you can actually vote on which attacks tend to be the most useful, citing any issues or utility you personally see with any given technique.
                We\'ll be updating these pages as NRS reveals more and more of MK11\'s roster, so be sure to check back after new characters are shown.
                If you spot any errors in our Mortal Kombat 11 moves, please be sure to report them to us using the report problem or inaccuracy page located at the bottom of each move list.',
            'author' => 'maxence.attal@gmail.com',

        ],
        'Post 2' => [
            'title' => 'Faster action, less overpowered offense and nerfs to Dragon Rush; let\'s see how Dragon Ball FighterZ\'s changes might affect game play in Season 2',
            'description' => 'It\'s been a jam-packed last few days of exciting new reveals for Dragon Ball FighterZ as Bandai Namco has officially begun setting the stage for 2019.',
            'content' => 'm3p',
            'author' => 'maxence.attal@gmail.com',
        ],
        'Post 3' => [
            'title' => 'Super Smash Bros. Ultimate patch now live, Piranha Plant playable',
            'description' => 'The patch notes for Super Smash Bros. Ultimate are now live as Nintendo America has shared the full list of character changes.',
            'content' => 'm3p',
            'author' => 'maxence.attal@gmail.com',
        ],
    ];

    /** @var ObjectManager $manager */
    private $manager;

    /**
     * @param ObjectManager $manager
     * @throws \Exception
     */
    public function load(ObjectManager $manager): void
    {
        $this->manager = $manager;

        foreach (self::POSTS as $post => $data) {
            $newPost = new Post();
            $newPost->setTitle($data['title']);
            $newPost->setDescription($data['description']);
            $newPost->setContent($data['content']);
            /** @var UserRepository $userRepo */
            $userRepo = $this->manager->getRepository(User::class);
            $author = $userRepo->find(1);
            $newPost->setAuthor($author);
            $this->manager->persist($newPost);
        }

        $this->manager->flush();
    }

    /**
     * @return array
     */
    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
        ];
    }
}