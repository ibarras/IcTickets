<?php

namespace IcFrontendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IcPuesto
 *
 * @ORM\Table(name="ic_puesto" )
 * @ORM\Entity
 */
class IcPuesto
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_puesto", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ic_puesto_id_puesto_seq", allocationSize=1, initialValue=1)
     */
    private $idPuesto;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=250, nullable=true)
     */
    private $nombre;


    /**
     * Get idPuesto
     *
     * @return integer
     */
    public function getIdPuesto()
    {
        return $this->idPuesto;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return IcPuesto
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    public function __toString()
    {
        return $this->getNombre();   // TODO: Implement __toString() method.
    }
}
