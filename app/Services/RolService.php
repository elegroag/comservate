<?php

namespace App\Services;

use App\Models\RolModel;

class RolService
{
	private $rolModel;
	private $errors;

	public function __construct()
	{
		$this->rolModel = new RolModel();
	}

	public function getRoles()
	{
		return $this->rolModel->whereNotIn('estado', ['X'])->findAll();
	}

	public function getRolById($id)
	{
		return $this->rolModel->find($id);
	}

	public function createRol($data)
	{
		if ($this->rolModel->insert($data, false) === TRUE) {
			return $this->rolModel->getInsertID();
		} else {
			$this->errors = $this->rolModel->errors();
			return $this->errors;
		}
	}

	public function updateRol($id, $data)
	{
		if ($this->rolModel->update($id, $data) === TRUE) :
			return true;
		else :
			$this->errors = $this->rolModel->errors();
			return false;
		endif;
	}

	public function deleteRol($id, $rol)
	{
		$rol->estado = 'X';
		if ($this->rolModel->update($id, $rol) === TRUE) :
			return true;
		else :
			$this->errors = $this->rolModel->errors();
			return false;
		endif;
	}

	public function getErrors(){
		return $this->errors;
	}
}
