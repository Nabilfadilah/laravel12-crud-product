<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .sidebar {
            background-color: #fff;
            border-right: 1px solid #dee2e6;
            min-height: 100vh;
        }

        .nav-link {
            color: #333;
            transition: 0.2s ease;
        }

        .nav-link:hover,
        .nav-link.active {
            background-color: #f1f3f5;
            color: #0d6efd;
        }

        .sidebar {
            background-color: #fff;
            border-right: 1px solid #dee2e6;
            min-height: 100vh;
            z-index: 1030;
            /* biar nongol di atas */
            overflow-y: auto;
        }

        .main-content {
            margin-left: 220px;
            padding: 80px 20px 20px;
            min-height: 100vh;
            background-color: #f8f9fa;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm fixed-top">
        <div class="container-fluid">
            <button class="btn btn-outline-secondary d-md-none me-2" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#sidebarMobile">
                <i class="bi bi-list"></i>
            </button>
            <a class="navbar-brand fw-bold" href="#">MyApp</a>
            <div class="ms-auto">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-sm btn-outline-danger">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Sidebar (desktop) -->
    <div class="d-none d-md-block sidebar position-fixed px-3 py-4" style="width: 220px; top: 56px;">
        @include('layouts.sidebar')
    </div>

    <!-- Sidebar (mobile) -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="sidebarMobile">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title">Menu</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
            @include('layouts.sidebar')
        </div>
    </div>

    <!-- Main -->
    <main class="main-content" style="margin-left: 220px; padding: 80px 20px 20px">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
