<?php
namespace App\Controllers;

use App\Services\ClienteService;
use App\Services\UsuarioService;

class ClienteManagerController extends BaseController
{

    private $usuarioService;

    public function __construct()
    {
        $this->usuarioService = new UsuarioService();
    }

    public function index()
    {
        $session = session();
        $auth = $session->get('auth');
        $user = $this->usuarioService->getUsuarioById($auth['id']);
        helper('tag');
        helper('html');
        return view('clientes_manager/listar', ['title'=> 'Clientes Manager', 'usuario' => json_encode($user)]);
    }

}
