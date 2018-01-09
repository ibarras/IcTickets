<?php
/**
 * Created by PhpStorm.
 * User: Julio Flores
 * Date: 03/01/18
 * Time: 11:13
 */

namespace IcFrontendBundle\Repository;

use Doctrine\ORM\EntityRepository;
use IcFrontendBundle\IcHelpers\IcConfig;


class IcComentariosRepository extends EntityRepository
{
    public function showAllComents($id)
    {
        $em = $this->getEntityManager();

        $query = $em->createQuery('
				SELECT c
				FROM IcFrontendBundle:IcComentarios c
				WHERE c.idTicket = :id
				')->setParameter('id', $id);

        return $query->getResult();
    }
}
