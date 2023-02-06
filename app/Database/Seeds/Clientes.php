<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Clientes extends Seeder
{
    public function run()
    {
        $this->db->query('DELETE FROM clientes WHERE 1=1;');
        $filepath = 'C:/tmp/clientes.csv';
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
                        $fechaModificacion = substr(trim($fila[21]), 0, 18);
                        $data = [
                            'id' => trim($fila[0]),
                            'cedula' => trim($fila[1]),
                            'nit' => trim($fila[2]),
                            'afiliado' => trim($fila[3]),
                            'representante' => trim($fila[4]),
                            'ruta'=> trim($fila[5]),
                            'id_municipio' => trim($fila[6]),
                            'frecuencia' => trim($fila[7]),
                            'contrato' => trim($fila[8]),
                            'fecha_finalizacion' => trim($fila[9]),
                            'valor_kilo' => trim($fila[10]),
                            'kilos' => trim($fila[11]),
                            'valor_kilo_adicional' => trim($fila[12]),
                            'direccion' => trim($fila[13]),
                            'telefono' => trim($fila[14]),
                            'barrio' => trim($fila[15]),
                            'correo' => trim($fila[16]),
                            'especiales' => trim($fila[17]),
                            'usuario_creador' => trim($fila[18]),
                            'estado' => trim($fila[19]),
                            'fecha_creacion' => trim($fila[20]),
                            'fecha_modificacion' => $fechaModificacion
                        ];
                        $this->db->table('clientes')->insert($data);
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
