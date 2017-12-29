<?php

namespace IcFrontendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use IcFrontendBundle\IcHelpers\IcUpload;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * IcTicket
 *
 * @ORM\Table(name="ic_ticket", indexes={@ORM\Index(name="IDX_BB5211579366C0A", columns={"id_usuario_solicitante"}), @ORM\Index(name="IDX_BB52115750BDD1F3", columns={"id_estatus"})})
 * @ORM\Entity
 */
class IcTicket extends IcUpload
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ic_ticket_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_creado", type="date", nullable=true)
     */
    private $fechaCreado;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion_problema", type="text", nullable=true)
     */
    private $descripcionProblema;

    /**
     * @var string
     *
     * @ORM\Column(name="imagen", type="string", length=255, nullable=true)
     */
    private $imagen;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_finalizado", type="date", nullable=true)
     */
    private $fechaFinalizado;

    /**
     * @var \IcFosPerfil
     *
     * @ORM\ManyToOne(targetEntity="IcFosPerfil")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_usuario_solicitante", referencedColumnName="id_perfil")
     * })
     */
    private $idUsuarioSolicitante;

    /**
     * @var \IcEstatusTicket
     *
     * @ORM\ManyToOne(targetEntity="IcEstatusTicket")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_estatus", referencedColumnName="id")
     * })
     */
    private $idEstatus;



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
     * Set fechaCreado
     *
     * @param \DateTime $fechaCreado
     *
     * @return IcTicket
     */
    public function setFechaCreado($fechaCreado)
    {
        $this->fechaCreado = $fechaCreado;

        return $this;
    }

    /**
     * Get fechaCreado
     *
     * @return \DateTime
     */
    public function getFechaCreado()
    {
        return $this->fechaCreado;
    }

    /**
     * Set descripcionProblema
     *
     * @param string $descripcionProblema
     *
     * @return IcTicket
     */
    public function setDescripcionProblema($descripcionProblema)
    {
        $this->descripcionProblema = $descripcionProblema;

        return $this;
    }

    /**
     * Get descripcionProblema
     *
     * @return string
     */
    public function getDescripcionProblema()
    {
        return $this->descripcionProblema;
    }

    /**
     * Set imagen
     *
     * @param string $imagen
     *
     * @return IcTicket
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;

        return $this;
    }

    /**
     * Get imagen
     *
     * @return string
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    public function setIcImagen(File $file = null)
    {
        $i = $this->setFile($file, 'tickets/');
        $this->imagen = $i;

        return $this;

    }

    /**
     * Get
     * @return file
     */
    public function getIcImagen()
    {
        return $this->getFile();
    }

    /**
     * Set fechaFinalizado
     *
     * @param \DateTime $fechaFinalizado
     *
     * @return IcTicket
     */
    public function setFechaFinalizado($fechaFinalizado)
    {
        $this->fechaFinalizado = $fechaFinalizado;

        return $this;
    }

    /**
     * Get fechaFinalizado
     *
     * @return \DateTime
     */
    public function getFechaFinalizado()
    {
        return $this->fechaFinalizado;
    }

    /**
     * Set idUsuarioSolicitante
     *
     * @param \IcFrontendBundle\Entity\IcFosPerfil $idUsuarioSolicitante
     *
     * @return IcTicket
     */
    public function setIdUsuarioSolicitante(\IcFrontendBundle\Entity\IcFosPerfil $idUsuarioSolicitante = null)
    {
        $this->idUsuarioSolicitante = $idUsuarioSolicitante;

        return $this;
    }

    /**
     * Get idUsuarioSolicitante
     *
     * @return \IcFrontendBundle\Entity\IcFosPerfil
     */
    public function getIdUsuarioSolicitante()
    {
        return $this->idUsuarioSolicitante;
    }

    /**
     * Set idEstatus
     *
     * @param \IcFrontendBundle\Entity\IcEstatusTicket $idEstatus
     *
     * @return IcTicket
     */
    public function setIdEstatus(\IcFrontendBundle\Entity\IcEstatusTicket $idEstatus = null)
    {
        $this->idEstatus = $idEstatus;

        return $this;
    }

    /**
     * Get idEstatus
     *
     * @return \IcFrontendBundle\Entity\IcEstatusTicket
     */
    public function getIdEstatus()
    {
        return $this->idEstatus;
    }
}
