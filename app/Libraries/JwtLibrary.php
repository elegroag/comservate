<?php
namespace App\Libraries;

use App\Services\JwtService;
use \Firebase\JWT\JWT;

class JwtLibrary
{
    private $key;
    private $tipo_autenticacion;
    private $http_cliente;
    private $http_cliente_origen;
    private $jwtService;
    private static $aud = null;

    public function __construct()
    {
        $this->key = "MIIEpAIBAAKCAQEAm4VOHlfwsmXbQ7FRYHxEIDbjI7RgNjKRac0DMvjC5I8VGNfQ";
        self::$aud = (!self::$aud)? $this->locationClient() : self::$aud;
        $this->jwtService = new JwtService();
    }

    public function generateToken($data)
    {
        $payload = array(
            "iss" => base_url(),
            "iat" => time(),
            "exp" => time() + (60*60),
            "aud" => self::$aud,
            "data" => $data
        );
        $token = JWT::encode($payload, $this->key, 'HS256', $keyid= null, $head=null);
        
        $this->jwtService->createJwtIngreso([
            "token" => $token, 
			"dia"  => date('Y-m-d'), 
			"hora" => time(), 
			"http_cliente" => $this->http_cliente, 
			"http_cliente_origen" => $this->http_cliente_origen,
			"consumo" => 1,
			"estado" => 'A'
        ]);
        return $token; 
    }

    public function validateToken($token)
    {
        try
        {
            $decoded = JWT::decode($token, $this->key, array('HS256'));
            //si el cliente es diferente al cliente se debe rechazar el acceso
            if($decoded->aud !== self::$aud){
                throw new \Exception("Invalido el ingreso del api cliente.", 404);
            }
            return (array) $decoded;
        }
        catch (\Exception $e)
        {
            return false;
        }
    }

    private function locationClient()
	{
		$aud = '';
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			$aud = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$aud = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$aud = $_SERVER['REMOTE_ADDR'];
		}
		$this->http_cliente = $aud;
		$this->http_cliente_origen = (isset($_SERVER['HTTP_USER_AGENT']))? $_SERVER['HTTP_USER_AGENT']: "Desconocido"; 
		$this->tipo_autenticacion = (isset($_SERVER['AUTH_TYPE'])?  $_SERVER['AUTH_TYPE']: "Desconocido");

		$aud .= "|". $this->http_cliente_origen; 
		$aud .= "|". gethostname();
		self::$aud = sha1($aud);
	}

    public function get_http_cliente()
	{
		return $this->http_cliente;
	}

	public function get_tipo_autenticacion()
	{
		return $this->tipo_autenticacion;
	}

	public function get_http_cliente_origen()
	{
		return $this->http_cliente_origen;
	}
}