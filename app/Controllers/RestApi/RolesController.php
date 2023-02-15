<?php

namespace App\Controllers\RestApi;

use App\Services\RolService;
use CodeIgniter\HTTP\Message;
use CodeIgniter\RESTful\ResourceController;

class RolesController extends ResourceController
{

	private $rolService;

	public function __construct()
	{
		$this->rolService = new RolService();
	}

	public function index()
	{
		return $this->respond($this->rolService->getRoles());
	}

	public function salvarRol()
	{
		try {
			$usuario = $this->request->getJSON();
			$out = $this->rolService->createRol($usuario);
			if (is_numeric($out) &&  $out > 0) :
				$usuario->id = $out;
				return $this->respondCreated([
					"status" => true,
					"usuario" => $usuario
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

	public function editaRol($id)
	{
		try {
			if ($id == null)
				return $this->failNotFound("No dispone de un id correcto para hacer la edición");

			if (is_numeric($id) == FALSE)
				return $this->failNotFound("El recurso no es valido para hacer la edición");

			$usuario = $this->rolService->getRolById($id);
			if (!$usuario)
				return $this->failNotFound('El usuario no es valido para actualizar ' . $id);

			$data = (array) $this->request->getJSON();
			if ($this->rolService->updateRol($id, $data)) :
				return $this->respondUpdated([
					'status' => true,
					'message' => 'Se ha editado con éxito el registro',
					'data' => $data
				]);
			else :
				return $this->failValidationErrors([
					"message" => "Error de validación servicio de clientes",
					"errors" =>$this->rolService->getErrors()
				]);
			endif;
		} catch (\Exception $err) {
			return $this->failServerError($err->getMessage());
		}
	}

	public function showRol($id)
	{
		return $this->respond($this->rolService->getRolById($id));
	}

	public function removeRol($id)
	{
		try {
			if ($id == null)
				return $this->failNotFound("No dispone de un id correcto para hacer el borrado");

			if (is_numeric($id) == FALSE)
				return $this->failNotFound("El recurso no es valido para hacer la edición");

			$usuario = $this->rolService->getRolById($id);
			if (!$usuario)
				return $this->failNotFound('El cliente no es valido para actualizar ' . $id);

			if ($this->rolService->deleteRol($id, $usuario)) :
				return $this->respondUpdated([
					'status' => true,
					'message' => 'Se ha borrado con exito el registro'
				]);
			else :
				return $this->failValidationErrors([
					"message" => "Error de validación servicio de clientes",
					"errors" =>$this->rolService->getErrors()
				]);
			endif;
		} catch (\Exception $err) {
			return $this->failServerError($err->getMessage());
		}
	}

	/**
	 * requiereUsuario function
	 * Recursos requeridos para el registro y creación de clientes
	 * @param string|null $id
	 * @return void
	 */
	public function requiereRol()
	{
		return $this->respond([
			'status' => true,
			'usuarios' => $this->rolService->getRoles()
		]);
	}

}