<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class NewsletterEmail
 * @package App\Entity
 * @ORM\Entity()
 * @ORM\Table(name="email")
 */
class NewsletterEmail
{
    /**
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\GeneratedValue
     * @ORM\Id
     */
    private $id;

    /**
     * @ORM\Column(name="email", type="string", length=60, nullable=false)
     */
    private $email;

    /**
     * @ORM\Column(name="ip", type="string", length=20, nullable=false)
     */
    private $ip;

    /**
     * @ORM\Column(name="datetime", type="datetime", nullable=false)
     */
    private $datetime;

    /**
     * NewsletterEmail constructor.
     */
    public function __construct()
    {

    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * @param mixed $ip
     */
    public function setIp($ip): void
    {
        $this->ip = $ip;
    }

    /**
     * @return mixed
     */
    public function getDatetime()
    {
        return $this->datetime->format('d.m.Y h:m:s');
    }

    /**
     * @param mixed $datetime
     */
    public function setDatetime($datetime): void
    {
        $this->datetime = $datetime;
    }

    public function __toString()
    {
        return $this->id . "# - " . $this->email;
    }


}