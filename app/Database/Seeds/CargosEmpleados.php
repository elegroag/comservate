<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CargosEmpleados extends Seeder
{
    public function run()
    {
        $filepath =  FCPATH .'tmp/cargoempleado.csv';
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
                            'id_empleado' => trim($fila[1]),
                            'id_cargo' => trim($fila[2])
                        ];
                        $this->db->table('cargos_empleados')->insert($data);
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
