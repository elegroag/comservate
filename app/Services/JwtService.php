<?php
namespace App\Services;

use App\Models\JwtIngresoModel;

class JwtService
{
    private $jwtIngresoModel;

    public function __construct()
    {
        $this->jwtIngresoModel = new JwtIngresoModel;
    }

    public function getJwtIngreso()
    {
        return $this->jwtIngresoModel->findAll();
    }

    public function getJwtIngresoById($id)
    {
        return $this->jwtIngresoModel->find($id);
    }

    public function createJwtIngreso($data)
    {
        return $this->jwtIngresoModel->insert($data);
    }

    public function updateJwtIngreso($id, $data)
    {
        return $this->jwtIngresoModel->update($id, $data);
    }

    public function deleteJwtIngreso($id)
    {
        return $this->jwtIngresoModel->delete($id);
    }

}