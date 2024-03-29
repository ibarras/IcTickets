<?php

namespace IcFrontendBundle\Services;

use Firebase\JWT\JWT;
use IcFrontendBundle\IcHelpers\IcConfig;

class JwtAuth
{
    public $manager;
    public $key;

    public function __construct($manager)
    {
        $this->manager = $manager;
        $this->key = IcConfig::LLAVE;

    }

    public function signup($email, $password, $getHash = NULL)
    {
        $key = $this->key;

        $user = $this->manager->getRepository('IcFrontendBundle:FosUser')->findOneBy(
            array(
                "email" => $email,
                "password" => $password
            )
        );

        $signup = false;
        if (is_object($user)) {
            $signup = true;
        }

        if ($signup == true) {
            $token = array(
                "sub" => $user->getId(),
                "email" => $user->getEmail(),
                "name" => $user->getUsername(),
                "iat" => time(),
                "exp" => time() + (7 * 24 * 60 * 60)
            );


            $jwt = JWT::encode($token, $key, 'HS256');
            $decoded = JWT::decode($jwt, $key, array('HS256'));

            if ($getHash != null) {
                return $jwt;
            } else {
                return $decoded;
            }

        } else {
            return array("status" => "error", "data" => "Login failed !!");
        }
    }

    public function checkToken($jwt, $getIdentity = false)
    {
        $key = $this->key;
        $auth = false;

        try {
            $decoded = JWT::decode($jwt, $key, array('HS256'));

        } catch (\UnexpectedValueException $e) {
            $auth = false;
        } catch (\DomainException $e) {
            $auth = false;
        }

        if (isset($decoded->sub)) {
            $auth = true;
        } else {
            $auth = false;
        }

        if ($getIdentity == true) {
            return $decoded;
        } else {
            return $auth;
        }
    }

}
