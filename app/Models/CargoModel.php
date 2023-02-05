<?php
namespace App\Models;

use App\Entities\Rol;
use CodeIgniter\Model;

class CargoModel extends Model
{
    protected $table = 'cargos';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = True;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $useTimestamps = true;
    protected $createdField  = 'fecha_creacion';
    protected $updatedField  = 'fecha_modificacion';

    protected $allowedFields = [
        "id",
        "cargo",
        "descripcion",
        "usuario_registra",
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
