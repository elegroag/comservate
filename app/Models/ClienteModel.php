<?php

namespace App\Models;

use App\Entities\Cliente;
use CodeIgniter\Model;

class ClienteModel extends Model
{
    protected $table = 'clientes';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = True;
    protected $returnType = Cliente::class;
    protected $useSoftDeletes = False;
    protected $useTimestamps = True;
    protected $skipValidation = False;
    protected $cleanValidationRules = True;
    protected $createdField  = 'fecha_creacion';
    protected $updatedField  = 'fecha_modificacion';

    /**
     * allowedFields variable
     * syncros = |id_usuario1||id_usuario2||id_usuario3||id_usuario4|
     * @var array
     */
    protected $allowedFields = [
        "id",
        "cedula",
        "nit",
        "afiliado", /*nombre empresa afiliado*/
        "representante",
        "ruta",
        "id_municipio",
        "frecuencia",
        "contrato",
        "fecha_finalizacion",
        "valor_kilo",
        "kilos",
        "valor_kilo_adicional",
        "direccion",
        "telefono",
        "barrio",
        "correo",
        "especiales",
        "fecha_creacion",
        "fecha_modificacion",
        "usuario_creador",
        "estado",
        "mapa",
        "syncros"
    ];

    protected $validationRules      = [
        'cedula' => 'required|numeric|min_length[6]|max_length[16]',
        'correo' => 'required|valid_email[clientes.correo]|min_length[6]|max_length[180]',
        'nit' => 'required|numeric[clientes.nit]|min_length[6]|max_length[16]',
        'id_municipio' => 'required|numeric|min_length[1]',
        'afiliado' => 'required|min_length[4]|max_length[180]',
        'representante' => 'required|min_length[4]|max_length[180]',
        'telefono' => 'required|numeric|min_length[7]|max_length[10]',
        'direccion' => 'required|min_length[5]|max_length[200]',
        'barrio' => 'required|min_length[5]|max_length[180]',
        'usuario_creador' => 'required|min_length[1]|max_length[8]',
        'estado' => 'required|min_length[1]|max_length[1]',
        'fecha_finalizacion' => 'date',
        'mapa' => 'max_length[225]',
        'contrato' => 'numeric|max_length[8]',
        'valor_kilo' => 'numeric|max_length[14]',
        'kilos' => 'numeric|max_length[10]',
        'valor_kilo_adicional' => 'numeric|max_length[14]',
        'especiales' => 'max_length[1]',
        'syncros' => 'max_length[225]'
    ];

    protected $validationMessages   = [
        'correo' => [
            'is_unique' => 'Lo siento. Ese correo electrónico ya ha sido tomado. Por favor, elija otro.',
            'required' => 'Lo siento. El correo es requerido',
            'valid_email' => 'Lo siento. El correo no es valido para continuar'
        ],
        'cedula' => [
            'required' => 'Lo siento. La identificación es requerida',
            'numeric' => 'Lo siento. La identificación debe ser numercia',
            'min_length' => 'Lo siento. El número de identificación no puede ser menor a 6 dígitos',
            'max_length' => 'Lo siento. El número de identificación no puede ser mayor a 16 dígitos',
        ],
        'nit' => [
            'is_unique' => 'Lo siento. Ese nit ya ha sido registrado. Por favor, elija otro.',
            'required' => 'Lo siento. El nit es requerido',
            'min_length' => 'Lo siento. El nit no puede ser menor a 6 dígitos'
        ],
        'representante' => [
            'required' => 'Lo siento. El nombre del representante es requerido',
        ],
        'afiliado' => [
            'required' => 'Lo siento. La razón social de la empresa es requerida',
        ],
        'id_municipio' => [
            'required' => 'Lo siento. El municipio es requerido',
        ],
        'telefono' => [
            'required' => 'Lo siento. El telefono es requerido',
            'max_length' => 'Lo siento. El número de teléfono no puede ser mayor a 10 dígitos',
        ],
        'direccion' => [
            'required' => 'Lo siento. La dirección es requerida',
            'max_length' => 'Lo siento. La dirección no puede ser mayor a 200 caracteres',
            'min_length' => 'Lo siento. La dirección no puede ser menor a 5 caracteres'
        ],
        'barrio' => [
            'required' => 'Lo siento. El barrio es requerido',
            'min_length' => 'Lo siento. El barrio no puede ser menor a 5 caracteres'
        ],
        'usuario_creador' => [
            'required' => 'Lo siento. El usuario creador es requerido',
        ],
        'estado' => [
            'required' => 'Lo siento. El estado es requerido',
        ],
        'fecha_finalizacion' => [
            'required' => 'Lo siento. La fecha de corresponder a un valor de fecha valido: (año-mes-día)'
        ],
        'mapa' => [
            'max_length' => 'Lo siento. El mapa no puede ser mayor a 225 caracteres'
        ]
    ];

    public function getClientes()
    {
        return $this->findAll();
    }

    public function getClienteById(int $id)
    {
        return $this->find($id);
    }
}
