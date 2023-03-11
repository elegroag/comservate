<?php

namespace App\Services;

use App\Models\MunicipioModel;

class MunicipioService
{
	private $municipioModel;
	private $errors;

	public function __construct()
	{
		$this->municipioModel = new MunicipioModel;
	}

	public function getMunicipios()
	{
		return $this->municipioModel->findAll();
	}

	public function getMunicipioById($id)
	{
		return $this->municipioModel->find($id);
	}

	public function createMunicipio($data)
	{
		if ($this->municipioModel->insert($data, false) === TRUE) {
			return $this->municipioModel->getInsertID();
		} else {
			$this->errors = $this->municipioModel->errors();
			return $this->errors;
		}
	}

	public function updateMunicipio($id, $data)
	{
		if ($this->municipioModel->update($id, $data) === TRUE) :
			return true;
		else :
			$this->errors = $this->municipioModel->errors();
			return false;
		endif;
	}

	public function deleteMunicipio($id)
	{
		if ($this->municipioModel->delete($id) === TRUE) :
			return true;
		else :
			$this->errors = $this->municipioModel->errors();
			return false;
		endif;
	}

	public function getErrors(){
		return $this->errors;
	}
}
