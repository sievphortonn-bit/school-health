<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Battambang:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Battambang:wght@300;400;500;600;700&family=Koulen&display=swap">

    <!-- Bootstrap Icons & CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Favicon -->
    <link rel="shortcut icon" href="http://school-health-xjs-health.vercel.app/img/Logo-Xavier.png" type="image/x-icon">
    <link rel="icon" href="http://school-health-xjs-health.vercel.app/img/Logo-Xavier.png" type="image/png">
    <link rel="apple-touch-icon" sizes="180x180" href="http://school-health-xjs-health.vercel.app/img/Logo-Xavier.png">

    <!-- Master Dashboard CSS -->
    <link rel="stylesheet" href="http://school-health-xjs-health.vercel.app/css/dashboard.css">

    @stack('styles')

    <style>
        :root {
            --primary: #355912;
            --secondary: #F2BF27;
            --warning: #F2921D;
            --dark: #402709;
            --danger: #C1312D;
            --success: #10710f; /* kept as is */
            --light: #f8f9fa;
            --sidebar-width: 280px;
            --header-height: 70px;
            --transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        body {
            font-family: 'Inter', 'Battambang', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #e9ecef 100%);
            overflow-x: hidden;
        }

        /* ============= MODERN GLASS NAVBAR ============= */
        .glass-navbar {
            background: rgba(255, 255, 255, 0.75);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            height: var(--header-height);
            padding: 0 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 1030;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02);
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }

        .brand-logo {
            height: 42px;
            width: auto;
            transition: var(--transition);
        }

        .brand-logo:hover {
            transform: scale(1.05);
        }

        .brand-text {
            font-family: Koulen;
            font-size: 18px;
            font-weight: 700;
            color: var(--dark);
            letter-spacing: 0.3px;
        }

        /* ============= MODERN USER DROPDOWN ============= */
        .user-dropdown {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 6px 12px;
            border-radius: 40px;
            transition: var(--transition);
            cursor: pointer;
            text-decoration: none;
            background: rgba(0,0,0,0.02);
        }

        .user-dropdown:hover {
            background: rgba(0,0,0,0.04);
        }

        .user-avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid white;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        }

        .user-name {
            font-weight: 600;
            color: var(--dark);
            font-size: 14px;
        }

        .dropdown-menu-modern {
            border: none;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.08);
            padding: 12px;
            min-width: 240px;
            background: rgb(255, 255, 255);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255,255,255,0.3);

        }

        .dropdown-item-modern {
            padding: 10px 16px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 12px;
            color: var(--dark);
            transition: var(--transition);
            font-size: 14px;
            text-decoration: none;
        }

        .dropdown-item-modern i {
            font-size: 18px;
            color: #6c757d;
            width: 20px;
            text-align: center;
        }

        .dropdown-item-modern:hover {
            background: rgba(53, 89, 18, 0.08);
            color: var(--primary);
        }

        .dropdown-item-modern:hover i {
            color: var(--primary);
        }

        .logout-btn {
            width: 100%;
            padding: 10px 16px;
            border-radius: 12px;
            background: var(--danger);
            color: white;
            border: none;
            font-weight: 600;
            font-size: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: var(--transition);
        }

        .logout-btn:hover {
            background: #a32824;
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(193, 49, 45, 0.25);
        }

        /* ============= MODERN GLASS SIDEBAR ============= */
        .glass-sidebar {
            position: fixed;
            left: 0;
            top: var(--header-height);
            width: var(--sidebar-width);
            height: calc(100vh - var(--header-height));
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-right: 1px solid rgba(255, 255, 255, 0.3);
            padding: 24px 16px;
            overflow-y: auto;
            z-index: 1020;
            box-shadow: 2px 0 20px rgba(0,0,0,0.02);
        }

        .sidebar-section {
            margin-bottom: 28px;
        }

        .sidebar-header {
            padding: 0 16px;
            margin-bottom: 12px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            color: rgba(64, 39, 9, 0.5);
        }

        /* Main navigation links */
        .nav-link-glass {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 12px 16px;
            color: var(--dark);
            text-decoration: none;
            font-size: 15px;
            font-weight: 500;
            border-radius: 14px;
            transition: var(--transition);
            margin-bottom: 4px;
            border: 1px solid transparent;
        }

        .nav-link-glass i {
            font-size: 20px;
            color: rgba(64, 39, 9, 0.6);
            width: 24px;
            text-align: center;
            transition: var(--transition);
        }

        .nav-link-glass:hover {
            background: rgba(53, 89, 18, 0.06);
            border-color: rgba(53, 89, 18, 0.1);
            color: var(--primary);
            transform: translateX(4px);
        }

        .nav-link-glass:hover i {
            color: var(--primary);
        }

        .nav-link-glass.active {
            background: var(--primary);
            border-color: rgba(53, 89, 18, 0.2);
            color: var(--light);
            font-weight: 600;
            box-shadow: 0 6px 12px rgba(53, 89, 18, 0.08);
        }

        .nav-link-glass.active i {
            color: var(--light);
        }

        /* Toggle link with chevron */
        .nav-link-toggle {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .nav-link-toggle .chevron {
            font-size: 14px;
            transition: transform 0.3s;
            color: rgba(64, 39, 9, 0.5);
        }

        .nav-link-toggle[aria-expanded="true"] .chevron {
            transform: rotate(180deg);
        }

        /* Sub-links container */
        .sub-links-container {
            margin-left: 28px;
            margin-top: 6px;
            margin-bottom: 8px;
            padding-left: 16px;
            border-left: 2px solid rgba(53, 89, 18, 0.2);
        }

        .nav-link-sub {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 16px;
            color: var(--dark);
            text-decoration: none;
            font-size: 14px;
            border-radius: 12px;
            transition: var(--transition);
            margin-bottom: 2px;
            opacity: 0.85;
        }

        .nav-link-sub i {
            font-size: 16px;
            color: rgba(64, 39, 9, 0.5);
            width: 20px;
            text-align: center;
        }

        .nav-link-sub:hover {
            background: rgba(53, 89, 18, 0.05);
            color: var(--primary);
            opacity: 1;
        }

        .nav-link-sub.active {
            background: rgba(53, 89, 18, 0.1);
            color: var(--primary);
            font-weight: 600;
            opacity: 1;
        }

        .nav-link-sub.active i {
            color: var(--primary);
        }

        /* Sidebar footer */
        .sidebar-footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid rgba(64, 39, 9, 0.1);
            text-align: center;
            color: rgba(64, 39, 9, 0.5);
            font-size: 12px;
        }

        .sidebar-footer img {
            height: 30px;
            opacity: 0.5;
            margin-bottom: 8px;
        }

        /* ============= CONTENT AREA ============= */
        .content-wrapper {
            margin-left: var(--sidebar-width);
            padding: 30px;
            min-height: calc(100vh - var(--header-height));
            background: #f0f2f5;
            transition: var(--transition);
            width: calc(100% - var(--sidebar-width));
            box-sizing: border-box;
        }

        /* Scrollbar styling */
        .glass-sidebar::-webkit-scrollbar {
            width: 6px;
        }
        .glass-sidebar::-webkit-scrollbar-track {
            background: transparent;
        }
        .glass-sidebar::-webkit-scrollbar-thumb {
            background: rgba(64, 39, 9, 0.2);
            border-radius: 10px;
        }
        .glass-sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(64, 39, 9, 0.4);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .glass-sidebar {
                transform: translateX(-100%);
                width: 280px !important;
            }
            .content-wrapper {
                margin-left: 0 !important;
                width: 100% !important;
            }
            .brand-text {
                display: none;
            }
            .glass-navbar {
                padding: 0 15px;
            }
        }

        /* Animations */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .nav-link-glass, .nav-link-sub {
            animation: fadeInUp 0.3s ease backwards;
        }
    </style>
</head>
<body>

<!-- ================= MODERN GLASS NAVBAR ================= -->
<nav class="glass-navbar">
    <a class="navbar-brand" href="{{ route('dashboard') }}">
        <img src="http://school-health-xjs-health.vercel.app/img/Logo-Xavier.png" alt="Logo" class="brand-logo">
        <span class="brand-text d-none d-md-inline" style="font-family: Koulen;">ប្រព័ន្ធគ្រប់គ្រងសុខភាពសាលារៀន</span>
    </a>

    @auth
    <div class="dropdown">
        <a href="#" class="user-dropdown" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="{{ Auth::user()->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=355912&color=fff' }}"
                 class="user-avatar"
                 alt="User">
            <span class="user-name d-none d-md-inline">{{ Auth::user()->name }}</span>
        </a>

        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-modern" aria-labelledby="userDropdown">
            <li>
                <div class="px-3 py-2">
                    <div class="fw-bold" style="color: var(--dark);">{{ Auth::user()->name }}</div>
                    <small class="text-muted">{{ Auth::user()->email }}</small>
                </div>
            </li>
            <li><hr class="dropdown-divider"></li>
            <li>
                <a class="dropdown-item-modern" href="/profile">
                    <i class="bi bi-person-circle"></i>
                    គណនីរបស់ខ្ញុំ
                </a>
            </li>
            <li>
                <a class="dropdown-item-modern" href="/settings">
                    <i class="bi bi-gear"></i>
                    ការកំណត់
                </a>
            </li>
            <li><hr class="dropdown-divider"></li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="logout-btn">
                        <i class="bi bi-box-arrow-right"></i>
                        ចាកចេញ
                    </button>
                </form>
            </li>
        </ul>
    </div>
    @endauth
</nav>

<!-- ================= MODERN GLASS SIDEBAR ================= -->
@auth
<div class="glass-sidebar">
    <!-- Dashboard -->
    <div class="sidebar-section">
        <div class="sidebar-header">មេ</div>
        <a href="{{ route('dashboard') }}"
           class="nav-link-glass {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i>
            <span>ផ្ទាំងគ្រប់គ្រង</span>
        </a>
    </div>

    <!-- Staff & Teachers -->
    <div class="sidebar-section">
        <div class="sidebar-header">ធនធានមនុស្ស</div>
        <a href="{{ url('/staff') }}"
           class="nav-link-glass {{ request()->is('staff*') ? 'active' : '' }}">
            <i class="bi bi-person-workspace"></i>
            <span>បុគ្គលិក</span>
        </a>
        <a href="/teachers"
           class="nav-link-glass {{ request()->is('teachers*') ? 'active' : '' }}">
            <i class="bi bi-person-badge"></i>
            <span>គ្រូបង្រៀន</span>
        </a>
    </div>

    <!-- Students with Collapse -->
    <div class="sidebar-section">
        <div class="sidebar-header">សិស្ស</div>
        <a class="nav-link-glass nav-link-toggle {{ (request()->is('students*') || request()->is('all*') || request()->is('grade*')) ? 'active' : '' }}"
           data-bs-toggle="collapse"
           href="#studentCollapse"
           role="button"
           aria-expanded="{{ request()->is('students*') || request()->is('all*') || request()->is('grade*') ? 'true' : 'false' }}">
            <span style="display: flex; align-items: center; gap: 14px;">
                <i class="bi bi-people"></i>
                <span>សិស្ស</span>
            </span>
            <i class="bi bi-chevron-down chevron"></i>
        </a>

        <div class="collapse {{ request()->is('students*') || request()->is('all*') || request()->is('grade*') ? 'show' : '' }}"
             id="studentCollapse">
            <div class="sub-links-container">
                <a href="{{ route('students.all') }}"
                   class="nav-link-sub {{ request()->is('all') || request()->is('grade*') ? 'active' : '' }}">
                    <i class="bi bi-grid-3x3-gap-fill"></i>
                    <span>សិស្សតាមថ្នាក់</span>
                </a>
                <a href="{{ route('students.index') }}"
                   class="nav-link-sub {{ request()->is('students') && !request()->is('students/*') ? 'active' : '' }}">
                    <i class="bi bi-person-plus"></i>
                    <span>បញ្ចូលសិស្សថ្មី</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Patients -->
    <div class="sidebar-section">
        <div class="sidebar-header">ពេទ្យ</div>
        <a href="/patients"
           class="nav-link-glass {{ request()->is('patients*') && !request()->is('patients/report*') ? 'active' : '' }}">
            <i class="bi bi-clipboard-heart"></i>
            <span>អ្នកជំងឺ</span>
        </a>
        <a href="{{ route('patients.report') }}"
           class="nav-link-glass {{ request()->routeIs('patients.report*') ? 'active' : '' }}">
            <i class="bi bi-bar-chart"></i>
            <span>របាយការណ៍</span>
        </a>
    </div>

    <!-- Sidebar Footer -->
    <div class="sidebar-footer">
        <img src="http://school-health-xjs-health.vercel.app/img/Logo-Xavier.png" alt="Logo">
        <p class="mb-0">សាលាសន្តសាវីយេ</p>
        <p style="font-size: 11px;">© {{ date('Y') }} រក្សាសិទ្ធិគ្រប់យ៉ាង</p>
    </div>
</div>
@endauth

<!-- ================= PAGE CONTENT ================= -->
<div class="content-wrapper">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
