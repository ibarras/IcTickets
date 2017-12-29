<?php

namespace IcFrontendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use IcFrontendBundle\IcHelpers\IcUpload;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * IcAcreditacion
 *
 * @ORM\Table(name="ic_acreditacion")
 * @ORM\Entity(repositoryClass="IcFrontendBundle\Repository\IcAcreditacionRepository")
 */
class IcAcreditacion extends IcUpload
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ic_acreditacion_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;


    /**
     * @var \IcFosPerfil
     *
     * @ORM\ManyToOne(targetEntity="IcFosPerfil")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_fos_perfil", referencedColumnName="id_perfil")
     * })
     */
    private $idFosPerfil;

    /**
     * @var string
     *
     * @ORM\Column(name="solicitante", type="string", length=250)
     */
    private $solicitante;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_en_acreditacion", type="string", length=250)
     */
    private $nombreEnAcreditacion;

    /**
     * @var string
     *
     * @ORM\Column(name="puesto", type="string", length=250)
     */
    private $puesto;

    /**
     * @var string
     *
     * @ORM\Column(name="patrocinador", type="string", length=250)
     */
    private $patrocinador;

    /**
     * @var string
     *
     * @ORM\Column(name="fotografia", type="string", length=250)
     */
    private $fotografia;




//    /**
//     * @var \IcAcreditacionQr
//     *
//     * @ORM\ManyToOne(targetEntity="IcAcreditacionQr")
//     * @ORM\JoinColumns({
//     *   @ORM\JoinColumn(name="id_acreditacion_qr", referencedColumnName="id")
//     * })
//     */
//    private $idAcreditacionQr;



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
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text")
     */
    private $descripcion;

    /**
     * @var int
     *
     * @ORM\Column(name="cantidad", type="integer")
     */
    private $cantidad;



    public function  __construct()
    {
        $this->cantidad = 1;
    }

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
     * Set idFosPerfil
     *
     * @param \IcFrontendBundle\Entity\IcFosPerfil $idFosPerfil
     * @return IcAcreditacion
     */
    public function setIdFosPerfil(\IcFrontendBundle\Entity\IcFosPerfil $idFosPerfil)
    {
        $this->idFosPerfil = $idFosPerfil;

        return $this;
    }


    /**
     * Get idFosPerfil
     *
     * @return \IcFrontendBundle\Entity\IcFosPerfil
     */
    public function getIdFosPerfil()
    {
        return $this->idFosPerfil;
    }

    /**
     * Set solicitante
     *
     * @param string $solicitante
     *
     * @return IcAcreditacion
     */
    public function setSolicitante($solicitante)
    {
        $this->solicitante = $solicitante;

        return $this;
    }

    /**
     * Get solicitante
     *
     * @return string
     */
    public function getSolicitante()
    {
        return $this->solicitante;
    }

    /**
     * Set nombreEnAcreditacion
     *
     * @param string $nombreEnAcreditacion
     *
     * @return IcAcreditacion
     */
    public function setNombreEnAcreditacion($nombreEnAcreditacion)
    {
        $this->nombreEnAcreditacion = $nombreEnAcreditacion;

        return $this;
    }

    /**
     * Get nombreEnAcreditacion
     *
     * @return string
     */
    public function getNombreEnAcreditacion()
    {
        return $this->nombreEnAcreditacion;
    }

    /**
     * Set puesto
     *
     * @param string $puesto
     *
     * @return IcAcreditacion
     */
    public function setPuesto($puesto)
    {
        $this->puesto = $puesto;

        return $this;
    }

    /**
     * Get puesto
     *
     * @return string
     */
    public function getPuesto()
    {
        return $this->puesto;
    }

    /**
     * Set patrocinador
     *
     * @param string $patrocinador
     *
     * @return IcAcreditacion
     */
    public function setPatrocinador($patrocinador)
    {
        $this->patrocinador = $patrocinador;

        return $this;
    }

    /**
     * Get patrocinador
     *
     * @return string
     */
    public function getPatrocinador()
    {
        return $this->patrocinador;
    }

    /**
     * Set fotografia
     *
     * @param string $fotografia
     *
     * @return IcAcreditacion
     */
    public function setFotografia($fotografia)
    {
        $this->fotografia = $fotografia;

        return $this;
    }

    /**
     * Get fotografia
     *
     * @return string
     */
    public function getFotografia()
    {
        return $this->fotografia;
    }



    public function setIcImagen(File $file = null)
    {
        $i = $this->setFile($file, 'acreditaciones/');
        $this->fotografia = $i;

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


//    /**
//     * Set idAcreditacionQr
//     *
//     * @param \IcFrontendBundle\Entity\IcAcreditacionQr $idAcreditacionQr
//     *
//     * @return IcAcreditacion
//     */
//    public function setIdAcreditacionQr(\IcFrontendBundle\Entity\IcAcreditacionQr $idAcreditacionQr)
//    {
//        $this->idAcreditacionQr = $idAcreditacionQr;
//
//        return $this;
//    }
//
//    /**
//     * Get idAcreditacionQr
//     *
//     * @return \IcFrontendBundle\Entity\IcAcreditacionQr
//     */
//    public function getIdAcreditacionQr()
//    {
//        return $this->idAcreditacionQr;
//    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return IcAcreditacion
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set cantidad
     *
     * @param integer $cantidad
     *
     * @return IcAcreditacion
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    /**
     * Get cantidad
     *
     * @return int
     */
    public function getCantidad()
    {
        return $this->cantidad;
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
     * Get tipo
     *
     * \IcFrontendBundle\Entity\IcAcreditacionTipo
     */
    public function getIdAcreditacionTipo()
    {
        return $this->idAcreditacionTipo;
    }

}

