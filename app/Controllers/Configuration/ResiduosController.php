<?php
namespace App\Controllers\Configuration;

use App\Controllers\BaseController;

class ResiduosController extends BaseController
{

    public function index()
    {
        helper('tag');
        helper('html');
        return view('inicio/index', ['title'=> 'Inicio']);
    }
}
