<?php
/**
 * Created by PhpStorm.
 * User: coltluger
 * Date: 06/02/19
 * Time: 14:25
 */

namespace Blog\Entity;


use Blog\Traits\DescribableTrait;
use Blog\Traits\EntityTrait;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Category
 * @package Blog\Entity
 * @ORM\Entity(repositoryClass="Blog\Repository\CategoryRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Category
{
    use EntityTrait;
    use DescribableTrait;

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string) $this->title;
    }
}