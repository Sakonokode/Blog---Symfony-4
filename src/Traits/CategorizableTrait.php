<?php
/**
 * Created by PhpStorm.
 * User: coltluger
 * Date: 06/02/19
 * Time: 14:31
 */

namespace Blog\Traits;


use Blog\Entity\Category;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * Trait CategorizableTrait
 * @package Blog\Traits
 */
trait CategorizableTrait
{
    /**
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="Blog\Entity\Category")
     * @ORM\JoinTable(
     *     joinColumns={@ORM\JoinColumn(name="post_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="categories_id", referencedColumnName="id")}
     * )
     */
    protected $categories;

    /**
     * CategorizableTrait constructor.
     */
    public function __construct()
    {
        $this->categories = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getCategories(): ?Collection
    {
        return $this->categories;
    }

    /**
     * @param mixed $categories
     */
    public function setCategories($categories): void
    {
        $this->categories = $categories;
    }

    /**
     * @param Category $category
     */
    public function addCategory(Category $category): void
    {
        if (!$this->categories->contains($category)) {
            $this->categories->add($category);
        }
    }

    /**
     * @param Category $category
     */
    public function removeCategory(Category $category): void
    {
        if ($this->categories->contains($category)) {
            $this->categories->removeElement($category);
        }
    }
}