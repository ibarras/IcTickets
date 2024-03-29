<?php

namespace IcFrontendBundle\Repository;

/**
 * IcAcreditacionRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class IcAcreditacionRepository extends \Doctrine\ORM\EntityRepository
{
    public function getAcreditaciones($inicio = null, $fin = null)
    {
        $em = $this->getEntityManager();

        $query = $em->createQuery('
				SELECT a
				FROM IcFrontendBundle:IcAcreditacionQr a
				JOIN a.idAcreditacion aa
				WHERE aa.id >= :inicio
				AND aa.id <= :fin
				ORDER BY aa.id ASC 
				
				')->setParameter('inicio', $inicio)->setParameter('fin', $fin);

        return $query->getResult();
    }

}
