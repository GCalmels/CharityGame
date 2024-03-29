<?php

namespace CG\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Donation
 *
 * @ORM\Table(name="donations")
 * @ORM\Entity(repositoryClass="CG\PlatformBundle\Entity\DonationRepository")
 */
class Donation
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
     * @var float
     *
     * @ORM\Column(name="amount", type="float")
     */
    private $amount;

    /**
     * @var string
     *
     * @ORM\Column(name="currency", type="string", length=255)
     */
    private $currency;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="CG\UserBundle\Entity\User", inversedBy="donations")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * @ORM\ManyToOne(targetEntity="Event", inversedBy="donations")
     * @ORM\JoinColumn(name="event_id", referencedColumnName="id")
     */
    protected $event;

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
     * Set amount
     *
     * @param float $amount
     * @return Donation
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set currency
     *
     * @param string $currency
     * @return Donation
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Get currency
     *
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Donation
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set user
     *
     * @param \CG\UserBundle\Entity\User $user
     * @return Donation
     */
    public function setUser(\CG\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \CG\PlatformBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set event
     *
     * @param \CG\PlatformBundle\Entity\Event $event
     * @return Donation
     */
    public function setEvent(\CG\PlatformBundle\Entity\Event $event = null)
    {
        $this->event = $event;

        return $this;
    }

    /**
     * Get event
     *
     * @return \CG\PlatformBundle\Entity\Event
     */
    public function getEvent()
    {
        return $this->event;
    }
}
