<?php

namespace Sykes\GuideBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Sykes\GuideBundle\Entity\Question;

/**
 * @ORM\Entity
 * @ORM\Table(name="answer")
 */
class Answer 
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
    protected $answer;

    /**
     * @ORM\ManyToOne(targetEntity="Question", inversedBy="answers")
     * @ORM\JoinColumn(name="question_id", referencedColumnName="id")
     */    
    protected $category;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set answer
     *
     * @param string $answer
     * @return Answer
     */
    public function setAnswer( $answer )
    {
        $this->answer = $answer;
        return $this;
    }

    /**
     * Get answer
     *
     * @return string 
     */
    public function getAnswer()
    {
        return $this->answer;
    }

    /**
     * Set category
     *
     * @param Sykes\GuideBundle\Entity\Question $category
     * @return Answer
     */
    public function setCategory( Question $category = null )
    {
        $this->category = $category;
        return $this;
    }

    /**
     * Get category
     *
     * @return Sykes\GuideBundle\Entity\Question 
     */
    public function getCategory()
    {
        return $this->category;
    }
}