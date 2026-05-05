<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistema de Salud')</title>

    <!-- Fuentes e Íconos Premium -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <style>
        /* Estilos Base */
        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8fafc;
            -webkit-font-smoothing: antialiased;
        }

        /* Barra de Navegación Blanca Premium */
        .navbar-premium {
            background-color: #ffffff;
            padding: 1rem 3.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #e2e8f0;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.03);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        /* Logotipo / Marca */
        .brand strong {
            font-size: 1.35rem;
            font-weight: 800;
            color: #0f172a;
            letter-spacing: -0.03em;
        }

        /* Enlaces de Navegación */
        .nav-links {
            display: flex;
            gap: 0.5rem;
            align-items: center;
        }

        .nav-links a {
            color: #64748b;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
            padding: 0.6rem 1.2rem;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .nav-links a:hover {
            background-color: #f1f5f9;
            color: #0f172a;
        }

        /* ENLACE SELECCIONADO (Azul oscuro de los botones de registro) */
        .nav-links a.active-link {
            background-color: #0f172a !important; /* Azul oscuro idéntico a tus botones */
            color: #ffffff !important;           /* Texto blanco para que resalte */
            font-weight: 700;
            box-shadow: 0 4px 6px -1px rgba(15, 23, 42, 0.2);
        }

        /* Menú de Usuario */
        .user-menu {
            display: flex;
            gap: 1.5rem;
            align-items: center;
        }

        .user-greeting {
            color: #334155;
            font-weight: 600;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        /* Botón de Cerrar Sesión */
        .logout-btn {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
            border: none;
            padding: 0.5rem 1.25rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(239, 68, 68, 0.3);
        }
    </style>
</head>

<body>

    <nav class="navbar-premium">
        <div class="brand">
            <strong>⚕️ F A R M A C I A</strong>
        </div>

    @auth
    <div class="nav-links">
    @if(Auth::user()->role_id === 1)
        {{-- Lógica dinámica de selección --}}
        
        <a href="{{ route('admin.dashboard') }}" 
           class="{{ request()->is('admin/dashboard') ? 'active-link' : '' }}">
           Inicio Admin
        </a>
        
        <a href="#" 
           class="{{ request()->is('admin/usuarios*') ? 'active-link' : '' }}">
           Gestionar Usuarios
        </a>
        
        <a href="{{ url('/admin/proveedores') }}" 
           class="{{ request()->is('admin/proveedores*') ? 'active-link' : '' }}">
           Gestión Proveedores
        </a>
        
        <a href="{{ url('/admin/insumos') }}" 
           class="{{ request()->is('admin/insumos*') ? 'active-link' : '' }}">
           Gestión Insumos
        </a>
        
        {{-- Arreglado: Ahora detecta /alertas o admin/alertas --}}
        <a href="{{ route('alertas.index') }}" 
           class="{{ (request()->is('alertas*') || request()->is('admin/alertas*')) ? 'active-link' : '' }}">
           Alertas
        </a>

    @elseif(Auth::user()->role_id === 2)
        <a href="{{ route('farmacia.dashboard') }}" 
           class="{{ request()->is('farmacia/dashboard') ? 'active-link' : '' }}">
           Inicio Farmacia
        </a>
        
        <a href="{{ url('/admin/insumos') }}" 
           class="{{ request()->is('admin/insumos*') ? 'active-link' : '' }}">
           Inventario Insumos
        </a>
        
        <a href="{{ url('/admin/proveedores') }}" 
           class="{{ request()->is('admin/proveedores*') ? 'active-link' : '' }}">
           Proveedores
        </a>
    @endif
    </div>

        <div class="user-menu">
            <span class="user-greeting">
                <span style="background: #e2e8f0; padding: 0.3rem 0.6rem; border-radius: 50%;">👋</span>
                Hola, {{ Auth::user()->name }}
            </span>

            <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                @csrf
                <button type="submit" class="logout-btn">Cerrar Sesión</button>
            </form>
        </div>
    @endauth
    </nav>

    <main>
        @yield('content')
    </main>

</body>
</html>