<?php

namespace App\Controllers\RestApi;

use App\Services\ClienteService;
use App\Services\MunicipioService;
use CodeIgniter\HTTP\Message;
use CodeIgniter\RESTful\ResourceController;

class MunicipiosController extends ResourceController
{

	private $municipioService;

	public function __construct()
	{
		$this->municipioService= new MunicipioService();
	}

	public function index()
	{
		return $this->respond($this->municipioService->getMunicipios());
	}

	public function salvarMunicipio()
	{
		try {
			$municipio = $this->request->getJSON();
			$out = $this->municipioService->createMunicipio($municipio);
			if (is_numeric($out) &&  $out > 0) :
				$municipio->id = $out;
				return $this->respondCreated([
					"status" => true,
					'message' => 'Registro creado con éxito',
					'data'=>$municipio
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

	public function editaMunicipio($id)
	{
		try {
			if ($id == null)
				return $this->failNotFound("No dispone de un id correcto para hacer la edición");

			if (is_numeric($id) == FALSE)
				return $this->failNotFound("El recurso no es valido para hacer la edición");

			$municipio = $this->municipioService->getMunicipioById($id);
			if (!$municipio)
				return $this->failNotFound('El cliente no es valido para actualizar ' . $id);

			$data = (array) $this->request->getJSON();
			if ($this->municipioService->updateMunicipio($id, $data)) :
				return $this->respondUpdated([
					'status' => true,
					'message' => 'Se ha editado con éxito el registro',
					'data' => $data
				]);
			else :
				return $this->failValidationErrors([
					"message" => "Error de validación servicio de clientes",
					"errors" =>$this->municipioService->getErrors()
				]);
			endif;
		} catch (\Exception $err) {
			return $this->failServerError($err->getMessage());
		}
	}

	public function showMunicipio($id)
	{
		return $this->respond($this->municipioService->getMunicipioById($id));
	}

	public function removeMunicipio($id)
	{
		try {
			if ($id == null)
				return $this->failNotFound("No dispone de un id correcto para hacer el borrado");

			if (is_numeric($id) == FALSE)
				return $this->failNotFound("El recurso no es valido para hacer la edición");

			$municipio = $this->municipioService->getMunicipioById($id);
			if (!$municipio)
				return $this->failNotFound('El cliente no es valido para actualizar ' . $id);

			if ($this->municipioService->deleteMunicipio($id, $municipio)) :
				return $this->respondUpdated([
					'status' => true,
					'message' => 'Se ha borrado con exito el registro'
				]);
			else :
				return $this->failValidationErrors([
					"message" => "Error de validación servicio de clientes",
					"errors" =>$this->municipioService->getErrors()
				]);
			endif;
		} catch (\Exception $err) {
			return $this->failServerError($err->getMessage());
		}
	}

	public function cargueMasivo()
	{
	}
}