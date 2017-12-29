<?php

namespace IcFrontendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IcHistorialTicket
 *
 * @ORM\Table(name="ic_historial_ticket", indexes={@ORM\Index(name="IDX_929B5694B197184E", columns={"id_ticket"})})
 * @ORM\Entity
 */
class IcHistorialTicket
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ic_historial_ticket_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_modificacion", type="date", nullable=true)
     */
    private $fechaModificacion;

    /**
     * @var string
     *
     * @ORM\Column(name="nuevo_estatus", type="string", length=255, nullable=true)
     */
    private $nuevoEstatus;

    /**
     * @var \IcTicket
     *
     * @ORM\ManyToOne(targetEntity="IcTicket")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_ticket", referencedColumnName="id")
     * })
     */
    private $idTicket;



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set fechaModificacion
     *
     * @param \DateTime $fechaModificacion
     *
     * @return IcHistorialTicket
     */
    public function setFechaModificacion($fechaModificacion)
    {
        $this->fechaModificacion = $fechaModificacion;

        return $this;
    }

    /**
     * Get fechaModificacion
     *
     * @return \DateTime
     */
    public function getFechaModificacion()
    {
        return $this->fechaModificacion;
    }

    /**
     * Set nuevoEstatus
     *
     * @param string $nuevoEstatus
     *
     * @return IcHistorialTicket
     */
    public function setNuevoEstatus($nuevoEstatus)
    {
        $this->nuevoEstatus = $nuevoEstatus;

        return $this;
    }

    /**
     * Get nuevoEstatus
     *
     * @return string
     */
    public function getNuevoEstatus()
    {
        return $this->nuevoEstatus;
    }

    /**
     * Set idTicket
     *
     * @param \IcFrontendBundle\Entity\IcTicket $idTicket
     *
     * @return IcHistorialTicket
     */
    public function setIdTicket(\IcFrontendBundle\Entity\IcTicket $idTicket = null)
    {
        $this->idTicket = $idTicket;

        return $this;
    }

    /**
     * Get idTicket
     *
     * @return \IcFrontendBundle\Entity\IcTicket
     */
    public function getIdTicket()
    {
        return $this->idTicket;
    }
}
