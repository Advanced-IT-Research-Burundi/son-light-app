<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Son Light - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: rgb(26, 35, 126);
        }
        .navbar-custom {
            background-color: var(--primary-color) !important;
        }
        .navbar-custom .navbar-brand,
        .navbar-custom .nav-link {
            color: #ffffff !important;
        }
        .navbar-custom .nav-link:hover {
            color: rgba(255, 255, 255, 0.8);
        }
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        .btn-primary:hover {
            background-color: rgb(21, 28, 100);
            border-color: rgb(21, 28, 100);
        }
    </style>
    @yield('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Son Light</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="#"><i class="bi bi-speedometer2"></i> Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="#"><i class="bi bi-cart"></i> Commandes</a></li>
                    <li class="nav-item"><a class="nav-link" href="#"><i class="bi bi-list-task"></i> Tâches</a></li>
                    <li class="nav-item"><a class="nav-link" href="#"><i class="bi bi-box"></i> Stock</a></li>
                    <li class="nav-item"><a class="nav-link" href="#"><i class="bi bi-file-earmark-text"></i> Rapports</a></li>
                    <li class="nav-item"><a class="nav-link" href="#"><i class="bi bi-people"></i> Utilisateurs</a></li>
                </ul>
            </div>
            <div class="navbar-nav">
                <a class="nav-link" href="#">
                    <i class="bi bi-person-circle" style="font-size: 1.5rem;"></i>
                </a>
                
                    <div class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>
    
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href=""
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
    
                                <i class="bi bi-box-arrow-right"></i>
                                {{ __('Logout') }}
                            </a>
    
                            <form id="logout-form" action="" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
               

               
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>