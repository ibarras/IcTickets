<?php
/**
 * Created by PhpStorm.
 * User: Julio Flores
 * Date: 21/12/17
 * Time: 14:13
 */

namespace IcFrontendBundle\Repository;

use Doctrine\ORM\EntityRepository;
use IcFrontendBundle\IcHelpers\IcConfig;


class IcTicketRepository extends EntityRepository
{
    public function showAllTickets($finalizados = IcConfig::ESTATUS_FINALIZADO)
    {
        $em = $this->getEntityManager();

        $query = $em->createQuery('
				SELECT t
				FROM IcFrontendBundle:IcTicket t
				WHERE NOT t.idEstatus = :finalizados
				ORDER BY t.id DESC
				')->setParameter('finalizados', $finalizados);

        return $query->getResult();
    }
}
