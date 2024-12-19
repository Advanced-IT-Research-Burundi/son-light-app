<nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container-fluid">
        {{-- Logo --}}
        <a class="navbar-brand" href="{{ route('dashboard') }}" style="font-family: 'Teko', sans-serif;">
            <img src="{{ asset('images/logo.png') }}" alt="Son Light Logo" style="width: auto; height: 50px" class="d-inline-block align-top">
        </a>

        {{-- Bouton hamburger --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">
                <i class="bi bi-list bg-white"></i>
            </span>
        </button>

        {{-- Contenu de la navbar qui sera collapsé sur mobile --}}
        <div class="collapse navbar-collapse" id="navbarContent">
            {{-- Menu principal --}}
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        <i class="bi bi-speedometer2"></i> Home
                    </a>
                </li>

                @if (auth()->user()->isAdmin())
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}">
                        <i class="bi bi-people"></i> Users
                    </a>
                </li>
                @endif

                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('clients.*') ? 'active' : '' }}" href="{{ route('clients.index') }}">
                        <i class="bi bi-people"></i> Clients
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('proforma_invoices.*') ? 'active' : '' }}" href="{{ route('proforma_invoices.index') }}">
                        <i class="bi bi-cart"></i> Proforma
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('order_alllist') ? 'active' : '' }}" href="{{ route('order_alllist') }}">
                        <i class="bi bi-cart"></i> Commandes
                    </a>
                </li>
                   <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('invoices.*') ? 'active' : '' }}" href="{{ route('order_alllist') }}">
                        <i class="bi bi-cart"></i> Factures
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('tasks.*') ? 'active' : '' }}" href="{{ route('tasks.index')}}">
                        <i class="bi bi-list-task"></i> Tâches
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('payments.*') ? 'active' : '' }}" href="{{ route('payments.index') }}">
                        <i class="bi bi-cash-coin"></i> Paiement
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('companies.*') ? 'active' : '' }}" href="{{ route('companies.index') }}">
                        <i class="bi bi-building"></i> Entreprises
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('stocks.*') ? 'active' : '' }}" href="{{ route('stocks.index') }}">
                        <i class="bi bi-box"></i> Stock
                    </a>
                </li>
                   <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('cash_register_receipts.*') ? 'active' : '' }}" href="{{ route('cash_register_receipts.index') }}">
                        <i class="bi bi-box"></i> BSC
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('material-usages.*') ? 'active' : '' }}" href="{{ route('material-usages.index') }}">
                        <i class="bi bi-text-indent-left"></i> Util Mat
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('reports.*') ? 'active' : '' }}" href="{{ route('reports.index') }}">
                        <i class="bi bi-file-earmark-text"></i> Rapports
                    </a>
                </li>
            </ul>

            {{-- Menu utilisateur --}}
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    @livewire('dashoboards.badge')
                </li>

                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <i class="bi bi-person-circle me-1"></i>
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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

{{-- Styles personnalisés pour améliorer la navigation responsive --}}
<style>
@media (max-width: 991.98px) {


    .dropdown-menu {
        border: none;
        padding: 0;
        margin: 0;
    }

    .dropdown-item {
        padding: 0.5rem 1rem;
    }

    /* Améliorer la visibilité du menu déroulant sur mobile */
    .navbar-collapse {
        padding: 1rem;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
}

/* Styles généraux */
.navbar-custom {
    background-color: white;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.nav-link {
    color: #333;
    transition: color 0.3s ease;
}

.nav-link:hover, .nav-link.active {
    color: #007bff;
}

.dropdown-item:active {
    background-color: #007bff;
}
</style>
