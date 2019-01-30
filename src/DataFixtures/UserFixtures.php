<?php

namespace Blog\DataFixtures;

use Blog\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class UserFixtures
 * @package Blog\DataFixtures
 */
class UserFixtures extends Fixture
{
    private const USERS = [
        'Admin 1' => [
            'roles' => [
                'ROLE_ADMIN',
            ],
            'email' => 'admin@admin.com',
            'password' => 'm3p',
            'isActive' => true,

        ],
        'User 1' => [
            'roles' => [
                'ROLE_USER',
            ],
            'email' => 'maxence.attal@gmail.com',
            'password' => 'm3p',
            'isActive' => true,
        ],
        'User 2' => [
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

    /** @var UserPasswordEncoderInterface $passEncoder */
    private $passEncoder;

    /**
     * UserFixtures constructor.
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passEncoder = $passwordEncoder;
    }

    /**
     * @param array $users
     */
    public function addUsers(array $users): void
    {
        foreach ($users as $user => $data) {
            $newUser = new User();
            $newUser->setEmail($data['email']);
            $password = $this->passEncoder->encodePassword($newUser, $data['password']);
            $newUser->setPassword($password);
            $newUser->setIsActive($data['isActive']);
            $newUser->setRoles($data['roles']);
            $this->manager->persist($newUser);
        }
    }

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager): void
    {
        $this->manager = $manager;
        $this->addUsers(self::USERS);
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
