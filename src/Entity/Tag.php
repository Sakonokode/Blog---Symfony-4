<?php
/**
 * Created by PhpStorm.
 * User: coltluger
 * Date: 13/02/19
 * Time: 14:35
 */

namespace Blog\Entity;

use Blog\Traits\EntityTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Tag
 * @package Blog\Entity
 */
class Tag
{
    use EntityTrait;

    /**
     * @var string $name
     * @ORM\Column(type="string", unique=true)
     */
    private $name;

    /**
     * @return null|string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize(): string
    {
        // This entity implements JsonSerializable (http://php.net/manual/en/class.jsonserializable.php)
        // so this method is used to customize its JSON representation when json_encode()
        // is called, for example in tags|json_encode (app/Resources/views/form/fields.html.twig)
        return $this->name;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->name;
    }
}