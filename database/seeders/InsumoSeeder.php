<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InsumoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtenemos los primeros IDs de proveedores y categorías para asociarlos
        // Si las tablas están vacías, estos valores serán null, lo cual tu migración permite
        $proveedorId = DB::table('proveedores')->first()?->id;
        $categoriaId = DB::table('categorias')->first()?->id;

        // Si tienes más de un proveedor/categoría, podemos agarrar un par para alternar
        $proveedoresIds = DB::table('proveedores')->pluck('id')->toArray();
        $categoriasIds = DB::table('categorias')->pluck('id')->toArray();

        $insumos = [
            [
                'nombre' => 'Acetaminofén 500mg',
                'descripcion' => 'Caja con 500 tabletas. Analgésico y antipirético.',
                'codigo' => 'MED-ACE-500',
                'stock_minimo' => 100,
                'proveedor_id' => !empty($proveedoresIds) ? $proveedoresIds[0] : null,
                'categoria_id' => !empty($categoriasIds) ? $categoriasIds[0] : null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Ibuprofeno 400mg',
                'descripcion' => 'Caja con 20 tabletas. Antiinflamatorio no esteroideo.',
                'codigo' => 'MED-IBU-400',
                'stock_minimo' => 50,
                'proveedor_id' => count($proveedoresIds) > 1 ? $proveedoresIds[1] : $proveedorId,
                'categoria_id' => count($categoriasIds) > 1 ? $categoriasIds[0] : $categoriaId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Amoxicilina 500mg',
                'descripcion' => 'Frasco con 45 cápsulas. Antibiótico de amplio espectro.',
                'codigo' => 'MED-AMO-500',
                'stock_minimo' => 30,
                'proveedor_id' => !empty($proveedoresIds) ? $proveedoresIds[0] : null,
                'categoria_id' => !empty($categoriasIds) ? $categoriasIds[0] : null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Jeringas Descartables 5ml',
                'descripcion' => 'Caja de 100 unidades con aguja 21G x 1 1/2.',
                'codigo' => 'SUM-JER-005',
                'stock_minimo' => 200,
                'proveedor_id' => count($proveedoresIds) > 2 ? $proveedoresIds[2] : $proveedorId,
                'categoria_id' => count($categoriasIds) > 1 ? $categoriasIds[1] : $categoriaId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Catéter Intravenoso 22G',
                'descripcion' => 'Caja de 50 unidades. Color Azul. Para terapia infusión.',
                'codigo' => 'SUM-CAT-022',
                'stock_minimo' => 40,
                'proveedor_id' => count($proveedoresIds) > 3 ? $proveedoresIds[3] : $proveedorId,
                'categoria_id' => count($categoriasIds) > 1 ? $categoriasIds[1] : $categoriaId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Solución Salina Normal 0.9%',
                'descripcion' => 'Bolsa para infusión de 500ml. Suero fisiológico.',
                'codigo' => 'SOL-SAL-500',
                'stock_minimo' => 150,
                'proveedor_id' => count($proveedoresIds) > 1 ? $proveedoresIds[1] : $proveedorId,
                'categoria_id' => count($categoriasIds) > 1 ? $categoriasIds[1] : $categoriaId,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        DB::table('insumos')->insert($insumos);
    }
}