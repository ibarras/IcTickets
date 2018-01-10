<?php

namespace IcFrontendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use IcUsuarioBundle\Entity\User;


/**
 * IcFosPerfil
 *
 * @ORM\Table(name="ic_fos_perfil", indexes={@ORM\Index(name="IDX_989974E45CB4216A", columns={"id_area"}), @ORM\Index(name="IDX_989974E4CE25AE0A", columns={"id_categoria"}), @ORM\Index(name="IDX_989974E442B686", columns={"id_centro"}), @ORM\Index(name="IDX_989974E473B102B2", columns={"id_direccion"}), @ORM\Index(name="IDX_989974E43E83D982", columns={"id_gerencia"}), @ORM\Index(name="IDX_989974E461F46733", columns={"id_puesto"}), @ORM\Index(name="IDX_989974E4F9BECC66", columns={"id_subcategoria"})})
 * @ORM\Entity
 */
class IcFosPerfil
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_perfil", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ic_fos_perfil_id_perfil_seq", allocationSize=1, initialValue=1)
     */
    private $idPerfil;

    /**
     * @var \FosUser
     *
     * @ORM\ManyToOne(targetEntity="FosUser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_fos", referencedColumnName="id")
     * })
     */
    private $idFos;


    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=250, nullable=true)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="apellido", type="string", length=250, nullable=true)
     */
    private $apellido;


    /**
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=15, nullable=true)
     */
    private $telefono;

    /**
     * @var \IcArea
     *
     * @ORM\ManyToOne(targetEntity="IcArea")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_area", referencedColumnName="id_area")
     * })
     */
    private $idArea;


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
     * @var \IcDireccion
     *
     * @ORM\ManyToOne(targetEntity="IcDireccion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_direccion", referencedColumnName="id_direccion")
     * })
     */
    private $idDireccion;

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
     * @var \IcPuesto
     *
     * @ORM\ManyToOne(targetEntity="IcPuesto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_puesto", referencedColumnName="id_puesto")
     * })
     */
    private $idPuesto;


    /**
     * @var string
     *
     * @ORM\Column(name="firma", type="string", length=250, nullable=true)
     */
    private $firma;



    /**
     * Get idPerfil
     *
     * @return integer
     */
    public function getIdPerfil()
    {
        return $this->idPerfil;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return IcFosPerfil
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
     * Set apellido
     *
     * @param string $apellido
     *
     * @return IcFosPerfil
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;

        return $this;
    }

    /**
     * Get apellido
     *
     * @return string
     */
    public function getApellido()
    {
        return $this->apellido;
    }


    /**
     * Set telefono
     *
     * @param string $telefono
     *
     * @return IcFosPerfil
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
     * Set idArea
     *
     * @param \IcFrontendBundle\Entity\IcArea $idArea
     *
     * @return IcFosPerfil
     */
    public function setIdArea(\IcFrontendBundle\Entity\IcArea $idArea = null)
    {
        $this->idArea = $idArea;

        return $this;
    }

    /**
     * Get idArea
     *
     * @return \IcFrontendBundle\Entity\IcArea
     */
    public function getIdArea()
    {
        return $this->idArea;
    }

    /**
     * Set idCentro
     *
     * @param \IcFrontendBundle\Entity\IcCentroTrabajo $idCentro
     *
     * @return IcFosPerfil
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

    /**
     * Set idDireccion
     *
     * @param \IcFrontendBundle\Entity\IcDireccion $idDireccion
     *
     * @return IcFosPerfil
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

    /**
     * Set idGerencia
     *
     * @param \IcFrontendBundle\Entity\IcGerencia $idGerencia
     *
     * @return IcFosPerfil
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

    /**
     * Set idPuesto
     *
     * @param \IcFrontendBundle\Entity\IcPuesto $idPuesto
     *
     * @return IcFosPerfil
     */
    public function setIdPuesto(\IcFrontendBundle\Entity\IcPuesto $idPuesto = null)
    {
        $this->idPuesto = $idPuesto;

        return $this;
    }

    /**
     * Get idPuesto
     *
     * @return \IcFrontendBundle\Entity\IcPuesto
     */
    public function getIdPuesto()
    {
        return $this->idPuesto;
    }


    /**
     * Set idFos
     *
     * @param \IcFrontendBundle\Entity\FosUser $idFos
     *
     * @return IcFosPerfil
     */
    public function setIdFos(\IcFrontendBundle\Entity\FosUser $idFos = null)
    {
        $this->idFos = $idFos;

        return $this;
    }

    /**
     * Get idFos
     *
     * @return \IcFrontendBundle\Entity\FosUser
     */
    public function getIdFos()
    {
        return $this->idFos;
    }


    /**
     * Set apellido
     *
     * @param string $firma
     * @return IcFosPerfil
     */
    public function setFirma($firma)
    {
        $this->firma = $firma;

        return $this;
    }

    /**
     * Get firma
     *
     * @return string
     */
    public function getFirma()
    {
        return $this->firma;
    }

    public function __toString()
    {

        return $this->nombre. '  ' . $this->apellido;
    }

}
