<nav class="navbar navbar-expand-sm navbar-light bg-light shadow-sm">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav me-auto mb-2 mb-sm-0">
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('cash_registers.*') ? 'active' : '' }}" href="{{ route('cash_registers.index') }}">
                        <i class="bi bi-cash me-2"></i> Caisse
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('receipts.*') ? 'active' : '' }}" href="{{ route('receipts.index') }}">
                        <i class="bi bi-file-earmark-text me-2"></i> Mouvement de la Caisse
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('denominations.*') ? 'active' : '' }}" href="{{ route('denominations.index') }}">
                        <i class="bi bi-stack me-2"></i> Billettage
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
