<?php
namespace App\Models;

use App\Entities\RolUsuario;
use CodeIgniter\Model;

class RolUsuarioModel extends Model
{
    protected $table = 'roles';
    protected $primaryKey = 'id';
    protected $returnType = RolUsuario::class;
    protected $useSoftDeletes = false;
    protected $useTimestamps = false;

    protected $allowedFields = [
        "id",
        "id_rol",
        "id_usuario",
        "trial"
    ];

    public function getRolesUsuarios()
    {
        return $this->findAll();
    }

    public function getRolUsuarioById(int $id)
    {
        return $this->find($id);
    }
}
