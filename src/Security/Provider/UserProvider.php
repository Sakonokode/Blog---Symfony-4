<?php
/**
 * Created by PhpStorm.
 * User: coltluger
 * Date: 30/01/19
 * Time: 10:51
 */

namespace Blog\Security\Provider;


use Blog\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

/**
 * Class UserProvider
 * @package Alexandria\Security\Provider
 */
class UserProvider implements UserProviderInterface
{
    /** @var EntityManagerInterface $manager */
    private $manager;

    /**
     * UserProvider constructor.
     * @param EntityManagerInterface $manager
     */
    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @param string $username
     * @return UserInterface
     */
    public function loadUserByUsername($username): UserInterface
    {
        return $this->fetchUser($username);
    }

    /**
     * @param UserInterface $user
     * @return UserInterface
     */
    public function refreshUser(UserInterface $user): UserInterface
    {
        if (!$user instanceof User) {
            throw new \RuntimeException(
                sprintf('Instances of "%s" are not supported.', get_class($user))
            );
        }

        $username = $user->getUsername();

        return $this->fetchUser($username);
    }

    /**
     * @param string $class
     * @return bool
     */
    public function supportsClass($class): bool
    {
        return User::class === $class;
    }

    /**
     * @param $username
     * @return User|null|object
     */
    private function fetchUser($username)
    {
        $repository = $this->manager->getRepository(User::class);
        $user = $repository->findOneBy(['email' => $username]);

        if (!$user instanceof User) {
            throw new \RuntimeException(
                sprintf('Username "%s" does not exist.', $username)
            );
        }

        return $user;
    }
}