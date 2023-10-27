<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Recoleccion extends Seeder
{
    public function run()
    {
        # $this->db->query('DELETE FROM recoleccion WHERE 1=1;');
        $filepath =  FCPATH .'tmp/recoleccion.csv';
        if (!file_exists($filepath)){
            echo 'Error no hay archivo para procesar';
            return false;
        }

        $ai = 0;
        $filas = 0;
        $headers = [];
        $fdata = fopen($filepath, "rb");
        if($fdata)
        {
            $ai=0;  
            while (!feof($fdata))
            {
                $line = fgets($fdata);
                $line = str_replace("\n", "", $line);
                $line = str_replace("\t", " ", $line);
                if(strlen(trim($line)) == 0) continue;
                if($ai == 0){
                    $headers = explode(";", $line);
                } else {
                    $filas++;
                    $fila = explode(";", $line);
                    if(count($fila) > 0)
                    {
                        $data = [
                            'id' => trim($fila[0]),
                            'id_rhps' => trim($fila[1]),
                            'tipo_residuo' =>  trim($fila[2]),
                            'cantidad_residuo' => trim($fila[3])
                        ];
                        $this->db->table('recoleccion')->insert($data);
                    }
                }
                $ai++;
            }
        }
        fclose($fdata);
        echo 'OK Proceso completado'."\t\n";
        var_export($headers);
        echo '_______________________'."\t\n";
    }
}
