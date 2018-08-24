<?php

namespace OC\WestoryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Comment
 *
 * @ORM\Table(name="ocp5_comment")
 * @ORM\Entity(repositoryClass="OC\WestoryBundle\Repository\CommentRepository")
 */
class Comment
{
    /**
     * @ORM\ManyToOne(targetEntity="OC\WestoryBundle\Entity\Story")
     * @ORM\JoinColumn(nullable=false)
     */
    private $story;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="author", type="string", length=255)
     */
    private $author;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="text")
     * @Assert\NotBlank()
     */
    private $message;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="commentDate", type="datetime")
     */
    private $commentDate;

    /**
     * @var int
     *
     * @ORM\Column(name="report", type="integer")
     */
    private $report;


    public function __construct(){
        $this->commentDate = new \Datetime();
        $this->report = 0;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set author
     *
     * @param string $author
     *
     * @return Comment
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set message
     *
     * @param string $message
     *
     * @return Comment
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set commentDate
     *
     * @param \DateTime $commentDate
     *
     * @return Comment
     */
    public function setCommentDate($commentDate)
    {
        $this->commentDate = $commentDate;

        return $this;
    }

    /**
     * Get commentDate
     *
     * @return \DateTime
     */
    public function getCommentDate()
    {
        return $this->commentDate;
    }

    /**
     * Set report
     *
     * @param integer $report
     *
     * @return Comment
     */
    public function setReport($report)
    {
        $this->report = $report;

        return $this;
    }

    /**
     * Get report
     *
     * @return int
     */
    public function getReport()
    {
        return $this->report;
    }

    /**
     * Set story
     *
     * @param \OC\WestoryBundle\Entity\Story $story
     *
     * @return Comment
     */
    public function setStory(\OC\WestoryBundle\Entity\Story $story)
    {
        $this->story = $story;

        return $this;
    }

    /**
     * Get story
     *
     * @return \OC\WestoryBundle\Entity\Story
     */
    public function getStory()
    {
        return $this->story;
    }
}
