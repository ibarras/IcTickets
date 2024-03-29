<?php



namespace IcFrontendBundle\IcHelpers;


/**
 * Created by PhpStorm.
 * User: mic
 * Date: 10/20/17
 * Time: 4:55 PM
 */

class IcConfig
{

    const LIMITE_PAGINADO_GENERAL = 15;
    const URL_IMAGENES_ACREDITACION = "http://sistemas.xolos.com.mx/uploads/imagen/acreditaciones/";

    const LLAVE = "7493462399a99f683e4640102f6878fba02d0bd7d78a975eeb7acb219eda9f11";

    /*Estatus de tickets*/
    const ESTATUS_NO_ASIGNADO = 1;
    const ESTATUS_ASIGNADO = 2;
    const ESTATUS_TRABAJANDO = 3;
    const ESTATUS_ESPERA = 4;
    const ESTATUS_FINALIZADO = 5;
    const URL_IMAGENES_TICKET = "http://sistemas.xolos.com.mx/uploads/imagen/tickets/";
    const URL_IMAGENES_COMENTARIOS = "http://sistemas.xolos.com.mx/uploads/imagen/comentarios/";
    const IC_ENVIO_EMAIL = true;
    const MAIL_FROM = "contacto@xolos.com.mx";

}