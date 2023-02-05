<?php
namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Zona extends Entity
{
    protected $id;
    protected $nombre_zona;
    protected $fecha_creacion;
    protected $fecha_modificacion;
    protected $id_usuario;
    protected $syncros;
}
