<?php
namespace App\Controllers;

class LoginController extends BaseController
{

    public function index()
    {
        helper('tag');
        helper('html');
        return view('inicio/index', ['title'=> 'Inicio']);
    }
}