<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use App\Libraries\JwtLibrary;

class AuthController extends BaseController
{
    private $userModel;
    private $jwtLibrary;

    public function __construct()
    {
        $this->userModel = new UsuarioModel;
        $this->jwtLibrary = new JwtLibrary;
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

    public function login()
    {
        $username = $this->request->getPost('username');
        $password = (string) $this->request->getPost('password');

        $user = $this->userModel->findByUsername($username);

        if ($user && password_verify($password, $user->password))
        {
            $data = array(
                'id' => $user->id,
                'username' => $user->username
            );

            $token = $this->jwtLibrary->generateToken($data);

            return $this->response->setJSON(array(
                'status' => true,
                'token' => $token
            ));
        }
        else
        {
            return $this->response->setJSON(array(
                'status' => false,
                'message' => 'Invalid credentials'
            ));
        }
    }
}
