<?php
/**
 * Created by PhpStorm.
 * User: coltluger
 * Date: 30/01/19
 * Time: 14:34
 */

namespace Blog\Controller;

use Blog\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AdminController as BaseAdminController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class UserController
 * @package Blog\Controller
 * @Security("has_role('ROLE_ADMIN')")
 */
class UserController extends BaseAdminController
{
    /** @var UserPasswordEncoderInterface $passEncoder */
    private $passEncoder;

    /**
     * UserController constructor.
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passEncoder = $passwordEncoder;
    }

    /**
     * @param User $entity
     */
    protected function persistEntity($entity): void
    {
        $password = $this->passEncoder->encodePassword($entity, $entity->getPlainPassword());
        $entity->setPassword($password);

        parent::persistEntity($entity);
    }

    /**
     * @param User $entity
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    protected function updateEntity($entity): void
    {
        $password = $this->passEncoder->encodePassword($entity, $entity->getPlainPassword());
        $entity->setPassword($password);

        $this->em->flush();
    }
}