<?php

namespace IcFrontendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IcTicketAsignado
 *
 * @ORM\Table(name="ic_ticket_asignado", indexes={@ORM\Index(name="IDX_A2DFF03AB197184E", columns={"id_ticket"}), @ORM\Index(name="IDX_A2DFF03AE5311430", columns={"id_usuario_asignado"})})
 * @ORM\Entity
 */
class IcTicketAsignado
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ic_ticket_asignado_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_asignado", type="date", nullable=true)
     */
    private $fechaAsignado;

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
     * @var \IcFosPerfil
     *
     * @ORM\ManyToOne(targetEntity="IcFosPerfil")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_usuario_asignado", referencedColumnName="id_perfil")
     * })
     */
    private $idUsuarioAsignado;



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
     * Set fechaAsignado
     *
     * @param \DateTime $fechaAsignado
     *
     * @return IcTicketAsignado
     */
    public function setFechaAsignado($fechaAsignado)
    {
        $this->fechaAsignado = $fechaAsignado;

        return $this;
    }

    /**
     * Get fechaAsignado
     *
     * @return \DateTime
     */
    public function getFechaAsignado()
    {
        return $this->fechaAsignado;
    }

    /**
     * Set idTicket
     *
     * @param \IcFrontendBundle\Entity\IcTicket $idTicket
     *
     * @return IcTicketAsignado
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

    /**
     * Set idUsuarioAsignado
     *
     * @param \IcFrontendBundle\Entity\IcFosPerfil $idUsuarioAsignado
     *
     * @return IcTicketAsignado
     */
    public function setIdUsuarioAsignado(\IcFrontendBundle\Entity\IcFosPerfil $idUsuarioAsignado = null)
    {
        $this->idUsuarioAsignado = $idUsuarioAsignado;

        return $this;
    }

    /**
     * Get idUsuarioAsignado
     *
     * @return \IcFrontendBundle\Entity\IcFosPerfil
     */
    public function getIdUsuarioAsignado()
    {
        return $this->idUsuarioAsignado;
    }
}
