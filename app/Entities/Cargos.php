<?php
namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Cargo extends Entity
{
    protected $id;
    protected $cargo;
    protected $descripcion;
    protected $usuario_registra;
    protected $syncros;
    protected $fecha_creacion;
    protected $fecha_modificacion;

}
