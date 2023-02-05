<?php
namespace App\Services;

use App\Models\ClientModel;

class ClienteService
{
    private $clientModel;

    public function __construct()
    {
        $this->clientModel = new ClientModel;
    }

    public function getClients()
    {
        return $this->clientModel->findAll();
    }

    public function getClientById($id)
    {
        return $this->clientModel->find($id);
    }

    public function createClient($data)
    {
        return $this->clientModel->insert($data);
    }

    public function updateClient($id, $data)
    {
        return $this->clientModel->update($id, $data);
    }

    public function deleteClient($id)
    {
        return $this->clientModel->delete($id);
    }
    
}

