<?php
namespace App\Controllers;

class InicioController extends BaseController
{

    public function __construct()
    {
        helper('tag');
        helper('uri');
        helper('html');
    }

    public function index()
    {
        return view('inicio/index', ['title'=> 'Inicio']);
    }

    public function dash()
    {
        helper('tag');
        helper('html');
        $content = view('inicio/index');
        return $this->renderLayout('index', $content, "INICIO SISTEMA", "inicio/index");
    }
}
