<?php

namespace IcFrontendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IcDireccion
 *
 * @ORM\Table(name="ic_direccion", indexes={@ORM\Index(name="IDX_5A8A173142B686", columns={"id_centro"})})
 * @ORM\Entity
 */
class IcDireccion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_direccion", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ic_direccion_id_direccion_seq", allocationSize=1, initialValue=1)
     */
    private $idDireccion;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=250, nullable=true)
     */
    private $nombre;

    /**
     * @var \IcCentroTrabajo
     *
     * @ORM\ManyToOne(targetEntity="IcCentroTrabajo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_centro", referencedColumnName="id_centro")
     * })
     */
    private $idCentro;



    /**
     * Get idDireccion
     *
     * @return integer
     */
    public function getIdDireccion()
    {
        return $this->idDireccion;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return IcDireccion
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

    /**
     * Set idCentro
     *
     * @param \IcFrontendBundle\Entity\IcCentroTrabajo $idCentro
     *
     * @return IcDireccion
     */
    public function setIdCentro(\IcFrontendBundle\Entity\IcCentroTrabajo $idCentro = null)
    {
        $this->idCentro = $idCentro;

        return $this;
    }

    /**
     * Get idCentro
     *
     * @return \IcFrontendBundle\Entity\IcCentroTrabajo
     */
    public function getIdCentro()
    {
        return $this->idCentro;
    }
}
