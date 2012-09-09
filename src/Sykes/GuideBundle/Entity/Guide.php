<?php

namespace Sykes\GuideBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use Sykes\GuideBundle\Entity\Answer;

/**
 * @ORM\Entity
 * @ORM\Table(name="guide")
 */
class Guide 
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\ManyToMany(targetEntity="Answer")
     * @ORM\JoinTable(name="guide_answer",
     *      joinColumns={@ORM\JoinColumn(name="guide_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="answer_id", referencedColumnName="id")}
     * )
     * @ORM\OrderBy({"question" = "ASC"})
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
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Add answer
     *
     * @param Sykes\GuideBundle\Entity\Answer $answer
     * @return Guide
     */
    public function addAnswer( Answer $answer )
    {
        $this->answers[] = $answer;
        return $this;
    }

    /**
     * Remove answer
     *
     * @param Sykes\GuideBundle\Entity\Answer $answer
     */
    public function removeAnswer( Answer $answer )
    {
        $this->answers->removeElement( $answer );
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