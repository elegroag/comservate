<?php
namespace App\Models;

use CodeIgniter\Model;

class SysSidebarModel extends Model
{
    protected $table = 'sys_sidebar';
    protected $primaryKey = 'id';
    protected $useSoftDeletes = false;
    protected $useTimestamps = false;
    protected $returnType = 'array';

    protected $allowedFields = [
        'id',
        'label',
        'estado',
        'resource_router',
        'orden',
        'sys_sidebar_id',
        'ambiente',
        'icon'
    ];

    public function getSysSidebars()
    {
        return $this->findAll();
    }

    public function getSysSidebarById(string $token)
    {
        return $this->find($token);
    }
}
