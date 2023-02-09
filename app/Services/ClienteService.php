<?php

namespace App\Services;

use App\Models\ClienteModel;

class ClienteService
{
	private $clientModel;
	private $errors;

	public function __construct()
	{
		$this->clientModel = new ClienteModel;
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
		if ($this->clientModel->insert($data, false) === TRUE) {
			return $this->clientModel->getInsertID();
		} else {
			$this->errors = $this->clientModel->errors();
			return $this->errors;
		}
	}

	public function updateClient($id, $data)
	{
		if ($this->clientModel->update($id, $data) === TRUE) :
			return true;
		else :
			$this->errors = $this->clientModel->errors();
			return false;
		endif;
	}

	public function deleteClient($id)
	{
		return $this->clientModel->delete($id);
	}

	public function getErrors(){
		return $this->errors;
	}
}
