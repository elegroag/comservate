<?php
namespace App\Models;

use App\Entities\Usuario;
use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id';
    protected $returnType = Usuario::class;
    protected $useSoftDeletes = false;
    protected $useTimestamps = false;

    protected $allowedFields = [
        "id",
        "nombres",
        "usuario",
        "fecha_creacion",
        "fecha_modificacion",
        "correo",
        "estado",
        "syncros"
    ];

    public function getUsuarios()
    {
        return $this->findAll();
    }

    public function getUsuarioById(int $id)
    {
        return $this->find($id);
    }
}
