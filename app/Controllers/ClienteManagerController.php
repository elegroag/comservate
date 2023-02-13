<?php
namespace App\Controllers;

class ClienteManagerController extends BaseController
{
    public function index()
    {
        helper('tag');
        helper('html');
        return view('clientes_manager/listar', ['title'=> 'Clientes Manager']);
    }

    public function create()
    {
        helper('tag');
        helper('html');
        return view('clientes_manager/crear', ['title'=> 'Crear Cliente']);
    }

}
