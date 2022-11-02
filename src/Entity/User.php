<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * class User
 * @ORM\Entity()
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private string $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     * @var string
     * #[Assert\NotBlank]
     */
    private string $firstName;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     * @var string
     * #[Assert\NotBlank]
     */
    private string $lastName;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     * @var string
     * #[Assert\Email]
     */
    private string $email;

    /**
     * @ORM\Column(type="date", length=255, nullable=false)
     * @var \DateTime
     * #[Assert\NotBlank]
     */
    private \DateTime $birthDate;

    /**
     * @ORM\Column(type="boolean", options={"default" : 0})
     * @var bool
     */
    private bool $active;

    /**
     * User constructor
     */
    public function __construct()
    {
        $this->active = true;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     * @return $this
     */
    public function setFirstName(string $firstName): User
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     * @return $this
     */
    public function setLastName(string $lastName): User
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return $this
     */
    public function setEmail(string $email): User
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getBirthDate(): \DateTime
    {
        return $this->birthDate;
    }

    /**
     * @param \DateTime $birthDate
     * @return $this
     */
    public function setBirthDate(\DateTime $birthDate): User
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     * @return $this
     */
    public function setActive(bool $active): User
    {
        $this->active = $active;

        return $this;
    }
}
