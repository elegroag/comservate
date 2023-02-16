<?php

namespace App\Controllers\RestApi;

use App\Services\UsuarioService;
use CodeIgniter\HTTP\Message;
use CodeIgniter\RESTful\ResourceController;

class UsuariosController extends ResourceController
{

	private $usuarioService;

	public function __construct()
	{
		$this->usuarioService = new UsuarioService();
	}

	public function index()
	{
		return $this->respond($this->usuarioService->getUsuarios());
	}

	public function salvarUsuario()
	{
		try {
			$usuario = $this->request->getJSON();
			$out = $this->usuarioService->createUsuario($usuario);
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

	public function editaUsuario($id)
	{
		try {
			if ($id == null)
				return $this->failNotFound("No dispone de un id correcto para hacer la edición");

			if (is_numeric($id) == FALSE)
				return $this->failNotFound("El recurso no es valido para hacer la edición");

			$usuario = $this->usuarioService->getUsuarioById($id);
			if (!$usuario)
				return $this->failNotFound('El usuario no es valido para actualizar ' . $id);

			$data = (array) $this->request->getJSON();
			if ($this->usuarioService->updateUsuario($id, $data)) :
				return $this->respondUpdated([
					'status' => true,
					'message' => 'Se ha editado con éxito el registro',
					'usuario' => $this->usuarioService->getUsuarioById($id)
				]);
			else :
				return $this->failValidationErrors([
					"message" => "Error de validación servicio de clientes",
					"errors" =>$this->usuarioService->getErrors()
				]);
			endif;
		} catch (\Exception $err) {
			return $this->failServerError($err->getMessage());
		}
	}

	public function showUsuario($id)
	{
		return $this->respond($this->usuarioService->getUsuarioById($id));
	}

	public function removeUsuario($id)
	{
		try {
			if ($id == null)
				return $this->failNotFound("No dispone de un id correcto para hacer el borrado");

			if (is_numeric($id) == FALSE)
				return $this->failNotFound("El recurso no es valido para hacer la edición");

			$usuario = $this->usuarioService->getUsuarioById($id);
			if (!$usuario)
				return $this->failNotFound('El cliente no es valido para actualizar ' . $id);

			if ($this->usuarioService->deleteUsuario($id, $usuario)) :
				return $this->respondUpdated([
					'status' => true,
					'message' => 'Se ha borrado con exito el registro'
				]);
			else :
				return $this->failValidationErrors([
					"message" => "Error de validación servicio de clientes",
					"errors" =>$this->usuarioService->getErrors()
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
	public function requiereUsuario()
	{
		return $this->respond([
			'status' => true,
			'usuarios' => $this->usuarioService->getUsuarios()
		]);
	}

}