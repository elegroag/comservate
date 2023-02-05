<?php
namespace App\Models;

use CodeIgniter\Model;

class CargoEmpleadoModel extends Model
{
    protected $table = 'cargo_empleados';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = True;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $useTimestamps = true;
    protected $createdField  = 'fecha_creacion';
    protected $updatedField  = 'fecha_modificacion';

    protected $allowedFields = [
        "id",
        "id_cargo",
        "id_empleado",
        "syncros"
    ];

    protected $validationRules      = [
    ];

    protected $validationMessages   = [
    ];

    public function getCargos()
    {
        return $this->findAll();
    }

    public function getCargoById(int $id)
    {
        return $this->find($id);
    }
}
