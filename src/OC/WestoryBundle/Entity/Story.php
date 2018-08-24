<?php

namespace OC\WestoryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use OC\WestoryBundle\Validator\NoSpam;

/**
 * Story
 *
 * @ORM\Table(name="ocp5_story")
 * @ORM\Entity(repositoryClass="OC\WestoryBundle\Repository\StoryRepository")
 * @UniqueEntity(fields="title", message="Une histoire existe déjà avec ce titre.")
 */
class Story
{
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
     * @ORM\Column(name="title", type="string", length=255, unique=true)
     * @NoSpam()
     * @Assert\Length(
     *      min=2,
     *      max=100, 
     *      minMessage="Le titre doit comporter au minimum {{ limit }} caractères.", 
     *      maxMessage="Le titre doit comporter au maximum {{ limit }} caractères."
     * )
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="author", type="string", length=255)
     */
    private $author;

    /**
     * @var string
     *
     * @ORM\Column(name="intro", type="text")
     * @Assert\Length(
     *      min=200,
     *      max=4000, 
     *      minMessage="Un chapitre doit comporter au minimum {{ limit }} caractères.", 
     *      maxMessage="Un chapitre doit comporter au maximum {{ limit }} caractères."
     * )
     */
    private $intro;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creationDate", type="datetime")
     */
    private $creationDate;

    /**
     * @var int
     *
     * @ORM\Column(name="postNumber", type="integer")
     */
    private $postNumber;

    /**
     * @var int
     *
     * @ORM\Column(name="postLimit", type="integer")
     * @Assert\NotBlank()
     * @Assert\Range(
     *      min=10,
     *      max=50, 
     *      minMessage="Cette valeur doit être supérieure ou égale à {{ limit }}.", 
     *      maxMessage="Cette valeur doit être inférieure ou égale à {{ limit }}."
     * )
     */
    private $postLimit;



    public function __construct(){
        $this->creationDate = new \Datetime();
        $this->postNumber = 1;
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
     * Set title
     *
     * @param string $title
     *
     * @return Story
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set author
     *
     * @param string $author
     *
     * @return Story
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
     * Set creationDate
     *
     * @param \DateTime $creationDate
     *
     * @return Story
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    /**
     * Get creationDate
     *
     * @return \DateTime
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * Set postNumber
     *
     * @param integer $postNumber
     *
     * @return Story
     */
    public function setPostNumber($postNumber)
    {
        $this->postNumber = $postNumber;

        return $this;
    }

    public function incrementPostNumber(){
        $this->postNumber = $this->postNumber + 1;
        return $this;
    }

    /**
     * Get postNumber
     *
     * @return int
     */
    public function getPostNumber()
    {
        return $this->postNumber;
    }

    /**
     * Set postLimit
     *
     * @param integer $postLimit
     *
     * @return Story
     */
    public function setPostLimit($postLimit)
    {
        $this->postLimit = $postLimit;

        return $this;
    }

    /**
     * Get postLimit
     *
     * @return int
     */
    public function getPostLimit()
    {
        return $this->postLimit;
    }

    /**
     * Add post
     *
     * @param \OC\WestoryBundle\Entity\Post $post
     *
     * @return Story
     */
    public function addPost(\OC\WestoryBundle\Entity\Post $post)
    {
        $this->posts[] = $post;

        return $this;
    }

    /**
     * Remove post
     *
     * @param \OC\WestoryBundle\Entity\Post $post
     */
    public function removePost(\OC\WestoryBundle\Entity\Post $post)
    {
        $this->posts->removeElement($post);
    }


    /**
     * Set intro
     *
     * @param string $intro
     *
     * @return Story
     */
    public function setIntro($intro)
    {
        $this->intro = $intro;

        return $this;
    }

    /**
     * Get intro
     *
     * @return string
     */
    public function getIntro()
    {
        return $this->intro;
    }

}
