<ul class="nav flex-column">
    <li class="nav-item mb-2">
        <a href="{{ route('users.profile') }}" class="nav-link {{ request()->is('profile*') ? 'active' : '' }}">
            <i class="bi bi-person me-2"></i> Profile
        </a>
    </li>

    @if (auth()->user()->role === 'user')
        <li class="nav-item mb-2">
            <a href="{{ route('products.index') }}" class="nav-link {{ request()->is('products*') ? 'active' : '' }}">
                <i class="bi bi-box-seam me-2"></i> Products
            </a>
        </li>
    @endif

    @if (auth()->user()->role === 'admin')
        <li class="nav-item mb-2">
            <a href="{{ route('users.index') }}" class="nav-link {{ request()->is('users*') ? 'active' : '' }}">
                <i class="bi bi-people me-2"></i> Users
            </a>
        </li>
    @endif
</ul>
