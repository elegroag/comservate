<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        helper('tag');
        return view('welcome_message');
    }
}
