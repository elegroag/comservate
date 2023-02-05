<?php
namespace App\Models;

use App\Entities\Pais;
use CodeIgniter\Model;

class PaisModel extends Model
{
    protected $table = 'paises';
    protected $primaryKey = 'id';
    protected $returnType = Pais::class;
    protected $useSoftDeletes = false;
    protected $useTimestamps = false;

    protected $allowedFields = [
        "id",
        "pais"
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
