<?php
namespace App\Models;

use App\Entities\Recoleccion;
use CodeIgniter\Model;

class RecoleccionModel extends Model
{
    protected $table = 'recoleccion';
    protected $primaryKey = 'id';
    protected $returnType = Recoleccion::class;
    protected $useSoftDeletes = false;
    protected $useTimestamps = false;

    protected $allowedFields = [
        "id",
        "id_rhps",
        "tipo_residuo",
        "cantidad_residuo",
        "syncros"
    ];

    public function getRecolecciones()
    {
        return $this->findAll();
    }

    public function getRecoleccionById(int $id)
    {
        return $this->find($id);
    }
}
