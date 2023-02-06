<?php
namespace App\Models;

use App\Entities\TipoResiduo;
use CodeIgniter\Model;

class TipoResiduoModel extends Model
{
    protected $table = 'tiporesiduo';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $useTimestamps = false;

    protected $allowedFields = [
        "id",
        "descripcion",
        "tipo",
        "syncros"
    ];

    public function getTipoResiduos()
    {
        return $this->findAll();
    }

    public function getTipoResiduoById(int $id)
    {
        return $this->find($id);
    }
}
