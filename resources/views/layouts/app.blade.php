<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Son Light - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Teko:wght@600..700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: rgb(26, 35, 126);
            --hover-color: rgb(21, 28, 100);
            --active-color: rgb(13, 17, 60);
        }
        .navbar-custom {
            background-color: var(--primary-color) !important;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .navbar-custom .navbar-brand,
        .navbar-custom .nav-link {
            color: #ffffff !important;
            transition: all 0.3s ease;
        }
        .navbar-custom .nav-link {
            padding: 0.5rem 1rem;
            border-radius: 5px;
            margin: 0 0.2rem;
        }
        .navbar-custom .nav-link:hover {
            background-color: var(--hover-color);
        }
        .navbar-custom .nav-link.active {
            background-color: var(--active-color);
            font-weight: bold;
        }
        .navbar-custom .navbar-toggler {
            border-color: rgba(255, 255, 255, 0.5);
        }
        .navbar-brand img {
            height: 40px;
            margin-right: 10px;
        }
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        .btn-primary:hover {
            background-color: var(--hover-color);
            border-color: var(--hover-color);
        }
        .dropdown-menu {
            background-color: var(--primary-color);
            border: none;
        }
        .dropdown-item {
            color: #ffffff;
        }
        .dropdown-item:hover {
            background-color: var(--hover-color);
            color: #ffffff;
        }
    </style>
    @yield('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('dashboard') }}" style="font-family: 'Teko', sans-serif;">
                <img src="{{ asset('images/logo.jpeg') }}" alt="Son Light Logo" style="border-radius: 10%" class="d-inline-block align-top">
                {{-- Son Light --}}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                            <i class="bi bi-speedometer2"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('orders.*') ? 'active' : '' }}" href="{{ route('orders.index') }}">
                            <i class="bi bi-cart"></i> Commandes
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('clients.*') ? 'active' : '' }}" href="{{ route('clients.index') }}">
                            <i class="bi bi-people"></i> Clients
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('tasks.*') ? 'active' : '' }}" href="{{ route('tasks.index')}}">
                            <i class="bi bi-list-task"></i> Tâches
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('stocks.*') ? 'active' : '' }}" href="{{ route('stocks.index') }}">
                            <i class="bi bi-box"></i> Stock
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('material-usages.*') ? 'active' : '' }}" href="{{ route('material-usages.index') }}">
                            <i class="bi bi-text-indent-left"></i> Utilisation Materielle
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('payments.*') ? 'active' : '' }}" href="{{ route('payments.index') }}">
                            <i class="bi bi-cash-coin"></i> Payement
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('reports.*') ? 'active' : '' }}" href="{{ route('reports.index') }}">
                            <i class="bi bi-file-earmark-text"></i> Rapports
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}">
                            <i class="bi bi-people"></i> Utilisateurs
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <i class="bi bi-person-circle me-1"></i>
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href=""
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                <i class="bi bi-box-arrow-right me-2"></i>
                                {{ __('Déconnexion') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>

    <!-- Pour la traduction en français -->
    <script src="https://cdn.datatables.net/plug-ins/1.10.25/i18n/French.json"></script>
    @yield('scripts')
</body>
</html>
