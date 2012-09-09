<?php

namespace Sykes\GuideBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use Sykes\GuideBundle\Entity\Answer;
use Sykes\GuideBundle\Entity\Category;

/**
 * @ORM\Entity
 * @ORM\Table(name="question")
 */
class Question 
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="text")
     */
    protected $question;
    
    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="questions")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    protected $category;

    /**
     * @ORM\OneToMany(targetEntity="Answer", mappedBy="question")
     */
    protected $answers;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->answers = new ArrayCollection();
    }
    
    /**
     * Get id
     *
     * @return integer \Sykes\GuideBundle\Entity\
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set question
     *
     * @param string $question
     * @return Question
     */
    public function setQuestion( $question )
    {
        $this->question = $question;
    
        return $this;
    }

    /**
     * Get question
     *
     * @return string 
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set category
     *
     * @param Sykes\GuideBundle\Entity\Category $category
     * @return Question
     */
    public function setCategory( Category $category = null )
    {
        $this->category = $category;
    
        return $this;
    }

    /**
     * Get category
     *
     * @return Sykes\GuideBundle\Entity\Category 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Add answers
     *
     * @param Sykes\GuideBundle\Entity\Answer $answers
     * @return Question
     */
    public function addAnswer( Answer $answers )
    {
        $this->answers[] = $answers;
    
        return $this;
    }

    /**
     * Remove answers
     *
     * @param Sykes\GuideBundle\Entity\Answer $answers
     */
    public function removeAnswer( Answer $answers )
    {
        $this->answers->removeElement($answers);
    }

    /**
     * Get answers
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getAnswers()
    {
        return $this->answers;
    }
}