<?php

namespace IcFrontendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IcAcreditacionQr
 *
 * @ORM\Table(name="ic_acreditacion_qr")
 * @ORM\Entity(repositoryClass="IcFrontendBundle\Repository\IcAcreditacionQrRepository")
 */
class IcAcreditacionQr
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
     * @ORM\Column(name="codigo", type="string", length=50)
     */
    private $codigo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="asignado", type="date")
     */
    private $asignado;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="bloqueado", type="date")
     */
    private $bloqueado;

    /**
     * @var bool
     *
     * @ORM\Column(name="estatus", type="boolean")
     */
    private $estatus;

    /**
     * @var string
     *
     * @ORM\Column(name="comentario", type="string", length=250)
     */
    private $comentario;

    /**
     * @var int
     *
     * @ORM\Column(name="tipo", type="integer")
     */


    /**
     * @var \IcAcreditacionTipo
     *
     * @ORM\ManyToOne(targetEntity="IcAcreditacionTipo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_acreditacion_tipo", referencedColumnName="id")
     * })
     */

    private $idAcreditacionTipo;

    /**
     * @var \IcAcreditacion
     *
     * @ORM\ManyToOne(targetEntity="IcAcreditacion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_acreditacion", referencedColumnName="id")
     * })
     */

    private $idAcreditacion;


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
     * Set codigo
     *
     * @param string $codigo
     *
     * @return IcAcreditacionQr
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * Get codigo
     *
     * @return string
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set asignado
     *
     * @param \DateTime $asignado
     *
     * @return IcAcreditacionQr
     */
    public function setAsignado($asignado)
    {
        $this->asignado = $asignado;

        return $this;
    }

    /**
     * Get asignado
     *
     * @return \DateTime
     */
    public function getAsignado()
    {
        return $this->asignado;
    }

    /**
     * Set bloqueado
     *
     * @param \DateTime $bloqueado
     *
     * @return IcAcreditacionQr
     */
    public function setBloqueado($bloqueado)
    {
        $this->bloqueado = $bloqueado;

        return $this;
    }

    /**
     * Get bloqueado
     *
     * @return \DateTime
     */
    public function getBloqueado()
    {
        return $this->bloqueado;
    }

    /**
     * Set estatus
     *
     * @param boolean $estatus
     *
     * @return IcAcreditacionQr
     */
    public function setEstatus($estatus)
    {
        $this->estatus = $estatus;

        return $this;
    }

    /**
     * Get estatus
     *
     * @return bool
     */
    public function getEstatus()
    {
        return $this->estatus;
    }

    /**
     * Set comentario
     *
     * @param string $comentario
     *
     * @return IcAcreditacionQr
     */
    public function setComentario($comentario)
    {
        $this->comentario = $comentario;

        return $this;
    }

    /**
     * Get comentario
     *
     * @return string
     */
    public function getComentario()
    {
        return $this->comentario;
    }

    /**
     * Set tipo
     *
     * @param \IcFrontendBundle\Entity\IcAcreditacionTipo  $idAcreditacionTipo
     * @return IcAcreditacionQr
     */
    public function setIdAcreditacionTipo(\IcFrontendBundle\Entity\IcAcreditacionTipo  $idAcreditacionTipo = null)
    {
        $this->idAcreditacionTipo = $idAcreditacionTipo;

        return $this;
    }

    /**
     * Get idAcreditacionTipo
     *
     * \IcFrontendBundle\Entity\IcAcreditacionTipo
     */
    public function getIdAcreditacionTipo()
    {
        return $this->idAcreditacionTipo;
    }


    /**
     * Set tipo
     *
     * @param \IcFrontendBundle\Entity\IcAcreditacion  $idAcreditacion
     * @return IcAcreditacionQr
     */
    public function setIdAcreditacion(\IcFrontendBundle\Entity\IcAcreditacion  $idAcreditacion = null)
    {
        $this->idAcreditacion = $idAcreditacion;

        return $this;
    }

    /**
     * Get idAcreditacion
     *
     * @return \IcFrontendBundle\Entity\IcAcreditacion
     */
    public function getIdAcreditacion()
    {
        return $this->idAcreditacion;
    }





}

