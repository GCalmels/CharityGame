<?php

namespace CG\PlatformBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * EventRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class EventRepository extends EntityRepository
{
	public function findByEnabledWithOrder($enabled)
    {
        return $this->findBy(array('enabled' => $enabled), array('id' => 'DESC'));
    }

}
