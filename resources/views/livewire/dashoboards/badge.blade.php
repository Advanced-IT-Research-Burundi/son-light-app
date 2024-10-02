<a href="{{ route('alerts.index') }}">
<div class="cursor-pointer" style="cursor: pointer;">
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <span class="badge {{$badgeClass}} position-relative" style="font-size: 1.2em;">
            <i class="bi bi-bell-fill"></i>
            @if ( $totalAlerts > 0)
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6em;">
                    {{ $totalAlerts }}
                    <span class="visually-hidden">alertes non lues</span>
                </span>
            @endif
    </span>
</div>
</a>



