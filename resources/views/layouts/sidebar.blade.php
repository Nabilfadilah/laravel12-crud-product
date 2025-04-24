<ul class="nav flex-column">
    <!-- link ke halaman Profile -->
    <li class="nav-item mb-2">
        <a href="{{ route('users.profile') }}" class="nav-link {{ request()->is('profile*') ? 'active' : '' }}">
            <i class="bi bi-person me-2"></i> Profile
        </a>
    </li>

    <!-- link ke halaman Products, hanya muncul jika user role-nya 'user' -->
    @if (auth()->user()->role === 'user')
        <li class="nav-item mb-2">
            <a href="{{ route('products.index') }}" class="nav-link {{ request()->is('products*') ? 'active' : '' }}">
                <i class="bi bi-box-seam me-2"></i> Products
            </a>
        </li>
    @endif

    <!-- link ke halaman Users, hanya muncul jika role-nya 'admin' -->
    @if (auth()->user()->role === 'admin')
        <li class="nav-item mb-2">
            <a href="{{ route('users.index') }}" class="nav-link {{ request()->is('users*') ? 'active' : '' }}">
                <i class="bi bi-people me-2"></i> Users
            </a>
        </li>
    @endif
</ul>
