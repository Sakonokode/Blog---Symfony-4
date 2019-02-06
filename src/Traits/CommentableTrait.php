<?php
/**
 * Created by PhpStorm.
 * User: coltluger
 * Date: 06/02/19
 * Time: 12:41
 */

namespace Blog\Traits;


use Blog\Entity\Comment;
use Doctrine\Common\Collections\ArrayCollection;

trait CommentableTrait
{
    /**
     * @var Comment[]|ArrayCollection $comments
     * @ORM\ManyToMany(targetEntity="Blog\Entity\Comment")
     * @ORM\JoinTable(
     *      joinColumns={@ORM\JoinColumn(name="entity_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="comment_id", referencedColumnName="id")}
     *      )
     * @ORM\OrderBy({"created" = "DESC"})
     */
    protected $comments;

    /**
     * @return Comment[]|ArrayCollection
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @param Comment[]|ArrayCollection $comments
     */
    public function setComments($comments): void
    {
        $this->comments = $comments;
    }

    /**
     * @param Comment $comment
     */
    public function addComment(Comment $comment): void
    {
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
        }
    }
}