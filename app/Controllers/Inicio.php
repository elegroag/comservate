<?php
namespace App\Controllers;

class Inicio extends BaseController
{
    public function index()
    {
        helper('tag');
        helper('html');
        return view('template/header_main').
                view('inicio/index').
                view('template/footer_main');
    }
}
