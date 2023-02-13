<?php
namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Cliente extends Entity
{
    protected $id;
    protected $cedula;
    protected $nit;
    protected $afiliado;
    protected $representante;
    protected $ruta;
    protected $id_municipio;
    protected $frecuencia;
    protected $contrato;
    protected $fecha_finalizacion;
    protected $valor_kilo;
    protected $kilos;
    protected $valor_kilo_adicional;
    protected $direccion;
    protected $telefono;
    protected $barrio;
    protected $correo;
    protected $especiales;
    protected $fecha_creacion;
    protected $fecha_modificacion;
    protected $usuario_creador;
    protected $estado;
    protected $map;

    public function getEstadosArray()
    {
        return [
            'A'=> 'ACTIVO',
            'I'=> 'INACTIVO',
            'X'=> 'BORRADO',
            'S'=> 'SUSPENDIDO'
        ];
    }

    public function getEstadoDetalle(?string $estado)
    {
        if(!$estado) $estado = $this->estado;
        switch ($estado) {
            case 'A':
                return 'ACTIVO';
                break;
            case 'I':
                return 'INACTIVO';
                break;
            case 'S':
                return 'SUSPENDIDO';
                break;
            case 'X':
                return 'BORRADO';
                break;
            default:
            break;
        }
    }

}
