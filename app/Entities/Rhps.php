<?php
namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Rhps extends Entity
{
    protected $id;
    protected $id_cliente;
    protected $fecha_recoleccion;
    protected $hora_recoleccion;
    protected $id_empleado;
    protected $cantidad_bolsas;
    protected $cantidad_guardianes;
    protected $fecha_creacion;
    protected $usuario_creador;
    protected $fecha_modificacion;
    protected $vehiculo;
}
