<?php
namespace App\Models;

use App\Entities\Empleado;
use CodeIgniter\Model;

class EmpleadoModel extends Model
{
    protected $table = 'empleados';
    protected $primaryKey = 'id';
    protected $returnType = Empleado::class;
    protected $useSoftDeletes = false;
    protected $useTimestamps = false;

    protected $allowedFields = [
        "id",
        "nombres",
        "usuario_empleado",
        "apellidos",
        "identificacion",
        "tipo_identificacion",
        "celular",
        "direccion",
        "email",
        "estado",
        "fecha_creacion",
        "fecha_modificacion",
        "id_usuario"
    ];

    public function getEmpleados()
    {
        return $this->findAll();
    }

    public function getEmpleadoById(int $id)
    {
        return $this->find($id);
    }
}
