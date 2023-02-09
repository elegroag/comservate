<?php
namespace App\Controllers\RestApi;

use App\Models\UsuarioModel;
use App\Libraries\JwtLibrary;
use App\Services\HashService;
use CodeIgniter\RESTful\ResourceController;
use Exception;

class Auth extends ResourceController
{
    private $userModel;
    private $jwtLibrary;
    private $hashService;

    public function __construct()
    {
        $this->userModel = new UsuarioModel();
        $this->jwtLibrary = new JwtLibrary();
        $this->hashService = new HashService();
    }

    public function index()
    {
        return $this->response->setJSON(array(
            'status' => true,
            '0' => '/auth/login',
            '1' => '/auth/autenticate',
            '2' => '/auth/registrate'
        ));
    }

    public function autenticar()
    {
        try {
            $request = $this->request->getJSON();
            if(!isset($request->username)){
                throw new Exception('Lo siento, no se dispone de usuario para la autenticación', 404);
            }
            if(!isset($request->password)){
                throw new Exception('Lo siento, no se dispone de clave para la autenticación', 404);
            }
            $password = (string) $request->password;
            $user = $this->userModel->getfindByUsername($request->username);
            if ($user && $this->hashService->VerifyHash($password, $user->usuario, $user->password))
            {
                $data = array(
                    'id' => $user->id,
                    'username' => $user->usuario
                );
                $token = $this->jwtLibrary->generateToken($data);
                return $this->respond([
                    'status' => true,
                    'token' => $token
                ]);
            } else {
                throw new Exception('No son validos los criterios para la autenticación', 404);
            }
        } catch (\Exception $err) {
            return $this->respond([
                'status' => false,
                'message' => $err->getMessage()
            ], 400);
        }
    }
}
