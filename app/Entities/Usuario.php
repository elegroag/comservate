<?php
namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Usuario extends Entity
{
    protected $id;
    protected $nombres;
    protected $usuario;
    protected $password;
    protected $fecha_creacion;
    protected $fecha_modificacion;
    protected $correo;
    protected $estado;
    protected $syncros;
}
