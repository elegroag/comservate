<?php

namespace App\Services;

use App\Models\RecoleccionModel;

class RecoleccionService
{
	private $recoleccionModel;
	private $errors;

	public function __construct()
	{
		$this->recoleccionModel = new RecoleccionModel();
	}

	public function getRecolecciones()
	{
		return $this->recoleccionModel->whereNotIn('estado',['X'])->findAll();
	}

	public function getRecoleccionById($id)
	{
		return $this->recoleccionModel->find($id);
	}

	public function createRecoleccion($data)
	{
		if ($this->recoleccionModel->insert($data, false) === TRUE) {
			return $this->recoleccionModel->getInsertID();
		} else {
			$this->errors = $this->recoleccionModel->errors();
			return $this->errors;
		}
	}

	public function updateRecoleccion($id, $data)
	{
		if ($this->recoleccionModel->update($id, $data) === TRUE) :
			return true;
		else :
			$this->errors = $this->recoleccionModel->errors();
			return false;
		endif;
	}

	public function deleteRecoleccion($id, $cliente)
	{
		$cliente->estado = 'X';
		if ($this->recoleccionModel->update($id, $cliente) === TRUE) :
			return true;
		else :
			$this->errors = $this->recoleccionModel->errors();
			return false;
		endif;
	}

	public function getErrors(){
		return $this->errors;
	}
}
