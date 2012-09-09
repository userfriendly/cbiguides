<?php

namespace Sykes\GuideBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Sykes\GuideBundle\Entity\Level;
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
    protected $question;

    /**
     * @ORM\ManyToOne(targetEntity="Level")
     * @ORM\JoinColumn(name="level_id", referencedColumnName="id")
     */
    protected $level;

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
     * Set question
     *
     * @param Sykes\GuideBundle\Entity\Question $question
     * @return Answer
     */
    public function setQuestion( Question $question = null )
    {
        $this->question = $question;
        return $this;
    }

    /**
     * Get question
     *
     * @return Sykes\GuideBundle\Entity\Question 
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set level
     *
     * @param Sykes\GuideBundle\Entity\Level $level
     * @return Answer
     */
    public function setLevel( Level $level = null )
    {
        $this->level = $level;
        return $this;
    }

    /**
     * Get level
     *
     * @return Sykes\GuideBundle\Entity\Level 
     */
    public function getLevel()
    {
        return $this->level;
    }
}