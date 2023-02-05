<?php
namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Vehiculo extends Entity
{
    protected $id;
    protected $placa;
    protected $marca;
    protected $modelo;
    protected $estado;
    protected $id_usuario;
    protected $fecha_modificacion;
    protected $fecha_creacion;

}
