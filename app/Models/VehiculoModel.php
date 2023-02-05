<?php
namespace App\Models;

use App\Entities\Vehiculo;
use CodeIgniter\Model;

class VehiculoModel extends Model
{
    protected $table = 'vehiculos';
    protected $primaryKey = 'id';
    protected $returnType = Vehiculo::class;
    protected $useSoftDeletes = false;
    protected $useTimestamps = false;

    protected $allowedFields = [
        "id",
        "placa",
        "marca",
        "modelo",
        "estado",
        "id_usuario",
        "fecha_creacion",
        "fecha_modificacion"
    ];

    public function getVehiculos()
    {
        return $this->findAll();
    }

    public function getVehiculoById(int $id)
    {
        return $this->find($id);
    }
}
