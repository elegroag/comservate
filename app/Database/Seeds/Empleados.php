<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Empleados extends Seeder
{
    public function run()
    {
        $filepath =  FCPATH .'tmp/empleados.csv';
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
                            'nombres' => trim($fila[1]),
                            'usuario_creador' => trim($fila[2]),
                            'apellidos' => trim($fila[3]),
                            'identificacion' => trim($fila[4]),
                            'tipo_identificacion' => trim($fila[5]),
                            'celular' => trim($fila[6]),
                            'direccion' => trim($fila[7]),
                            'email' => trim($fila[8]),
                            'estado' => trim($fila[9]),
                            'usuario_empleado' => trim($fila[10])
                        ];
                        $this->db->table('empleados')->insert($data);
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
