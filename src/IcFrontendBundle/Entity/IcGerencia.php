<?php

namespace IcFrontendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IcGerencia
 *
 * @ORM\Table(name="ic_gerencia", indexes={@ORM\Index(name="IDX_DC5FC2FB73B102B2", columns={"id_direccion"})})
 * @ORM\Entity
 */
class IcGerencia
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_gerencia", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ic_gerencia_id_gerencia_seq", allocationSize=1, initialValue=1)
     */
    private $idGerencia;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=250, nullable=true)
     */
    private $nombre;

    /**
     * @var \IcDireccion
     *
     * @ORM\ManyToOne(targetEntity="IcDireccion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_direccion", referencedColumnName="id_direccion")
     * })
     */
    private $idDireccion;



    /**
     * Get idGerencia
     *
     * @return integer
     */
    public function getIdGerencia()
    {
        return $this->idGerencia;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return IcGerencia
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
     * Set idDireccion
     *
     * @param \IcFrontendBundle\Entity\IcDireccion $idDireccion
     *
     * @return IcGerencia
     */
    public function setIdDireccion(\IcFrontendBundle\Entity\IcDireccion $idDireccion = null)
    {
        $this->idDireccion = $idDireccion;

        return $this;
    }

    /**
     * Get idDireccion
     *
     * @return \IcFrontendBundle\Entity\IcDireccion
     */
    public function getIdDireccion()
    {
        return $this->idDireccion;
    }

    public function __toString()
    {
        return $this->getNombre();    // TODO: Implement __toString() method.
    }

}
