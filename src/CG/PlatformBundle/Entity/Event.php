<?php

namespace CG\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Event
 *
 * @ORM\Table(name="events")
 * @ORM\Entity(repositoryClass="CG\PlatformBundle\Entity\EventRepository")
 */
class Event
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="location", type="string", length=255, nullable=false)
     */
    private $location;

    /**
     * @var string
     *
     * @ORM\Column(name="short_description", type="string", length=255)
     */
    private $shortDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="long_description", type="text")
     */
    private $longDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="link", type="string", length=255, nullable=true)
     */
    private $link;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="worldwideDay", type="datetime")
     */
    private $worldwideDay;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var boolean
     *
     * @ORM\Column(name="enabled", type="boolean")
     */
    private $enabled;

    /**
     *
     * @ORM\OneToMany(targetEntity="Donation", mappedBy="event")
     */
    protected $donations;

    /**
     * @ORM\ManyToOne(targetEntity="DonationKind", cascade={"persist", "remove"}, inversedBy="events")
     * @ORM\JoinColumn(name="donation_kind_id", referencedColumnName="id")
     */
    protected $donationKind;

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
     * @return Event
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
     * Set location
     *
     * @param string $location
     * @return Event
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return string 
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set shortDescription
     *
     * @param string $shortDescription
     * @return Event
     */
    public function setShortDescription($shortDescription)
    {
        $this->shortDescription = $shortDescription;

        return $this;
    }

    /**
     * Get shortDescription
     *
     * @return string 
     */
    public function getShortDescription()
    {
        return $this->shortDescription;
    }

    /**
     * Set longDescription
     *
     * @param string $longDescription
     * @return Event
     */
    public function setLongDescription($longDescription)
    {
        $this->longDescription = $longDescription;

        return $this;
    }

    /**
     * Get longDescription
     *
     * @return string 
     */
    public function getLongDescription()
    {
        return $this->longDescription;
    }

    /**
     * Set link
     *
     * @param string $link
     * @return Event
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get link
     *
     * @return string 
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set worldwideDay
     *
     * @param \DateTime $worldwideDay
     * @return Event
     */
    public function setWorldwideDay($worldwideDay)
    {
        $this->worldwideDay = $worldwideDay;

        return $this;
    }

    /**
     * Get worldwideDay
     *
     * @return \DateTime 
     */
    public function getWorldwideDay()
    {
        return $this->worldwideDay;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Event
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
     * Set enabled
     *
     * @param boolean $enabled
     * @return Event
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return boolean 
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    public function __construct()
    {
        $this->donations = new ArrayCollection();
    }

    /**
     * Add donations
     *
     * @param \CG\PlatformBundle\Entity\Donation $donations
     * @return Event
     */
    public function addDonation(\CG\PlatformBundle\Entity\Donation $donations)
    {
        $this->donations[] = $donations;

        return $this;
    }

    /**
     * Remove donations
     *
     * @param \CG\PlatformBundle\Entity\Donation $donations
     */
    public function removeDonation(\CG\PlatformBundle\Entity\Donation $donations)
    {
        $this->donations->removeElement($donations);
    }

    /**
     * Get donations
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDonations()
    {
        return $this->donations;
    }

    /**
     * Set donationKind
     *
     * @param \CG\PlatformBundle\Entity\DonationKind $donationKind
     * @return Event
     */
    public function setDonationKind(\CG\PlatformBundle\Entity\DonationKind $donationKind = null)
    {
        $this->donationKind = $donationKind;

        return $this;
    }

    /**
     * Get donationKind
     *
     * @return \CG\PlatformBundle\Entity\DonationKind 
     */
    public function getDonationKind()
    {
        return $this->donationKind;
    }

    /**
     * Get the sum of donations
     *
     * @return integer 
     */
    public function getSum()
    {
        $sum = 0;
        foreach ($this->donations as $donation)
        {
            $sum += $donation->getAmount();
        }
        return $sum;
    }

    /**
     * Get the count of donations
     *
     * @return integer 
     */
    public function getCount()
    {
        $count = 0;
        foreach ($this->donations as $donation)
        {
            $count += 1;
        }
        return $count;
    }

    /**
     * Get the average of donations
     *
     * @return float 
     */
    public function getAvg()
    {
        if ($this->getCount() > 0)
        {
            return $this->getSum() / $this->getCount();
        } else {
            return 0.0;
        }
    }

}
