<?php

namespace App\Filters;

use App\Libraries\JwtLibrary;
use App\Services\JwtService;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class WebAuth implements FilterInterface
{

    public function before(RequestInterface $request, $data=null)
    {
        try {
            $jwtLibrary = new JwtLibrary();
            $jwtService = new JwtService();
            $session = session();
            $auth = $session->get('auth');
            if(!$auth){
                throw new Exception('Error la sesión del usuario ya ha finalizado.');
            }
            $jwt = $auth['token'];
            $payload = $jwtLibrary->validateToken($jwt);
            $jwtIngreso = $jwtService->getJwtIngresoById($jwt);
            if(!$payload)
            {
                if($jwtIngreso){
                    $jwtService->updateJwtIngreso($jwt, [ "estado"=> "I"]);
                }
                throw new Exception('Error no es valido el token');
            } else {
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
    }

    private function responseUnauthorized(?string $message)
    {
        $session = session();
        $session->destroy();
        return redirect('login');
    }
}
