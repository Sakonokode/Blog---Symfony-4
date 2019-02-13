<?php
/**
 * Created by PhpStorm.
 * User: coltluger
 * Date: 30/01/19
 * Time: 14:43
 */

namespace Blog\Entity;


use Blog\Traits\CategorizableTrait;
use Blog\Traits\CommentableTrait;
use Blog\Traits\DescribableTrait;
use Blog\Traits\EntityTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Post
 * @package Blog\Entity
 * @ORM\Entity(repositoryClass="Blog\Repository\PostRepository")
 * @ORM\Table(name="posts")
 * @ORM\HasLifecycleCallbacks()
 */
class Post
{
    use EntityTrait;
    use DescribableTrait;
    use CommentableTrait;
    use CategorizableTrait;

    /**
     * @var string $content
     *
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="post.blank_content")
     * @Assert\Length(min=10, minMessage="post.too_short_content")
     */
    private $content;

    /**
     * @var User $author
     *
     * @ORM\ManyToOne(targetEntity="Blog\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $author;

    /**
     * @var Tag[]|ArrayCollection $tags
     * @ORM\ManyToMany(targetEntity="Blog\Entity\Tag", cascade={persist})
     * @ORM\JoinTable(name="post_tag")
     * @ORM\OrderBy({"name": "ASC"})
     */
    private $tags;

    /**
     * Post constructor.
     */
    public function __construct()
    {
        $this->tags = new ArrayCollection();
    }

    /**
     * @param Tag ...$tags
     */
    public function addTag(Tag ...$tags): void
    {
        foreach ($tags as $tag) {
            if (!$this->tags->contains($tag)) {
                $this->tags->add($tag);
            }
        }
    }

    /**
     * @param Tag $tag
     */
    public function removeTag(Tag $tag): void
    {
        $this->tags->removeElement($tag);
    }

    /**
     * @return null|string
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    /**
     * @return User
     */
    public function getAuthor(): User
    {
        return $this->author;
    }

    /**
     * @param User $author
     */
    public function setAuthor(User $author): void
    {
        $this->author = $author;
    }

    /**
     * @return Tag[]|ArrayCollection
     */
    public function getTags(): ArrayCollection
    {
        return $this->tags;
    }

    /**
     * @param Tag[]|ArrayCollection $tags
     */
    public function setTags($tags): void
    {
        $this->tags = $tags;
    }
}