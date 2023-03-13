<?php
namespace App\Controllers\Configuration;

use App\Controllers\BaseController;
use App\Services\UsuarioService;

class MunicipiosController extends BaseController
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
        return view('municipios_manager/index', ['title'=> 'Municipios',  'usuario'=> json_encode($user)]);
    }
}
