<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Vehiculos extends Seeder
{
    public function run()
    {
        $filepath = 'C:/tmp/vehiculos.csv';
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
                            'placa' => trim($fila[1]),
                            'marca' => trim($fila[2]),
                            'modelo' => trim($fila[3]),
                            'estado'=> trim($fila[4]),
                            'id_usuario' =>  trim($fila[5])

                        ];
                        $this->db->table('vehiculos')->insert($data);
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
