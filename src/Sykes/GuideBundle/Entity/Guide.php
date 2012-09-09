<?php

namespace Sykes\GuideBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use Gedmo\Mapping\Annotation as Gedmo;

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
     * @ORM\Column(type="string", length=255)
     */
    protected $name;
    
    /**
     * @ORM\Column(type="text")
     */
    protected $description;
    
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
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(length=255, unique=true)
     */
    protected $slug;
    
    /**
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="updated_at",type="datetime")
     */
    protected $updatedAt;
    
    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="created_at",type="datetime")
     */
    protected $createdAt;
    
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

    /**
     * Set name
     *
     * @param string $name
     * @return Guide
     */
    public function setName($name)
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
     * @return Guide
     */
    public function setDescription($description)
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

    /**
     * Set slug
     *
     * @param string $slug
     * @return Guide
     */
    public function setSlug(  $slug  )
    {
        $this->slug = $slug;
        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Guide
     */
    public function setUpdatedAt(  $updatedAt  )
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Guide
     */
    public function setCreatedAt(  $createdAt  )
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}