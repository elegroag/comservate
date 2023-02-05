<?php
namespace App\Models;

use App\Entities\Rol;
use CodeIgniter\Model;

class RolModel extends Model
{
    protected $table = 'roles';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = True;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $useTimestamps = true;
    protected $createdField  = 'fecha_creacion';
    protected $updatedField  = 'fecha_modificacion';

    protected $allowedFields = [
        "id",
        "detalle_rol",
        "trial"
    ];

    protected $validationRules      = [
    ];

    protected $validationMessages   = [
    ];

    public function getRoles()
    {
        return $this->findAll();
    }

    public function getRolById(int $id)
    {
        return $this->find($id);
    }
}
