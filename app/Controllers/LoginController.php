<?php
namespace App\Controllers;

use App\Libraries\JwtLibrary;
use App\Models\RolUsuarioModel;
use App\Models\UsuarioModel;
use App\Services\JwtService;
use Config\Services;

class LoginController extends BaseController
{

    private $userModel;
    private $jwtLibrary;
    private $jwtService;
    private $session;

    public function __construct()
    {
        $this->userModel = new UsuarioModel();
        $this->jwtLibrary = new JwtLibrary();
        $this->jwtService = new JwtService();
        $this->session = Services::session();
        helper('tag');
        helper('uri');
    }

    public function index()
    {
        helper('tag');
        helper('html');
        return view('autenticar/login', ['title'=> 'Login']);
    }

    public function validation($jwt)
    {
        try {
            $decoded = $this->jwtLibrary->validateToken($jwt);
            $jwtIngreso = $this->jwtService->getJwtIngresoById($jwt);
            if(!$decoded)
            {
                if($jwtIngreso){
                    $this->jwtService->updateJwtIngreso($jwt, [ "estado"=> "I"]);
                }
                throw new \Exception('Error no es valido el token');
            } else {
                if($jwtIngreso)
                {
                    $this->jwtService->updateJwtIngreso($jwt, [ "consumo"=> $jwtIngreso->consumo + 1]);
                    $user= $this->userModel->getfindByUsername($decoded['data']->username);
                    $id = $decoded['data']->id;
                    if(!$user){
                        throw new \Exception('Error, el usuario que hace consumo del servicio no es valido para ingresar');
                    }

                    $rolesUsuarios = new RolUsuarioModel;
                    $roles = $rolesUsuarios->asArray()->where('id_usuario', $user->id)->findAll();
                    $rolesUsuario = array();
                    foreach ($roles as $rol) 
                    {
                        $rolesUsuario[] = $rol['id_rol']; 
                    }
                    $this->session->set('auth',
                        [
                            'usuario' => $user->usuario,
                            'correo' => $user->correo,
                            'roles' => $rolesUsuario,
                            'id' => $id,
                            'token' => $jwt
                        ]
                    );
                    return redirect('web/inicio');
                } else {
                    throw new \Exception('Error, el token no se almaceno de forma correcta.');
                }
            }
        } catch (\Exception $err) {
            return $this->response->setJSON(array(
                'status' => false,
                'message' => $err->getMessage()
            ));
        }
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect('login');
    }
}