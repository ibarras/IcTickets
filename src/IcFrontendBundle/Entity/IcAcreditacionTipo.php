<?php

namespace IcFrontendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IcAcreditacionTipo
 *
 * @ORM\Table(name="ic_acreditacion_tipo")
 * @ORM\Entity(repositoryClass="IcFrontendBundle\Repository\IcAcreditacionTipoRepository")
 */
class IcAcreditacionTipo
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=250)
     */
    private $nombre;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return IcAcreditacionTipo
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
        return $this->nombre;   // TODO: Implement __toString() method.
    }
}

