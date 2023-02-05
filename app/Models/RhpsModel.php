<?php
namespace App\Models;

use App\Entities\Rhps;
use CodeIgniter\Model;

class RhpsModel extends Model
{
    protected $table = 'rhps';
    protected $primaryKey = 'id';
    protected $returnType = Rhps::class;
    protected $useSoftDeletes = false;
    protected $useTimestamps = false;

    protected $allowedFields = [
        "id",
        "id_cliente",
        "fecha_recoleccion",
        "hora_recoleccion",
        "id_empleado",
        "cantidad_bolsas",
        "cantidad_guardianes",
        "fecha_creacion",
        "usuario_creador",
        "fecha_modificacion",
        "vehiculo",
        "syncros"
    ];

    public function getPaises()
    {
        return $this->findAll();
    }

    public function getPaisById(int $id)
    {
        return $this->find($id);
    }
}
