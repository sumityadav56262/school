<nav class="text-center text-white c_nav d-flex justify-content-around align-items-center bg-dark py-2">
    <h1 class="mb-0">Sapience Academy</h1>

    <div class="dropdown">
        <button class="btn d-flex align-items-center text-light" type="button" id="userMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-user-circle fa-2x me-2"></i>
        </button>

        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenuButton">

            {{-- Subscription Status --}}
            @if(session()->has('subscription_expired'))
                @if(session('subscription_expired'))
                    <li>
                        <span class="dropdown-item text-danger">Subscription expired</span>
                    </li>
                @else
                    <li>
                        <span class="dropdown-item text-success">
                            {{ session('subscription_days_left') }} day{{ session('subscription_days_left') == 1 ? '' : 's' }} left
                        </span>
                    </li>
                @endif
                <li><hr class="dropdown-divider"></li>
            @endif

            {{-- Other Actions --}}
            <li>
                <a class="dropdown-item" href="{{ route('password.change') }}">Change Password</a>
            </li>
            <li>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="dropdown-item text-danger">Logout</button>
                </form>
            </li>
        </ul>
    </div>
</nav>
