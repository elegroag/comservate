<?php
namespace App\Models;

use App\Entities\Departamento;
use CodeIgniter\Model;

class DepartamentoModel extends Model
{
    protected $table = 'departamentos';
    protected $primaryKey = 'id';
    protected $returnType = Departamento::class;
    protected $useSoftDeletes = false;
    protected $useTimestamps = false;

    protected $allowedFields = [
        "id",
        "pais",
        "departamento"
    ];

    protected $validationRules      = [
    ];

    protected $validationMessages   = [
    ];

    public function getDepartamentos()
    {
        return $this->findAll();
    }

    public function getDepartamentoById(int $id)
    {
        return $this->find($id);
    }
}
