<?php
namespace App\Models;

use App\Entities\ZonaMunicipio;
use CodeIgniter\Model;

class ZonaMunicipioModel extends Model
{
    protected $table = 'zonas_municipios';
    protected $primaryKey = 'id';
    protected $returnType = ZonaMunicipio::class;
    protected $useSoftDeletes = false;
    protected $useTimestamps = false;

    protected $allowedFields = [
        "id",
        "id_zona",
        "id_municipio",
        "syncros"
    ];

    public function getZonasMunicipios()
    {
        return $this->findAll();
    }

    public function getZonaMunicipioById(int $id)
    {
        return $this->find($id);
    }
}
