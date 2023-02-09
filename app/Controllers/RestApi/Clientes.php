<?php

namespace App\Controllers\RestApi;

use App\Services\ClienteService;
use CodeIgniter\RESTful\ResourceController;

class Clientes extends ResourceController
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

	public function create()
	{
		try {
			$cliente = $this->request->getJSON();
			$out = $this->clienteService->createClient($cliente);
			if (is_numeric($out) &&  $out > 0) :
				$cliente->id = $out;
				return $this->respondCreated($cliente);
			else :
				return $this->failValidationErrors([
					"message" => "Error de validación servicio de clientes",
					"errors" => $out
				]);
			endif;
		} catch (\Exception $err) {
			return $this->failServerError($err->getMessage());
		}
	}

	public function editCliente($id)
	{
		try {
			if ($id == null)
				return $this->failNotFound("No dispone de un id correcto para hacer la edición");

			if (is_numeric($id) == FALSE)
				return $this->failNotFound("El recurso no es valido para hacer la edición");

			$cliente = $this->clienteService->getClientById($id);
			if (!$cliente)
				return $this->failNotFound('El cliente no es valido para actualizar ' . $id);

			$data = (array) $this->request->getJSON();
			if ($this->clienteService->updateClient($id, $data)) :
				return $this->respondUpdated($data);
			else :
				return $this->failValidationErrors([
					"message" => "Error de validación servicio de clientes",
					"errors" =>$this->clienteService->getErrors()
				]);
			endif;
		} catch (\Exception $err) {
			return $this->failServerError($err->getMessage());
		}
	}

	public function showCliente($id)
	{
		return $this->respond($this->clienteService->getClientById($id));
	}
}
