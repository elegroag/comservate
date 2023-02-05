<?php
namespace App\Models;

use App\Entities\Municipio;
use CodeIgniter\Model;

class MunicipioModel extends Model
{
    protected $table = 'municipios';
    protected $primaryKey = 'id';
    protected $returnType = Municipio::class;
    protected $useSoftDeletes = false;
    protected $useTimestamps = false;

    protected $allowedFields = [
        "id",
        "municipio",
        "estado",
        "departamento_id"
    ];

    public function getMunicipios()
    {
        return $this->findAll();
    }

    public function getMunicipioById(int $id)
    {
        return $this->find($id);
    }
}
