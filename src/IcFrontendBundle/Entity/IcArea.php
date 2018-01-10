<?php

namespace IcFrontendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IcArea
 *
 * @ORM\Table(name="ic_area", indexes={@ORM\Index(name="IDX_41B111D23E83D982", columns={"id_gerencia"})})
 * @ORM\Entity
 */
class IcArea
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_area", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ic_area_id_area_seq", allocationSize=1, initialValue=1)
     */
    private $idArea;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=250, nullable=true)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="correo", type="string", length=250, nullable=true)
     */
    private $correo;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=15, nullable=true)
     */
    private $telefono;

    /**
     * @var \IcGerencia
     *
     * @ORM\ManyToOne(targetEntity="IcGerencia")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_gerencia", referencedColumnName="id_gerencia")
     * })
     */
    private $idGerencia;



    /**
     * Get idArea
     *
     * @return integer
     */
    public function getIdArea()
    {
        return $this->idArea;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return IcArea
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
     * Set correo
     *
     * @param string $correo
     *
     * @return IcArea
     */
    public function setCorreo($correo)
    {
        $this->correo = $correo;

        return $this;
    }

    /**
     * Get correo
     *
     * @return string
     */
    public function getCorreo()
    {
        return $this->correo;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     *
     * @return IcArea
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set idGerencia
     *
     * @param \IcFrontendBundle\Entity\IcGerencia $idGerencia
     *
     * @return IcArea
     */
    public function setIdGerencia(\IcFrontendBundle\Entity\IcGerencia $idGerencia = null)
    {
        $this->idGerencia = $idGerencia;

        return $this;
    }

    /**
     * Get idGerencia
     *
     * @return \IcFrontendBundle\Entity\IcGerencia
     */
    public function getIdGerencia()
    {
        return $this->idGerencia;
    }

    public function __toString()
    {
        return $this->getNombre();   // TODO: Implement __toString() method.
    }
}
