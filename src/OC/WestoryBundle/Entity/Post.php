<?php

namespace OC\WestoryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Post
 *
 * @ORM\Table(name="ocp5_post")
 * @ORM\Entity(repositoryClass="OC\WestoryBundle\Repository\PostRepository")
 */
class Post
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
     * @Assert\Length(
     *      min=200,
     *      max=4000, 
     *      minMessage="Un chapitre doit comporter au minimum {{ limit }} caractères.", 
     *      maxMessage="Un chapitre doit comporter au maximum {{ limit }} caractères."
     * )
     */
    private $message;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="postDate", type="datetime")
     */
    private $postDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="postEditDate", type="datetime", nullable=true)
     */
    private $postEditDate;

    /**
     * @var int
     *
     * @ORM\Column(name="voteNumber", type="integer")
     */
    private $voteNumber;

    /**
     * @var int
     *
     * @ORM\Column(name="reports", type="integer")
     */
    private $reports;

    /**
     * @var boolean
     *
     * @ORM\Column(name="validated", type="boolean")
     */
    private $validated;

    /**
     * @var int
     *
     * @ORM\Column(name="chapter", type="integer", nullable=true)
     */
    private $chapter;


    public function __construct(){
        $this->postDate = new \Datetime();
        $this->voteNumber = 0;
        $this->reports = 0;
        $this->validated = false;
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
     * @return Post
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
     * @return Post
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
     * Set postDate
     *
     * @param \DateTime $postDate
     *
     * @return Post
     */
    public function setPostDate($postDate)
    {
        $this->postDate = $postDate;

        return $this;
    }

    /**
     * Get postDate
     *
     * @return \DateTime
     */
    public function getPostDate()
    {
        return $this->postDate;
    }

    /**
     * Set postEditDate
     *
     * @param \DateTime $postEditDate
     *
     * @return Post
     */
    public function setPostEditDate($postEditDate)
    {
        $this->postEditDate = $postEditDate;

        return $this;
    }

    /**
     * Get postEditDate
     *
     * @return \DateTime
     */
    public function getPostEditDate()
    {
        return $this->postEditDate;
    }

    /**
     * Set voteNumber
     *
     * @param integer $voteNumber
     *
     * @return Post
     */
    public function setVoteNumber($voteNumber)
    {
        $this->voteNumber = $voteNumber;

        return $this;
    }

    /**
     * Get voteNumber
     *
     * @return int
     */
    public function getVoteNumber()
    {
        return $this->voteNumber;
    }

    public function incrementVoteNumber(){
        $this->voteNumber = $this->voteNumber + 1;
        return $this;
    }

    /**
     * Set reports
     *
     * @param integer $reports
     *
     * @return Post
     */
    public function setReports($reports)
    {
        $this->reports = $reports;

        return $this;
    }

    /**
     * Get reports
     *
     * @return int
     */
    public function getReports()
    {
        return $this->reports;
    }

    /**
     * Set story
     *
     * @param \OC\WestoryBundle\Entity\Story $story
     *
     * @return Post
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

    /**
     * Set validated
     *
     * @param boolean $validated
     *
     * @return Post
     */
    public function setValidated($validated)
    {
        $this->validated = $validated;

        return $this;
    }

    /**
     * Get validated
     *
     * @return boolean
     */
    public function getValidated()
    {
        return $this->validated;
    }

    public function incrementReports(){
        $this->reports = $this->reports + 1;
        return $this;
    }

    /**
     * Set chapter
     *
     * @param integer $chapter
     *
     * @return Post
     */
    public function setChapter($chapter)
    {
        $this->chapter = $chapter;

        return $this;
    }

    /**
     * Get chapter
     *
     * @return integer
     */
    public function getChapter()
    {
        return $this->chapter;
    }
}
