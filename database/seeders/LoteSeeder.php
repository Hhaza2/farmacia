<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtenemos IDs necesarios de las tablas relacionadas
        $insumosIds = DB::table('insumos')->pluck('id')->toArray();
        $ubicacionesIds = DB::table('ubicaciones')->pluck('id')->toArray();
        $proveedoresIds = DB::table('proveedores')->pluck('id')->toArray();
        
        // Buscamos el primer usuario administrador o el primero que exista para simular el registro
        $usuarioId = DB::table('users')->first()?->id ?? 1;

        // Si no tienes insumos creados aún, es mejor detener el seeder para evitar fallos por FK
        if (empty($insumosIds)) {
            $this->command->warn('No hay insumos en la base de datos. Ejecuta primero InsumoSeeder.');
            return;
        }

        $lotes = [
            [
                'insumo_id' => $insumosIds[0], // Probablemente Acetaminofén
                'ubicacion_id' => !empty($ubicacionesIds) ? $ubicacionesIds[0] : null,
                'proveedor_id' => !empty($proveedoresIds) ? $proveedoresIds[0] : null,
                'codigo_lote' => 'LOT-2026-ACE01',
                'cantidad_inicial' => 500,
                'cantidad_actual' => 450,
                'fecha_entrada' => now()->subDays(5)->format('Y-m-d'),
                'fecha_vencimiento' => now()->addYears(2)->format('Y-m-d'), // Activo y vigente
                'estado' => 'activo',
                'registrado_por' => $usuarioId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'insumo_id' => count($insumosIds) > 1 ? $insumosIds[1] : $insumosIds[0], // Probablemente Ibuprofeno
                'ubicacion_id' => !empty($ubicacionesIds) ? $ubicacionesIds[0] : null,
                'proveedor_id' => count($proveedoresIds) > 1 ? $proveedoresIds[1] : null,
                'codigo_lote' => 'LOT-2026-IBU02',
                'cantidad_inicial' => 200,
                'cantidad_actual' => 200,
                'fecha_entrada' => now()->subDays(2)->format('Y-m-d'),
                'fecha_vencimiento' => now()->addMonths(18)->format('Y-m-d'),
                'estado' => 'activo',
                'registrado_por' => $usuarioId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'insumo_id' => count($insumosIds) > 3 ? $insumosIds[3] : $insumosIds[0], // Suministro (Jeringas)
                'ubicacion_id' => count($ubicacionesIds) > 1 ? $ubicacionesIds[1] : null,
                'proveedor_id' => count($proveedoresIds) > 2 ? $proveedoresIds[2] : null,
                'codigo_lote' => 'LOT-2025-JER09',
                'cantidad_inicial' => 1000,
                'cantidad_actual' => 0, // Simulamos un lote que ya se gastó por completo
                'fecha_entrada' => now()->subMonths(6)->format('Y-m-d'),
                'fecha_vencimiento' => now()->addMonths(6)->format('Y-m-d'),
                'estado' => 'agotado',
                'registrado_por' => $usuarioId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'insumo_id' => count($insumosIds) > 2 ? $insumosIds[2] : $insumosIds[0], // Antibiótico viejo
                'ubicacion_id' => !empty($ubicacionesIds) ? $ubicacionesIds[0] : null,
                'proveedor_id' => !empty($proveedoresIds) ? $proveedoresIds[0] : null,
                'codigo_lote' => 'LOT-2023-AMO05',
                'cantidad_inicial' => 100,
                'cantidad_actual' => 15,
                'fecha_entrada' => now()->subYears(2)->format('Y-m-d'),
                'fecha_vencimiento' => now()->subMonths(2)->format('Y-m-d'), // Vencido hace 2 meses para probar alertas
                'estado' => 'vencido',
                'registrado_por' => $usuarioId,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        DB::table('lotes')->insert($lotes);
    }
}