<?php
namespace App\Controllers;

use App\Libraries\JwtLibrary;
use App\Models\ClienteModel;

class ClientController extends BaseController
{
    protected $filters = [
        'before'=> [
            'jwtauth' => ['except' => ['index', 'show']]
        ]
    ];

    public function index()
    {
        // $model = new ClientModel();
        // $clients = $model->getClients();
        echo 'CLIENTE OK';
        $jwtLibrary = new JwtLibrary();
        $token =  $jwtLibrary->generateToken('8912');
        echo $token;
        // return view('clients/index', ['clients' => $clients]);
    }

    public function show(int $id)
    {
        $model = new ClienteModel();
        $client = $model->getClientById($id);

        return view('clients/show', ['client' => $client]);
    }

    public function create()
    {
        return $this->response->setJSON(array(
            'status' => true,
            'token' => 'OK'
        ));
    }
}
