<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProveedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $proveedores = [
            [
                'nombre' => 'Droguería Santa Lucía',
                'telefono' => '+503 2234-5678',
                'email' => 'ventas@santalucia.com.sv',
                'direccion' => 'Alameda Manuel Enrique Araujo, No. 321, San Salvador.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Laboratorios Paill',
                'telefono' => '+503 2250-9000',
                'email' => 'contacto@paill.com',
                'direccion' => 'Zona Industrial Merliot, Calle L-3, Antiguo Cuscatlán, La Libertad.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'EJJE El Salvador',
                'telefono' => '+503 2244-1900',
                'email' => 'soporte@ejje.com',
                'direccion' => 'Calle La Mascota, Colonia San Benito, No. 45, San Salvador.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'JMTelcom S.A. de C.V.',
                'telefono' => '+503 2209-7700',
                'email' => 'corporativo@jmtelcom.com',
                'direccion' => 'Boulevard Los Héroes, Pasaje Los Sisimiles, San Salvador.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Droguería Panamericana',
                'telefono' => '+503 2273-1122',
                'email' => 'pedidos@panamericana.com.sv',
                'direccion' => 'Colonia Médica, Avenida Dr. Max Bloch, San Salvador.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'EMESAL S.A. de C.V.',
                'telefono' => '+503 2289-4455',
                'email' => 'info@emesal.com',
                'direccion' => 'Paseo General Escalón y 85 Avenida Norte, San Salvador.',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        // Insertamos los datos usando DB para evitar problemas si el modelo tiene asignaciones masivas estrictas
        DB::table('proveedores')->insert($proveedores);
    }
}