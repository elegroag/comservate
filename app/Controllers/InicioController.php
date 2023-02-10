<?php
namespace App\Controllers;

class InicioController extends BaseController
{

    public function index()
    {
        helper('tag');
        helper('html');
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
