<?php
namespace App\Entities;

use CodeIgniter\Entity\Entity;

class JwtIngreso extends Entity
{
    protected  $token;
    protected  $dia;
    protected  $hora;
    protected  $http_cliente;
    protected  $http_cliente_origen;
    protected  $consumo;
    protected  $estado;
}
