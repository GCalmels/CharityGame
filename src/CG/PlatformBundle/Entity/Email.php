<?php

namespace CG\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Email
 *
 * @ORM\Table(name="emails")
 * @ORM\Entity(repositoryClass="CG\PlatformBundle\Entity\EmailRepository")
 */
class Email
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="text")
     */
    private $message;

    /**
     * @var array
     *
     * @ORM\Column(name="recipients", type="array")
     */
    private $recipients;

    /**
     * @ORM\ManyToOne(targetEntity="CG\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="sender_id", referencedColumnName="id")
     */
    protected $sender;

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
     * Set message
     *
     * @param string $message
     * @return Email
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string 
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set recipients
     *
     * @param array $recipients
     * @return Email
     */
    public function setRecipients($recipients)
    {
        $this->recipients = $recipients;

        return $this;
    }

    /**
     * Get recipients
     *
     * @return array 
     */
    public function getRecipients()
    {
        return $this->recipients;
    }

    /**
     * Set sender
     *
     * @param \CG\UserBundle\Entity\User $sender
     * @return Email
     */
    public function setSender(\CG\UserBundle\Entity\User $sender = null)
    {
        $this->sender = $sender;

        return $this;
    }

    /**
     * Get sender
     *
     * @return \CG\UserBundle\Entity\User 
     */
    public function getSender()
    {
        return $this->sender;
    }
}
