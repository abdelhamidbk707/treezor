<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * class Log
 *
 * @ORM\Entity(repositoryClass="LogRepository")
 * @ORM\Table(name="log")
 * @ORM\HasLifecycleCallbacks
 */
class Log
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private string $id;

    /**
     * @ORM\Column(type="string", length=15)
     * @var string
     */
    private string $ip;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private string $route;

    /**
     * @ORM\Column(name="date", type="datetime")
     */
    private \DateTime $date;

    /**
     * @ORM\PrePersist
     */
    public function onPrePersist()
    {
        $this->date = new \DateTime();
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
    public function getIp(): string
    {
        return $this->ip;
    }

    /**
     * @param string $ip
     * @return $this
     */
    public function setIp(string $ip): Log
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * @return string
     */
    public function getRoute(): string
    {
        return $this->route;
    }

    /**
     * @param string $route
     * @return $this
     */
    public function setRoute(string $route): Log
    {
        $this->route = $route;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDate(): \DateTime
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     * @return $this
     */
    public function setDate(\DateTime $date): Log
    {
        $this->date = $date;

        return $this;
    }
}
