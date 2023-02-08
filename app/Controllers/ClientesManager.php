<?php
namespace App\Controllers;

class ClientesManager extends BaseController
{
    public function index()
    {
        helper('tag');
        helper('html');
        return view('clientes_manager/listar', ['title'=> 'ClientesManager']);
    }

    public function create()
    {
        helper('tag');
        helper('html');
        return view('clientes_manager/crear', ['title'=> 'ClientesManager']);
    }

}
