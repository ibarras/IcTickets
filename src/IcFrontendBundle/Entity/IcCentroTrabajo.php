<?php

namespace IcFrontendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IcCentroTrabajo
 *
 * @ORM\Table(name="ic_centro_trabajo")
 * @ORM\Entity
 */
class IcCentroTrabajo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_centro", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ic_centro_trabajo_id_centro_seq", allocationSize=1, initialValue=1)
     */
    private $idCentro;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=250, nullable=true)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="string", length=250, nullable=true)
     */
    private $direccion;

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
     * Get idCentro
     *
     * @return integer
     */
    public function getIdCentro()
    {
        return $this->idCentro;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return IcCentroTrabajo
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
     * Set direccion
     *
     * @param string $direccion
     *
     * @return IcCentroTrabajo
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set correo
     *
     * @param string $correo
     *
     * @return IcCentroTrabajo
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
     * @return IcCentroTrabajo
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

    public function __toString()
    {
        return $this->nombre;   // TODO: Implement __toString() method.
    }
}
