<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistema de Salud')</title>

    <!-- Fuentes e Íconos Premium -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

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
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.03), 0 2px 4px -1px rgba(0, 0, 0, 0.02);
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
            font-weight: 500;
            font-size: 0.95rem;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .nav-links a:hover {
            background-color: #f1f5f9;
            color: #0f172a;
        }

        /* Enlace Activo */
        .nav-links a.active-link {
            background-color: #eff6ff;
            color: #3b82f6;
            font-weight: 600;
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

        /* Botón de Cerrar Sesión con Sombra */
        .logout-btn {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
            border: none;
            padding: 0.5rem 1.25rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(239, 68, 68, 0.3);
        }

        .logout-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(239, 68, 68, 0.4);
            background: linear-gradient(135deg, #f87171 0%, #ef4444 100%);
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
                <a href="{{ route('admin.dashboard') }}">Inicio Admin</a>
                <a href="#">Gestionar Usuarios</a>
                <a href="#">Reportes Generales</a>
                <a href="{{ route('alertas.index') }}">Alertas</a>
                <a href="{{ url('/admin/proveedores') }}" class="active-link">Gestión Proveedores</a>
            @elseif(Auth::user()->role_id === 2)
                <a href="{{ route('farmacia.dashboard') }}">Inicio Farmacia</a>
                <a href="#">Inventario</a>
                <a href="{{ url('/admin/proveedores') }}" class="active-link">Proveedores</a>
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