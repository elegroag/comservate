<?php

namespace App\Filters;

use App\Libraries\JwtLibrary;
use App\Services\JwtService;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class JwtAuth implements FilterInterface
{
    public function before(RequestInterface $request, $data=null)
    {
        $jwtLibrary = new JwtLibrary();
        $jwtService = new JwtService();

        // Obtener el token del encabezado de autorización
        $request = service('request');
        $header = $request->getHeader('Authorization');

        if (empty($header) || !preg_match('/Bearer\s(\S+)/', $header, $matches)) {
            return $this->responseUnauthorized('Error token de (authorization), no está disponible para su validación');
        }
        $jwt = $matches[1];
        try {
            $payload = $jwtLibrary->validateToken($jwt);
            $jwtIngreso = $jwtService->getJwtIngresoById($jwt);
            if(!$payload){
                if($jwtIngreso){
                    $jwtService->updateJwtIngreso($jwt, [ "estado"=> "I"]);
                }
            }else{
                if($jwtIngreso){
                    $jwtService->updateJwtIngreso($jwt, [ "consumo"=> $jwtIngreso->consumo + 1]);
                }
            }
        } catch (\Exception $e) {
            return $this->responseUnauthorized($e->getMessage());
        }

        // Almacenar el payload en la solicitud para que esté disponible en el controlador
        $request->user = $payload;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $data=null)
    {
        // No se requiere ninguna acción después de la validación
    }

    private function responseUnauthorized(?string $message)
    {
        return service('response')->setStatusCode(401)->setJSON([
            'error' => 'Unauthorized',
            'status' => false,
            'message' => $message
        ]);
    }
}
