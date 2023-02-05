<?php
namespace App\Models;

use App\Entities\Cliente;
use CodeIgniter\Model;

class ClienteModel extends Model
{
    protected $table = 'clientes';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = True;
    protected $returnType = Cliente::class;
    protected $useSoftDeletes = False;
    protected $useTimestamps = True;
    protected $skipValidation = False;
    protected $cleanValidationRules = True;
    protected $createdField  = 'fecha_creacion';
    protected $updatedField  = 'fecha_modificacion';

    /**
     * allowedFields variable
     * syncros = |id_usuario1||id_usuario2||id_usuario3||id_usuario4|
     * @var array
     */
    protected $allowedFields = [
        "id",
        "cedula",
        "nit",
        "afiliado", /*nombre empresa afiliado*/
        "representante",
        "ruta",
        "id_municipio",
        "frecuencia",
        "contrato",
        "fecha_finalizacion",
        "valor_kilo",
        "kilos",
        "valor_kilo_adicional",
        "direccion",
        "telefono",
        "barrio",
        "correo",
        "especiales",
        "fecha_creacion",
        "fecha_modificacion",
        "usuario_creador",
        "estado",
        "mapa",
        "syncros"
    ];

    protected $validationRules      = [
    ];

    protected $validationMessages   = [
    ];    

    public function getClientes()
    {
        return $this->findAll();
    }

    public function getClienteById(int $id)
    {
        return $this->find($id);
    }
}
