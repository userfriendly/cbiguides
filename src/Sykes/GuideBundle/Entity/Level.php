<?php

/***
 * 
 * This is a level of competences, or difficulties for the expected answer:
 * 
 *      a candidate might be asked for how knowledgeable he is with website
 *      but the expected answer could be one of the following depending on the
 *      level:
 * 
 *      - an interface for communicating between customer and companies on the 
 *          internet;
 *      - a piece of software used to convey information for a entity and served
 *          via the internet and rendered through a web-browser
 * 
 */

namespace Sykes\GuideBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="level")
 */
class Level
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $description;
    
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
     * Set name
     *
     * @param string $name
     * @return Level
     */
    public function setName( $name )
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * Set description
     *
     * @param string $description
     * @return Level
     */
    public function setDescription( $description )
    {
        $this->description = $description;
        return $this;
    }
    
    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }
    
    
    public function __toString()
    {
        return $this->name;
    }
}