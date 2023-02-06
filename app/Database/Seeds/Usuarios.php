<?php

namespace App\Database\Seeds;

use App\Services\HashService;
use CodeIgniter\Database\Seeder;

class Usuarios extends Seeder
{
    public function run()
    {
        $filepath = 'C:/tmp/usuarios.csv';
        if (!file_exists($filepath)){
            echo 'Error no hay archivo para procesar';
            return false;
        }

        $hashService = new HashService();

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
                        $password = $hashService->getClaveHash($fila[5], $fila[2]);
                        $data = [
                            'id' => trim($fila[0]),
                            "nombres" => trim($fila[1]),
                            "usuario" => trim($fila[2]),
                            "correo" => trim($fila[3]),
                            "estado" => trim($fila[4]),
                            "password" => $password
                        ];
                        $this->db->table('usuarios')->insert($data);
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
