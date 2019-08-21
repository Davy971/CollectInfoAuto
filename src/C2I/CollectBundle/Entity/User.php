<?php

namespace C2I\CollectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="C2I\CollectBundle\Repository\UserRepository")
 */
class User
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
     * @ORM\Column(name="firstname", type="string", length=255)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=255)
     */
    private $lastname;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_of_birth", type="date")
     */
    private $dateOfBirth;

    /**
     * @var bool
     *
     * @ORM\Column(name="has_driver_licence", type="boolean")
     */
    private $hasDriverLicence;

    /**
    * @ORM\ManyToOne(targetEntity="C2I\CollectBundle\Entity\Car")
    * @ORM\JoinColumn(nullable=false)
    */
    private $car;

    /**
    * @ORM\ManyToOne(targetEntity="C2I\CollectBundle\Entity\Color")
    * @ORM\JoinColumn(nullable=false)
    */
    private $color;

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
     * Set firstname
     *
     * @param string $firstname
     *
     * @return User
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return User
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set dateOfBirth
     *
     * @param \DateTime $dateOfBirth
     *
     * @return User
     */
    public function setDateOfBirth($dateOfBirth)
    {
        $this->dateOfBirth = $dateOfBirth;

        return $this;
    }

    /**
     * Get dateOfBirth
     *
     * @return \DateTime
     */
    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }

    /**
     * Set hasDriverLicence
     *
     * @param boolean $hasDriverLicence
     *
     * @return User
     */
    public function setHasDriverLicence($hasDriverLicence)
    {
        $this->hasDriverLicence = $hasDriverLicence;

        return $this;
    }

    /**
     * Get hasDriverLicence
     *
     * @return bool
     */
    public function getHasDriverLicence()
    {
        return $this->hasDriverLicence;
    }

    /**
     * Set car
     *
     * @param \C2I\CollectBundle\Entity\Car $car
     *
     * @return User
     */
    public function setCar(\C2I\CollectBundle\Entity\Car $car)
    {
        $this->car = $car;

        return $this;
    }

    /**
     * Get car
     *
     * @return \C2I\CollectBundle\Entity\Car
     */
    public function getCar()
    {
        return $this->car;
    }

    /**
     * Set color
     *
     * @param \C2I\CollectBundle\Entity\Color $color
     *
     * @return User
     */
    public function setColor(\C2I\CollectBundle\Entity\Color $color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get color
     *
     * @return \C2I\CollectBundle\Entity\Color
     */
    public function getColor()
    {
        return $this->color;
    }
}
