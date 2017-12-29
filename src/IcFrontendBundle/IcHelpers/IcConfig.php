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


    public $context;


    public function __construct($context) {
        $this->context = $context;


    }



    /*tipo de solicitudes*/
    const IC_REQUISICION_COMPRA  = 1;
    const IC_SOLICITUD_REEMBOLSO = 2;
    const IC_SOLICITUD_ANTICIPO  = 3;
    const IC_COMPROBACION_GASTOS = 4;

    /*folio para las solicitudes*/
    const IC_CODIGO_SOLICITUD_ANTICIPO = "ICXSANTGXX";
    const IC_CODIGO_SOLICITUD_REQUISICION = "ICXSREQCXX";
    const IC_CODIGO_SOLICITUD_REEMBOLSO = "ICXSREECXX";
    const IC_CODIGO_SOLICITUD_COMPROBACION = "ICXSCOMGXX";

    /*tipos de usuarios*/
    const ROLE_USUARIO = 4;
    const ROLE_CORDINADOR = 3;
    const ROLE_GERENTE = 2;
    const ROLE_DIRECTIVO = 1;

    /*Estatus para las solicitudes*/
    const ESTATUS_INICIO = "INICIO";
    const ESTATUS_PROCESO = "PROCESO";
    const ESTATUS_AUTORIZADO = "AUTORIZADO";
    const ESTATUS_NO_AUTORIZADO = "NOAUTORIZADO";
    const USER_ID = null;

    const LIMITE_PAGINADO_GENERAL = 15;
    const URL_IMAGENES_ACREDITACION = "http://procesos.xolos.com.mx/uploads/imagen/acreditaciones/";

    const LLAVE = "-----BEGIN PRIVATE KEY-----\nMIIEvwIBADANBgkqhkiG9w0BAQEFAASCBKkwggSlAgEAAoIBAQCo2FOs5ZGQFfwC\nlKYRH2urIqrtrlhPNBt1rZhzuhgcmz6OEPRZ2w0EMsLvPLAMbdpp+GTSpPiBNHaj\nR+vl1X7i//djJhHESigAh1Q3/ja7ZIO+Vkw+Q0BK6VkMuWCSJjX2GXm0MimCO7aC\nW/yX5K10kDMuWfCL5Pmw/YNkCa4eGxxsP0GCCEZVf6KphQ42sXGKYeW9ZIEkfkqv\nuPzj0PoYad532yFUZK1FrSQ8ItwjS7hSgwJe88rLtAJtJX8RJYBKObOiRyJzHt0d\nIL1+ShI1t88UDCxY8C5XwVsQR6RfZcJVlRN4Fr6zU5uizeIqh0Uru0TJrL0kAbv0\njEg5/yXtAgMBAAECggEACZGzElQzbv1T+kh27fcAKOOO2Ogd4KVFHiL/xiVImwxw\nW+hZlOMdhnyjACCKILY0H/fgLPEFFXuF8sSPecfjCFX17RRaAuwp/resvfymGPI+\nJjIpYYj5spUtgxNZhgbs3Xz9oQkLwbIFKrewZeJjszy97dVSlPcd8Jo5kVicGeAb\nRKB8FeFWXu6tDwLYu91NzNw9wFiccoobgk49BSNjQr8kQiNKnc7Bhd19g3M0RZW1\nsWX4FKDWE6aP+31NCJBBNFYlNlhxHteQNQjnW9E4ENIEkPxtUjNxusRkNBarnm3A\nO0TS3hiCKG313ga1w+E9DoFZITUsjkLwuSMXwDFyOQKBgQDnuATeWNn9PQtqgCav\n/vKfU5OSgIuLEu0y5v58FLSzRnSATu383NVE1udqOoPFHuwch0MJk9I4IL86WFrs\nU5rw1bvoFpx9Mmr2henNqAeqgfyUn0Qc0FDVLzjrA2X9RbDmb+fToFV7G5+43Vs7\n65PLBk2mqNz24JHWjJvrmpT7WQKBgQC6ia9I28jmDP3/oZhrXh23wNcSHa+sQhXW\nMSGFjliBdwmdIwwSWbmZ17mfIVQeu93xoYo0RJkFVy/f36GuwACtXJXPyPawH4VA\n0oQNeeVvXfwGQ267SGbV6bfF6depZwxCrae54Lk78kKkEZ7YCYAe0psL3j6r/Z4c\nTGY6qHbwtQKBgQCruLwi60XhXjPvoTkKhK3ZVV6v24OOdWBDsNw3qECh+zyrOdM0\n6ZNDiN/G4cZ1dw0Tt0n+9wV7gwk0e/Yl3W+du0eeH+OpBIwwVd2HA1drDRnaKo2X\nrOm6k1xjDgmvQM5wd84eD1xJ95bOsXzDUzob43f4YnwemR57GYkTeWOfQQKBgQCD\nNWm4I/CR8L2Q3AesLg1VPS2Krprs3acifHiJyvByUFrQzuAk4Dvu/JCyX+0dmSOq\nXOgrj7zaxtMD8/d0RdW0G5W9DCyJAgLm76y3FfDOfxtRBImU7n53JOiBK9TocXVs\nSV3bHzjr86HwafyDFVurUpSAqpkGvWRDn3Gg/PJ8qQKBgQCStl08JaB3WtDoK3E/\nbtBIMP5jlbUIoj9KA5BKUJs8rukhFVD7fhGyGdzmX1+OFa5Vt0XCtjN7URW/ayya\n/EXcezk8jvf04ZRYBQZUccWa7kIrh12UTGIf2ZCmDILcaZCpNxSwEp79eElQVyjK\n6EbiMBzPeRtdMwM2rJcClkeXkw==\n-----END PRIVATE KEY-----\n";
}