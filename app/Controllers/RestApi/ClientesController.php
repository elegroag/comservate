<?php

namespace App\Controllers\RestApi;

use App\Services\ClienteService;
use App\Services\MunicipioService;
use CodeIgniter\HTTP\Message;
use CodeIgniter\RESTful\ResourceController;

class ClientesController extends ResourceController
{

	private $clienteService;
	private $municipioService;

	public function __construct()
	{
		$this->clienteService = new ClienteService();
		$this->municipioService= new MunicipioService();
	}

	public function index()
	{
		return $this->respond($this->clienteService->getClients());
	}

	public function salvarCliente()
	{
		try {
			$cliente = $this->request->getJSON();
			$out = $this->clienteService->createClient($cliente);
			if (is_numeric($out) &&  $out > 0) :
				return $this->respondCreated([
					"status" => true,
					"cliente" => $this->clienteService->getClientById($out),
					"message" => "El registro se ha creado con éxito"
				]);
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

	public function editaCliente($id)
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
				return $this->respondUpdated([
					'status' => true,
					'message' => 'Se ha editado con éxito el registro',
					'cliente' => $this->clienteService->getClientById($id)
				]);
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

	public function removeCliente($id)
	{
		try {
			if ($id == null)
				return $this->failNotFound("No dispone de un id correcto para hacer el borrado");

			if (is_numeric($id) == FALSE)
				return $this->failNotFound("El recurso no es valido para hacer la edición");

			$cliente = $this->clienteService->getClientById($id);
			if (!$cliente)
				return $this->failNotFound('El cliente no es valido para actualizar ' . $id);

			if ($this->clienteService->deleteClient($id, $cliente)) :
				return $this->respondUpdated([
					'status' => true,
					'message' => 'Se ha borrado con exito el registro'
				]);
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

	/**
	 * requiereCliente function
	 * Recursos requeridos para el registro y creación de clientes
	 * @param string|null $id
	 * @return void
	 */
	public function requiereCliente()
	{
		return $this->respond([
			'status' => true,
			'clientes' => $this->clienteService->getClients(),
			'municipios' => $this->municipioService->getMunicipios()
		]);
	}
}
