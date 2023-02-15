<?php

namespace App\Services;

use App\Models\UsuarioModel;

class UsuarioService
{
	private $usuarioModel;
	private $errors;

	public function __construct()
	{
		$this->usuarioModel = new UsuarioModel();
	}

	public function getUsuarios()
	{
		return $this->usuarioModel->whereNotIn('estado',['X'])->findAll();
	}

	public function getUsuarioById($id)
	{
		return $this->usuarioModel->select('id, nombres, usuario, fecha_creacion, fecha_modificacion, correo,  estado, syncros')->find($id);
	}

	public function createUsuario($data)
	{
		if ($this->usuarioModel->insert($data, false) === TRUE) {
			return $this->usuarioModel->getInsertID();
		} else {
			$this->errors = $this->usuarioModel->errors();
			return $this->errors;
		}
	}

	public function updateUsuario($id, $data)
	{
		if ($this->usuarioModel->update($id, $data) === TRUE) :
			return true;
		else :
			$this->errors = $this->usuarioModel->errors();
			return false;
		endif;
	}

	public function deleteUsuario($id, $usuario)
	{
		$usuario->estado = 'X';
		if ($this->usuarioModel->update($id, $usuario) === TRUE) :
			return true;
		else :
			$this->errors = $this->usuarioModel->errors();
			return false;
		endif;
	}

	public function getErrors(){
		return $this->errors;
	}
}
