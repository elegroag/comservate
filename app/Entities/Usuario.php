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

    public function setPassword(string $pass)
    {
        $this->attributes['Password'] = password_hash($pass, PASSWORD_BCRYPT);
        return $this;
    }
}
