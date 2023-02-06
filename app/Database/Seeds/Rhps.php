<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Rhps extends Seeder
{
    public function run()
    {
        $filepath = 'C:/tmp/rhps.csv';
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
                            'id_cliente' => trim($fila[1]),
                            'fecha_recoleccion' => trim($fila[2]),
                            'hora_recoleccion' => trim($fila[3]),
                            'id_empleado' => trim($fila[4]),
                            'cantidad_bolsas' => trim($fila[5]),
                            'cantidad_guardianes' => trim($fila[6]),
                            'fecha_creacion' => trim($fila[7]),
                            'usuario_creador' => trim($fila[8]),
                            'fecha_modificacion' => trim($fila[9]),
                            'vehiculo' => trim($fila[10]),
                        ];
                        $this->db->table('rhps')->insert($data);
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
