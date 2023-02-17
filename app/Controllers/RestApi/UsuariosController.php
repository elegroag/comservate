<?php

namespace App\Controllers\RestApi;

use App\Services\HashService;
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
			$data = (array) $this->request->getJSON();
			if(isset($usuario['password']))
			{
				$hashService = new HashService();
				$usuario['password'] = $hashService->getClaveHash($data['password'], $data['usuario']);
			}
			$out = $this->usuarioService->createUsuario($data);
			if (is_numeric($out) &&  $out > 0) :
				return $this->respondCreated([
					"status" => true,
					"usuario" => $this->usuarioService->getUsuarioById($out),
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
			if(isset($data['password']))
			{
				$hashService = new HashService();
				$data['password'] = $hashService->getClaveHash($data['password'], $data['usuario']);
			}
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
		try {
			if ($id == null)
				return $this->failNotFound("No dispone de un id correcto para buscar el usuario");

			if (is_numeric($id) == FALSE)
				return $this->failNotFound("El id no es valido para hacer la busqueda");

			$usuario = $this->usuarioService->getUsuarioById($id);
			if (!$usuario)
				return $this->failNotFound('El usuario no es valido para buscar ' . $id);
			
			return $this->respond($this->usuarioService->getUsuarioById($id));
		} catch (\Exception $err) {
			return $this->failServerError($err->getMessage());
		}
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
				return $this->failNotFound('El usuario no es valido para actualizar ' . $id);

			if ($this->usuarioService->deleteUsuario($id, $usuario)) :
				return $this->respondUpdated([
					'status' => true,
					'message' => 'Se ha borrado con exito el registro'
				]);
			else :
				return $this->failValidationErrors([
					"message" => "Error de validación servicio de usuarios",
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