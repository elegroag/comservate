<?php
namespace App\Models;

use CodeIgniter\Model;

class TipoIdentificacionModel extends Model
{
    protected $table = 'tipos_identificacion';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $useTimestamps = false;

    protected $allowedFields = [
        "id",
        "sigla",
        "descripcion"
    ];

    public function getTiposIdentificacion()
    {
        return $this->findAll();
    }

    public function getTipoIdentificacionById(int $id)
    {
        return $this->find($id);
    }
}
