<?php

namespace App\Controllers\RestApi;

use App\Services\ClienteService;
use CodeIgniter\HTTP\Message;
use CodeIgniter\RESTful\ResourceController;

class RecoleccionController extends ResourceController
{

	private $clienteService;

	public function __construct()
	{
		$this->clienteService = new ClienteService();
	}

	public function index()
	{
		return $this->respond($this->clienteService->getClients());
	}
}