<?php

namespace App\Controllers\RestApi;

use App\Libraries\GmailMailer;
use App\Services\HashService;
use App\Services\UsuarioService;
use CodeIgniter\HTTP\Message;
use CodeIgniter\RESTful\ResourceController;
use Config\Services;

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
			$password = (isset($data['password']))? $data['password'] : false;
			if($password)
			{
				$hashService = new HashService();
				$hash = $hashService->getClaveHash($password, $data['usuario']);
				$data['password'] = $hash;
			}

			if ($this->usuarioService->updateUsuario($id, $data)) 
			{
				$user = $this->usuarioService->getUsuarioById($id);
				if($password)
				{
					$parser = Services::parser();
					$gmailAdapter = new GmailMailer();
					$gmailAdapter->setting(
						['asunto' => 'Recuperación de cuenta Comserva'],
						[
							'mensaje' => $parser->setData([
								'nombres' => $user->nombres,
								'username' => $user->usuario,
								'usuario_clave' => $password
							])->render('autenticar/recovery_parse')
						],
						['emisor' => 'soportesistemas.comfaca@gmail.com'],
						['destino' => $user->correo],
						['nombreEmisor' => 'soportesistemas']
					);
					$gmailAdapter->sendEmail();
				}

				return $this->respondUpdated([
					'status' => true,
					'message' => 'Se ha editado con éxito el registro',
					'usuario' => $user
				]);
			} else {
				return $this->failValidationErrors([
					"message" => "Error de validación servicio de clientes",
					"errors" =>$this->usuarioService->getErrors()
				]);
			}
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