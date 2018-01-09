<?php

namespace IcFrontendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use IcFrontendBundle\IcHelpers\IcUpload;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * IcComentarios
 *
 * @ORM\Table(name="ic_comentarios", indexes={@ORM\Index(name="IDX_902AF46FFCF8192D", columns={"id_usuario"}), @ORM\Index(name="IDX_902AF46FB197184E", columns={"id_ticket"})})
 * @ORM\Entity(repositoryClass="IcFrontendBundle\Repository\IcComentariosRepository")
 */
class IcComentarios extends IcUpload
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ic_comentarios_id_seq", allocationSize=1, initialValue=1)
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
     * @ORM\Column(name="mensaje", type="text", nullable=true)
     */
    private $mensaje;

    /**
     * @var string
     *
     * @ORM\Column(name="imagen", type="string", length=255, nullable=true)
     */
    private $imagen;

    /**
     * @var \IcFosPerfil
     *
     * @ORM\ManyToOne(targetEntity="IcFosPerfil")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_usuario", referencedColumnName="id_perfil")
     * })
     */
    private $idUsuario;

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
     * Set fechaCreado
     *
     * @param \DateTime $fechaCreado
     *
     * @return IcComentarios
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
     * Set mensaje
     *
     * @param string $mensaje
     *
     * @return IcComentarios
     */
    public function setMensaje($mensaje)
    {
        $this->mensaje = $mensaje;

        return $this;
    }

    /**
     * Get mensaje
     *
     * @return string
     */
    public function getMensaje()
    {
        return $this->mensaje;
    }

    /**
     * Set imagen
     *
     * @param string $imagen
     *
     * @return IcComentarios
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
        $i = $this->setFile($file, 'comentarios/');
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
     * Set idUsuario
     *
     * @param \IcFrontendBundle\Entity\IcFosPerfil $idUsuario
     *
     * @return IcComentarios
     */
    public function setIdUsuario(\IcFrontendBundle\Entity\IcFosPerfil $idUsuario = null)
    {
        $this->idUsuario = $idUsuario;

        return $this;
    }

    /**
     * Get idUsuario
     *
     * @return \IcFrontendBundle\Entity\IcFosPerfil
     */
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    /**
     * Set idTicket
     *
     * @param \IcFrontendBundle\Entity\IcTicket $idTicket
     *
     * @return IcComentarios
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
