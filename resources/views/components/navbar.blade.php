<div>
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('dashboard') }}" style="font-family: 'Teko', sans-serif;">
                <img src="{{ asset('images/logo.jpeg') }}" alt="Son Light Logo" style="border-radius: 10%" class="d-inline-block align-top">
                {{-- Son Light --}}
            </a>
            {{-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button> --}}
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                            <i class="bi bi-speedometer2"></i> Home
                        </a>
                    </li>
                    @if (auth()->user()->isAdmin())
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}">
                            <i class="bi bi-people"></i> Utilisateurs
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
                            <i class="bi bi-cart"></i> Fact. proforma
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('tasks.*') ? 'active' : '' }}" href="{{ route('tasks.index')}}">
                            <i class="bi bi-list-task"></i> Tâches
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('payments.*') ? 'active' : '' }}" href="{{ route('payments.index') }}">
                            <i class="bi bi-cash-coin"></i> Payement
                        </a>
                    </li>
                   <li  class="nav-item">
                   <a  class="nav-link {{ Request::routeIs('companies.*') ? 'active' : '' }}" href="{{ route('companies.index') }}" class="nav-link"> <i class="bi bi-building"></i> Entreprises</a>
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
                    {{-- @dump() --}}

                        <li>
                            <a class="nav-link {{ Request::routeIs('reports.*') ? 'active' : '' }}" href="{{ route('reports.index') }}">
                                <i class="bi bi-file-earmark-text"></i> Rapports
                            </a>
                        </li>

                </ul>

                <ul class="navbar-nav">
                <li>

                @livewire('dashoboards.badge')

                </li>
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
</div>
