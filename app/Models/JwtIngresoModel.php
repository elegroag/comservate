<?php
namespace App\Models;

use App\Entities\JwtIngreso;
use CodeIgniter\Model;

class JwtIngresoModel extends Model
{
    protected $table = 'jwt_ingreso';
    protected $primaryKey = 'token';
    protected $useSoftDeletes = false;
    protected $useTimestamps = false;
    protected $returnType = JwtIngreso::class;

    protected $allowedFields = [
        'token',
        'dia',
        'hora',
        'http_cliente',
        'http_cliente_origen',
        'consumo',
        'estado'
    ];

    public function getJwtIngresos()
    {
        return $this->findAll();
    }

    public function getJwtIngresoById(string $token)
    {
        return $this->find($token);
    }
}
