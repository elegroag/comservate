<?php
namespace App\Models;

use App\Entities\Usuario;
use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id';
    protected $returnType = Usuario::class;
    protected $useSoftDeletes = False;
    protected $useTimestamps = True;
    protected $skipValidation = False;
    protected $cleanValidationRules = True;
    protected $createdField  = 'fecha_creacion';
    protected $updatedField  = 'fecha_modificacion';

    protected $allowedFields = [
        "id",
        "nombres",
        "usuario",
        "fecha_creacion",
        "fecha_modificacion",
        "correo",
        "estado",
        "password",
        "syncros"
    ];

    protected $validationRules      = [
        'nombres' => 'required|min_length[4]|max_length[180]',
        'password' => 'required|min_length[5]|max_length[225]',
        'estado' => 'required|min_length[1]|max_length[1]',
        'usuario' => 'required|min_length[3]|max_length[180]',
        'correo' => 'required|valid_email[clientes.correo]|min_length[6]|max_length[180]',
        'syncros' => 'max_length[225]'
    ];

    protected $validationMessages   = [
        'correo' => [
            'is_unique' => 'Lo siento. Ese correo electrónico ya ha sido tomado. Por favor, elija otro.',
            'required' => 'Lo siento. El correo es requerido',
            'valid_email' => 'Lo siento. El correo no es valido para continuar'
        ],
        'nombres' => [
            'required' => 'Lo siento. El nombre es requerido',
        ],
        'password' => [
            'required' => 'Lo siento. La clave es requerida',
        ],
        'estado' => [
            'required' => 'Lo siento. El estado es requerido',
        ],
        'usuario' => [
            'required' => 'Lo siento. El usuario es requerido',
        ]
    ];

    public function getUsuarios()
    {
        return $this->findAll();
    }

    public function getUsuarioById(int $id)
    {
        return $this->find($id);
    }

    public function getfindByUsername(string $username)
    {
        return $this->where('usuario', $username)->first(); 
    }
}
