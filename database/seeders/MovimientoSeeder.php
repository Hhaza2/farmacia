<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MovimientoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lotes = DB::table('lotes')->get();
        
        $usuarioId = DB::table('users')->first()?->id ?? 1;
        $areaId = DB::table('areas')->first()?->id; 

        if ($lotes->isEmpty()) {
            $this->command->warn('No hay lotes en la base de datos para generar movimientos. Ejecuta primero LoteSeeder.');
            return;
        }

        $movimientos = [];

        foreach ($lotes as $lote) {

            $movimientos[] = [
                'lote_id' => $lote->id,
                'user_id' => $usuarioId,
                'area_id' => $areaId,
                'tipo' => 'entrada',
                'cantidad' => $lote->cantidad_inicial, // Coincide con tu controlador
                'motivo' => 'ajuste', // Mismo motivo base de tu LoteController
                'referencia' => 'REG-INI-' . $lote->codigo_lote,
                'fecha' => $lote->fecha_entrada . ' 08:00:00',
                'created_at' => $lote->created_at,
                'updated_at' => $lote->updated_at,
            ];

            if ($lote->estado === 'activo' && $lote->cantidad_inicial > $lote->cantidad_actual) {
                // Si la cantidad actual es menor, calculamos cuánto se ha consumido
                $cantidadConsumida = $lote->cantidad_inicial - $lote->cantidad_actual;

                $movimientos[] = [
                    'lote_id' => $lote->id,
                    'user_id' => $usuarioId,
                    'area_id' => $areaId,
                    'tipo' => 'salida',
                    'cantidad' => $cantidadConsumida,
                    'motivo' => 'Consumo paciente', // Flujo operativo médico común
                    'referencia' => 'REC-MED-' . rand(10000, 99999),
                    'fecha' => now()->subDays(1)->format('Y-m-d H:i:s'),
                    'created_at' => now()->subDays(1),
                    'updated_at' => now()->subDays(1),
                ];
            }

            if ($lote->estado === 'agotado') {
                // Si el lote está agotado, significa que se consumió el 100% de lo que entró
                $movimientos[] = [
                    'lote_id' => $lote->id,
                    'user_id' => $usuarioId,
                    'area_id' => $areaId,
                    'tipo' => 'salida',
                    'cantidad' => $lote->cantidad_inicial,
                    'motivo' => 'Despacho total a piso de enfermería',
                    'referencia' => 'DESP-' . rand(10000, 99999),
                    'fecha' => now()->subDays(3)->format('Y-m-d H:i:s'),
                    'created_at' => now()->subDays(3),
                    'updated_at' => now()->subDays(3),
                ];
            }
        }

        // Insertamos toda la colección en la tabla de movimientos
        DB::table('movimientos')->insert($movimientos);
    }
}