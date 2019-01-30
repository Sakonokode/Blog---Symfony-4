<?php
/**
 * Created by PhpStorm.
 * User: coltluger
 * Date: 30/01/19
 * Time: 14:52
 */

namespace Blog\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class PostFixtures extends Fixture
{
    private const POSTS = [
        'Post 1' => [
            'roles' => [
                'ROLE_ADMIN',
            ],
            'email' => 'admin@admin.com',
            'password' => 'm3p',
            'isActive' => true,

        ],
        'Post 2' => [
            'roles' => [
                'ROLE_USER',
            ],
            'email' => 'maxence.attal@gmail.com',
            'password' => 'm3p',
            'isActive' => true,
        ],
        'Post 3' => [
            'roles' => [
                'ROLE_USER',
            ],
            'email' => 'john.doe@gmail.com',
            'password' => 'm3p',
            'isActive' => true,
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



        $this->manager->flush();
    }
}