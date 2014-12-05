<?php

namespace CG\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * DonationKind
 *
 * @ORM\Table(name="donation_kinds")
 * @ORM\Entity(repositoryClass="CG\PlatformBundle\Entity\DonationKindRepository")
 */
class DonationKind
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
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var array
     *
     * @ORM\Column(name="gain", type="array")
     */
    private $gain;

    /**
     *
     * @ORM\OneToMany(targetEntity="Event", mappedBy="donationKind")
     */
    protected $events;

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
     * Set description
     *
     * @param string $description
     * @return DonationKind
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
     * Set gain
     *
     * @param array $gain
     * @return DonationKind
     */
    public function setGain($gain)
    {
        $this->gain = $gain;

        return $this;
    }

    /**
     * Get gain
     *
     * @return array 
     */
    public function getGain()
    {
        return $this->gain;
    }

    public function __construct()
    {
        $this->events = new ArrayCollection();
    }

    /**
     * Add events
     *
     * @param \CG\PlatformBundle\Entity\Event $events
     * @return DonationKind
     */
    public function addEvent(\CG\PlatformBundle\Entity\Event $events)
    {
        $this->events[] = $events;

        return $this;
    }

    /**
     * Remove events
     *
     * @param \CG\PlatformBundle\Entity\Event $events
     */
    public function removeEvent(\CG\PlatformBundle\Entity\Event $events)
    {
        $this->events->removeElement($events);
    }

    /**
     * Get events
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEvents()
    {
        return $this->events;
    }
}
