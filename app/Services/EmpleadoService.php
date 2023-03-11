<?php

namespace App\Services;

use App\Models\EmpleadoModel;

class EmpleadoService
{
	private $empleadoModel;
	private $errors;

	public function __construct()
	{
		$this->empleadoModel = new EmpleadoModel();
	}

	public function getEmpleados()
	{
		return $this->empleadoModel->whereNotIn('estado',['X'])->findAll();
	}

	public function getEmpleadoById($id)
	{
		return $this->empleadoModel->find($id);
	}

	public function createEmpleado($data)
	{
		if ($this->empleadoModel->insert($data, false) === TRUE) {
			return $this->empleadoModel->getInsertID();
		} else {
			$this->errors = $this->empleadoModel->errors();
			return $this->errors;
		}
	}

	public function updateEmpleado($id, $data)
	{
		if ($this->empleadoModel->update($id, $data) === TRUE) :
			return true;
		else :
			$this->errors = $this->empleadoModel->errors();
			return false;
		endif;
	}

	public function deleteEmpleado($id, $cliente)
	{
		$cliente->estado = 'X';
		if ($this->empleadoModel->update($id, $cliente) === TRUE) :
			return true;
		else :
			$this->errors = $this->empleadoModel->errors();
			return false;
		endif;
	}

	public function getErrors(){
		return $this->errors;
	}
}
