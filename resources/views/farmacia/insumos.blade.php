@extends('layouts.app')

@section('content')
<!-- Fuentes e Íconos Premium -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

<style>
    .dashboard-premium {
        font-family: 'Inter', sans-serif;
        padding: 2.5rem 3.5rem;
        background-color: #f8fafc;
        min-height: 85vh;
        -webkit-font-smoothing: auto; 
    }
    
    .header-section {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }

    .title-wrapper h1 {
        font-size: 1.85rem;
        font-weight: 700;
        color: #0f172a;
        letter-spacing: -0.03em;
        margin: 0;
    }

    .btn-primary-custom {
        background-color: #0f172a;
        color: #ffffff;
        border: none;
        padding: 0.6rem 1.25rem;
        border-radius: 8px;
        font-weight: 500;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        cursor: pointer;
    }

    .btn-secondary {
        background-color: #ffffff;
        color: #334155;
        border: 1px solid #e2e8f0;
        padding: 0.6rem 1rem;
        border-radius: 8px;
        font-weight: 500;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 0.4rem;
        cursor: pointer;
    }

    /* Toolbar y Buscador */
    .toolbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1.5rem;
        gap: 1rem;
    }

    .search-box {
        position: relative;
        width: 350px;
    }

    .search-box i {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        font-size: 1.2rem;
    }

    .search-box input {
        width: 100%;
        padding: 0.6rem 1rem 0.6rem 2.8rem;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        font-size: 0.9rem;
        outline: none;
    }

    /* Tabla Estilo Proveedores (Negrita 800) */
    .table-card {
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        border: 1px solid #e2e8f0;
        overflow: hidden;
    }

    .custom-table {
        width: 100%;
        border-collapse: collapse;
    }

    .custom-table th {
        background-color: #f8fafc;
        color: #1e293b;
        font-size: 0.75rem;
        text-transform: uppercase;
        font-weight: 800;
        padding: 1.2rem 1.5rem;
        text-align: left;
        border-bottom: 2px solid #e2e8f0;
    }

    .custom-table td {
        padding: 1.2rem 1.5rem;
        vertical-align: middle;
        border-bottom: 1px solid #f1f5f9;
    }

    .item-details strong {
        display: block;
        color: #000000 !important; 
        font-size: 0.95rem;
        font-weight: 800 !important; 
        line-height: 1.4;
    }

    .item-details span {
        color: #475569;
        font-size: 0.8rem;
        font-weight: 500;
    }

    .avatar {
        width: 42px; height: 42px; border-radius: 10px;
        background: #eff6ff; color: #2563eb;
        display: flex; align-items: center; justify-content: center;
        font-weight: 800; border: 1.5px solid #dbeafe;
        flex-shrink: 0;
    }

    .status-badge {
        display: inline-flex; align-items: center; gap: 0.35rem;
        padding: 0.4rem 0.9rem; border-radius: 9999px;
        font-size: 0.75rem; font-weight: 800;
        background-color: #ecfdf5 !important; color: #047857 !important;
        border: 1px solid #10b981 !important;
    }
    .status-badge i { color: #10b981 !important; font-size: 0.45rem; }

    .btn-icon {
        background: transparent; border: none; color: #94a3b8;
        width: 36px; height: 36px; font-size: 1.25rem; cursor: pointer;
    }

    .table-footer {
        padding: 1.5rem;
        background-color: #ffffff;
        border-top: 1px solid #e2e8f0;
        display: flex;
        justify-content: space-between;
        align-items: center;
        color: #64748b;
        font-size: 0.875rem;
    }
</style>

<div class="dashboard-premium">
    <div class="header-section">
        <div class="title-wrapper">
            <h1>Inventario de Insumos</h1>
            <p>Control de stock y suministros médicos de la farmacia.</p>
        </div>
        <button class="btn-primary-custom">
            <i class='bx bx-plus'></i> Registrar Insumo
        </button>
    </div>

    <div class="table-card">
        <div class="toolbar">
            <div class="search-box">
                <i class='bx bx-search'></i>
                <input type="text" id="inputBuscarInsumo" placeholder="Buscar por nombre o código...">
            </div>
            <div style="display: flex; gap: 0.75rem;">
                <button class="btn-secondary"><i class='bx bx-filter-alt'></i> Filtros</button>
                <button class="btn-secondary"><i class='bx bx-export'></i> Exportar</button>
            </div>
        </div>

        <table class="custom-table">
            <thead>
                <tr>
                    <th style="width: 25%;">Insumo / Código</th>
                    <th style="width: 25%;">Descripción / ID</th>
                    <th style="width: 20%;">Proveedor / Categoría</th>
                    <th style="width: 15%;">Stock Mínimo / Estado</th>
                    <th style="width: 15%; text-align: right;">Acciones</th>
                </tr>
            </thead>
            <tbody id="cuerpoTablaInsumos">
                <tr><td colspan="5" style="text-align:center; padding:3rem;">Cargando inventario...</td></tr>
            </tbody>
        </table>

        <!-- FOOTER BIEN UBICADO ABAJO -->
        <div class="table-footer">
            <span id="contadorResultados">Mostrando resultados</span>
            <div style="display: flex; gap: 0.5rem;">
                <button class="btn-secondary" style="padding: 0.4rem 0.8rem;">Anterior</button>
                <button class="btn-secondary" style="padding: 0.4rem 0.8rem;">Siguiente</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', cargarInsumos);

    async function cargarInsumos() {
        const tabla = document.getElementById('cuerpoTablaInsumos');
        try {
            const response = await fetch('/api/insumos');
            const insumos = await response.json();
            tabla.innerHTML = '';

            const inputBuscar = document.getElementById('inputBuscarInsumo');
            inputBuscar.addEventListener('keyup', function() {
                let filtro = this.value.toLowerCase();
                document.querySelectorAll('#cuerpoTablaInsumos tr').forEach(fila => {
                    fila.style.display = fila.innerText.toLowerCase().includes(filtro) ? '' : 'none';
                });
            });

            document.getElementById('contadorResultados').innerHTML = `Mostrando <strong>${insumos.length}</strong> resultados`;

            insumos.forEach(i => {
                const iniciales = i.nombre ? i.nombre.substring(0, 2).toUpperCase() : 'IN';
                const activo = i.estado_id == 1;

                tabla.innerHTML += `
                    <tr>
                        <td>
                            <div style="display: flex; align-items: center; gap: 1rem;">
                                <div class="avatar">${iniciales}</div>
                                <div class="item-details">
                                    <strong>${i.nombre}</strong>
                                    <span>Código ID: #${i.id}</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="item-details">
                                <strong>${i.descripcion || 'Sin descripción'}</strong>
                                <span>Ref: ${i.codigo || 'N/A'}</span>
                            </div>
                        </td>
                        <td>
                            <div class="item-details">
                                <strong>Proveedor ID: #${i.proveedor_id || 'N/A'}</strong>
                                <span>Categoría ID: #${i.categoria_id || 'N/A'}</span>
                            </div>
                        </td>
                        <td>
                            <div class="item-details">
                                <strong>Mínimo: ${i.stock_minimo}</strong>
                                <span class="${activo ? 'status-badge' : 'status-badge-inactive'}">
                                    <i class='bx bxs-circle'></i> ${activo ? 'Activo' : 'Inactivo'}
                                </span>
                            </div>
                        </td>
                        <td>
                            <div style="display: flex; justify-content: flex-end; gap: 5px;">
                                <button class="btn-icon"><i class='bx bx-edit-alt'></i></button>
                                <button class="btn-icon"><i class='bx bx-trash'></i></button>
                            </div>
                        </td>
                    </tr>
                `;
            });
        } catch (error) {
            tabla.innerHTML = '<tr><td colspan="5" style="text-align:center; padding:2rem; color:red;">Error al cargar datos</td></tr>';
        }
    }
</script>
@endsection