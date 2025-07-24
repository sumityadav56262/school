<nav class="c_nav d-flex justify-content-between align-items-center px-4 py-3 shadow-sm">
    <div class="d-flex align-items-center">
        <h1 class="mb-0 text-white fw-bold fs-4">🎓 Sapience Academy</h1>
        <span class="badge bg-success ms-3 px-2 py-1">School Management</span>
    </div>

    <div class="dropdown">
        <button class="btn btn-outline-light d-flex align-items-center border-0" type="button" id="userMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-user-circle fa-lg me-2"></i>
            <span class="fw-medium">Admin</span>
            <i class="fas fa-chevron-down ms-2 fa-sm"></i>
        </button>

        <ul class="dropdown-menu dropdown-menu-end mt-2" aria-labelledby="userMenuButton">
            {{-- Subscription Status --}}
            @if(0 && session()->has('subscription_expired'))
                @if(session('subscription_expired'))
                    <li>
                        <span class="dropdown-item text-danger d-flex align-items-center">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            Subscription expired
                        </span>
                    </li>
                @else
                    <li>
                        <span class="dropdown-item text-success d-flex align-items-center">
                            <i class="fas fa-clock me-2"></i>
                            {{ session('subscription_days_left') }} day{{ session('subscription_days_left') == 1 ? '' : 's' }} left
                        </span>
                    </li>
                @endif
                <li><hr class="dropdown-divider"></li>
            @endif

            {{-- Other Actions --}}
            <li>
                <a class="dropdown-item d-flex align-items-center" href="{{ route('password.change') }}">
                    <i class="fas fa-key me-2 text-primary"></i>
                    Change Password
                </a>
            </li>
            <li><hr class="dropdown-divider"></li>
            <li>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="dropdown-item text-danger d-flex align-items-center border-0 bg-transparent">
                        <i class="fas fa-sign-out-alt me-2"></i>
                        Logout
                    </button>
                </form>
            </li>
        </ul>
    </div>
</nav>
