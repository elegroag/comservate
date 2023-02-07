<?php
namespace App\Controllers;

class Inicio extends BaseController
{

    public function index()
    {
        helper('tag');
        helper('html');
        $content = view('inicio/index');
        return $this->renderLayout('index', $content, "INICIO SISTEMA", "inicio/index");
    }
}
