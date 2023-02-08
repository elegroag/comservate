<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        helper('tag');
        echo 'welcome_message';
    }
}
