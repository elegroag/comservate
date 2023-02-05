<?php
namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Empleado extends Entity
{
    protected $id;
    protected $nombres;
    protected $usuario_empleado;
    protected $apellidos;
    protected $identificacion;
    protected $tipo_identificacion;
    protected $celular;
    protected $direccion;
    protected $email;
    protected $estado;
    protected $fecha_creacion;
    protected $fecha_modificacion;
    protected $id_usuario;
}
