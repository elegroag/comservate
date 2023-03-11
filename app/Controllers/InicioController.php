<?php
namespace App\Controllers;

use App\Services\UsuarioService;

class InicioController extends BaseController
{

    private $usuarioService;

    public function __construct()
    {
        $this->usuarioService = new UsuarioService();
        helper('tag');
        helper('uri');
        helper('html');
    }

    public function index()
    {
        $session = session();
        $auth = $session->get('auth');
        $user = $this->usuarioService->getUsuarioById($auth['id']);
        return view('inicio/index', ['title'=> 'Inicio','usuario'=> json_encode($user)]);
    }

    public function dash()
    {
        helper('tag');
        helper('html');
        $content = view('inicio/index');
        return $this->renderLayout('index', $content, "INICIO SISTEMA", "inicio/index");
    }
}
