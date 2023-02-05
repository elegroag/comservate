<?php
namespace App\Models;

use App\Entities\Zona;
use CodeIgniter\Model;

class ZonaModel extends Model
{
    protected $table = 'zonas';
    protected $primaryKey = 'id';
    protected $returnType = Zona::class;
    protected $useSoftDeletes = false;
    protected $useTimestamps = true;
    protected $createdField  = 'fecha_creacion';
    protected $updatedField  = 'fecha_modificacion';

    protected $allowedFields = [
        "id",
        "nombre_zona",
        "id_usuario",
        "syncros"
    ];

    public function getZonas()
    {
        return $this->findAll();
    }

    public function getZonaById(int $id)
    {
        return $this->find($id);
    }
}
