@extends('layouts.app')

@section('content')
<!-- Fuentes e Íconos Premium -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

<style>
    .dashboard-premium {
        font-family: 'Inter', sans-serif;
        padding: 2.5rem 3.5rem;
        background-color: #f8fafc;
        min-height: 85vh;
        -webkit-font-smoothing: antialiased;
    }
    
    /* Encabezado */
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
        margin: 0 0 0.3rem 0;
    }
    .title-wrapper p {
        color: #64748b;
        font-size: 0.95rem;
        margin: 0;
    }
    
    /* Botones Premium */
    .btn-primary-custom {
        background-color: #0f172a;
        color: #ffffff;
        border: 1px solid #0f172a;
        padding: 0.6rem 1.25rem;
        border-radius: 8px;
        font-weight: 500;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        cursor: pointer;
        transition: all 0.2s ease;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.05);
    }
    .btn-primary-custom:hover {
        background-color: #1e293b;
        transform: translateY(-1px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -4px rgba(0, 0, 0, 0.1);
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
        transition: all 0.2s ease;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    }
    .btn-secondary:hover {
        background-color: #f8fafc;
        border-color: #cbd5e1;
    }

    /* Barra de Herramientas (Buscador y Filtros) */
    .toolbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
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
        color: #334155;
        outline: none;
        transition: all 0.2s ease;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    }
    .search-box input:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
    }

    /* Contenedor de la Tabla */
    .table-card {
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -2px rgba(0, 0, 0, 0.025);
        border: 1px solid #e2e8f0;
        overflow: hidden;
    }
    
    /* Diseño de la Tabla */
    .custom-table {
        width: 100%;
        border-collapse: collapse;
    }
    .custom-table th {
        background-color: #f8fafc;
        color: #64748b;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        font-weight: 600;
        padding: 1rem 1.5rem;
        text-align: left;
        border-bottom: 1px solid #e2e8f0;
        border-top: 1px solid #e2e8f0;
    }
    .custom-table td {
        padding: 1rem 1.5rem;
        vertical-align: middle;
        border-bottom: 1px solid #f1f5f9;
        color: #334155;
        font-size: 0.875rem;
    }
    .custom-table tr:last-child td {
        border-bottom: none;
    }
    .custom-table tr:hover td {
        background-color: #f8fafc;
    }

    /* Identidad del Proveedor */
    .provider-identity {
        display: flex;
        align-items: center;
        gap: 1rem;
    }
    .avatar {
        width: 42px;
        height: 42px;
        border-radius: 10px;
        background: #eff6ff;
        color: #3b82f6;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 0.95rem;
        border: 1px solid #dbeafe;
    }
    .provider-details strong {
        display: block;
        color: #0f172a;
        font-size: 0.95rem;
        font-weight: 600;
    }
    .provider-details span {
        color: #64748b;
        font-size: 0.8rem;
    }

    /* Píldora de Estado Mágica */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        padding: 0.35rem 0.85rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 600;
        background-color: #ecfdf5;
        color: #059669;
        border: 1px solid #a7f3d0;
    }
    .status-badge i {
        font-size: 0.45rem;
    }

    /* Botones de Acción Minimalistas */
    .action-buttons {
        display: flex;
        gap: 0.25rem;
    }
    .btn-icon {
        background: transparent;
        border: none;
        color: #94a3b8;
        width: 36px;
        height: 36px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s;
        font-size: 1.25rem;
    }
    .btn-icon:hover {
        background-color: #f1f5f9;
        color: #0f172a;
    }
    .btn-icon.delete:hover {
        background-color: #fef2f2;
        color: #ef4444;
    }

    /* Paginación / Footer de la tabla */
    .table-footer {
        padding: 1rem 1.5rem;
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
    <!-- Header -->
    <div class="header-section">
        <div class="title-wrapper">
            <h1>Directorio de Proveedores</h1>
            <p>Gestiona los laboratorios y distribuidores médicos de la institución.</p>
        </div>
        <button class="btn-primary-custom" id="btnNuevoProveedor">
            <i class='bx bx-plus'></i> Registrar Proveedor
        </button>
    </div>

    <!-- Contenedor Principal (Toolbar + Tabla) -->
    <div class="table-card">
        
        <!-- Barra de Herramientas -->
        <div class="toolbar" style="padding: 1.5rem 1.5rem 0 1.5rem;">
            <div class="search-box">
                <i class='bx bx-search'></i>
                <input type="text" id="inputBuscarProveedor" placeholder="Buscar por nombre, ID o email...">
            </div>
            <div style="display: flex; gap: 0.75rem;">
                <button class="btn-secondary"><i class='bx bx-filter-alt'></i> Filtros</button>
                <button class="btn-secondary"><i class='bx bx-export'></i> Exportar</button>
            </div>
        </div>

        <!-- Tabla -->
        <table class="custom-table" id="tablaProveedores">
            <thead>
                <tr>
                    <th>Información del Proveedor</th>
                    <th>Datos de Contacto</th>
                    <th>Estado</th>
                    <th style="text-align: right;">Acciones</th>
                </tr>
            </thead>
            <tbody id="cuerpoTablaProveedores">
                <!-- Fila de ejemplo (Mockup) -->
                <tr>
                    <td>
                        <div class="provider-identity">
                            <div class="avatar">DS</div>
                            <div class="provider-details">
                                <strong>Droguería El Salvador</strong>
                                <span>Código ID: #1</span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="provider-details">
                            <strong>contacto@drogueriasv.com</strong>
                            <span>+503 2222-3333</span>
                        </div>
                    </td>
                    <td>
                        <span class="status-badge"><i class='bx bxs-circle'></i> Activo</span>
                    </td>
                    <td>
                        <div class="action-buttons" style="justify-content: flex-end;">
                            <button class="btn-icon" title="Editar"><i class='bx bx-edit'></i></button>
                            <button class="btn-icon delete" title="Eliminar"><i class='bx bx-trash'></i></button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Paginación -->
        <div class="table-footer">
            <span>Mostrando <strong style="color: #0f172a;">1</strong> a <strong style="color: #0f172a;">1</strong> de <strong style="color: #0f172a;">1</strong> resultados</span>
            <div style="display: flex; gap: 0.5rem;">
                <button class="btn-secondary" style="padding: 0.4rem 0.8rem;" disabled>Anterior</button>
                <button class="btn-secondary" style="padding: 0.4rem 0.8rem;" disabled>Siguiente</button>
            </div>
        </div>

    </div>
</div>
@endsection