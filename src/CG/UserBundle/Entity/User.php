<?php

namespace CG\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * User
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="CG\UserBundle\Entity\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="UserGroup", inversedBy="users")
     * @ORM\JoinColumn(name="group_id", referencedColumnName="id")
     */
    protected $group;

    /**
     * @var integer
     *
     * @ORM\Column(name="points", type="integer")
     */
    private $points;

    /**
     *
     * @ORM\OneToMany(targetEntity="CG\PlatformBundle\Entity\Donation", mappedBy="user")
     */
    protected $donations;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->donations = new ArrayCollection();
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
     * Get points
     *
     * @return integer 
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * Set points
     *
     * @param int $points
     */
    public function setPoints($points)
    {
        $this->points = $points;

        return $this;
    }

    /**
     * Set group
     *
     * @param \CG\UserBundle\Entity\UserGroup $group
     * @return User
     */
    public function setGroup(\CG\UserBundle\Entity\UserGroup $group = null)
    {
        $this->group = $group;

        return $this;
    }

    /**
     * Get group
     *
     * @return \CG\UserBundle\Entity\UserGroup 
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * Add donations
     *
     * @param \CG\UserBundle\Entity\Donation $donations
     * @return User
     */
    public function addDonation(\CG\UserBundle\Entity\Donation $donations)
    {
        $this->donations[] = $donations;

        return $this;
    }

    /**
     * Remove donations
     *
     * @param \CG\UserBundle\Entity\Donation $donations
     */
    public function removeDonation(\CG\UserBundle\Entity\Donation $donations)
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
