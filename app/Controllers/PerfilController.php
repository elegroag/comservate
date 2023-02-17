<?php
namespace App\Controllers;

use App\Services\UsuarioService;

class PerfilController extends BaseController
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
        return view('perfil_manager/perfil', ['title'=> 'Perfil Usuario', 'usuario'=> json_encode($user)]);
    }
}
