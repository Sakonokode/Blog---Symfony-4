<?php
/**
 * Created by PhpStorm.
 * User: coltluger
 * Date: 30/01/19
 * Time: 09:00
 */

namespace Blog\Traits;

use Doctrine\ORM\Mapping as ORM;
use DateTime;

/**
 * Class EntityTrait
 * @package Blog\Traits
 * @ORM\HasLifecycleCallbacks()
 */
trait EntityTrait
{
    /**
     * @var int $id
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @var DateTime $created
     * @ORM\Column(type="datetime")
     */
    protected $created;

    /**
     * @var DateTime $updated
     * @ORM\Column(type="datetime")
     */
    protected $updated;

    /**
     * @var null|DateTime $deleted
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $deleted;

    /**
     * @throws \Exception
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function autoUpdateDates(): void
    {
        if ($this->created === null) {
            $this->created = new \DateTime('NOW');
        }

        $this->updated = new \DateTime('NOW');
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string)$this->id;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return DateTime
     */
    public function getCreated(): DateTime
    {
        return $this->created;
    }

    /**
     * @param DateTime $created
     */
    public function setCreated(DateTime $created): void
    {
        $this->created = $created;
    }

    /**
     * @return DateTime
     */
    public function getUpdated(): DateTime
    {
        return $this->updated;
    }

    /**
     * @param DateTime $updated
     */
    public function setUpdated(DateTime $updated): void
    {
        $this->updated = $updated;
    }

    /**
     * @return DateTime
     */
    public function getDeleted(): DateTime
    {
        return $this->deleted;
    }

    /**
     * @param DateTime $deleted
     */
    public function setDeleted(DateTime $deleted = null): void
    {
        $this->deleted = $deleted;
    }
}