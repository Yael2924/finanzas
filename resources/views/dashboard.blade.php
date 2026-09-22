<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finanzas | Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('spark-admin/assets/libs/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('spark-admin/assets/libs/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('spark-admin/assets/libs/apexcharts/apexcharts.css') }}">
    <link rel="stylesheet" href="{{ asset('spark-admin/assets/libs/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('spark-admin/assets/css/main.css') }}">
</head>
<body>
    <div class="sidebar-wrapper" id="sidebar">
        <a href="{{ route('dashboard') }}" class="sidebar-brand">
            <i class="bi bi-coin"></i>
            <span>Finanzas</span>
        </a>

        <div class="flex-grow-1 overflow-y-auto">
            <div class="sidebar-menu-section">
                <div class="sidebar-menu-title">Menú</div>
                <ul class="sidebar-menu-list">
                    <li class="sidebar-menu-item">
                        <a href="{{ route('dashboard') }}" class="sidebar-menu-link active">
                            <i class="bi bi-grid-fill"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="sidebar-menu-section">
                <div class="sidebar-menu-title">Finanzas</div>
                <ul class="sidebar-menu-list">
                    <li class="sidebar-menu-item">
                        <a href="#" class="sidebar-menu-link">
                            <i class="bi bi-wallet2"></i>
                            <span>Ingresos</span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item">
                        <a href="#" class="sidebar-menu-link">
                            <i class="bi bi-cash-stack"></i>
                            <span>Egresos</span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item">
                        <a href="#" class="sidebar-menu-link">
                            <i class="bi bi-piggy-bank"></i>
                            <span>Metas</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="sidebar-profile">
            <img src="{{ asset('spark-admin/assets/images/avatar.png') }}" alt="Administrador" class="sidebar-profile-img">
            <div class="sidebar-profile-info">
                <div class="sidebar-profile-name">Administrador</div>
                <div class="sidebar-profile-email">admin@finanzas.local</div>
            </div>
        </div>
    </div>

    <div class="main-wrapper">
        <header class="navbar-custom">
            <div class="navbar-left">
                <button class="btn-desktop-toggle d-none d-xl-flex align-items-center justify-content-center me-3" aria-label="Minimizar sidebar">
                    <i class="bi bi-chevron-bar-left"></i>
                </button>
                <button class="sidebar-toggle-btn me-2" aria-label="Toggle Navigation">
                    <i class="bi bi-list"></i>
                </button>
            </div>

            <div class="navbar-search-wrapper">
                <input type="text" class="navbar-search-input" placeholder="Buscar en Finanzas..." id="main-search">
                <button class="navbar-search-btn" aria-label="Buscar">
                    <i class="bi bi-search"></i>
                </button>
            </div>

            <div class="navbar-actions">
                <button class="navbar-action-btn me-1" aria-label="Pantalla completa" id="btn-fullscreen">
                    <i class="bi bi-arrows-fullscreen"></i>
                </button>

                <div class="dropdown">
                    <button class="navbar-action-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="btn-notifications">
                        <i class="bi bi-bell"></i>
                        <span class="navbar-action-badge"></span>
                    </button>
                </div>

                <div class="dropdown ms-2">
                    <button class="navbar-profile-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="profile-dropdown">
                        <img src="{{ asset('spark-admin/assets/images/avatar.png') }}" alt="Profile" class="navbar-profile-img">
                        <span class="navbar-profile-name d-none d-md-inline">Administrador</span>
                        <i class="bi bi-chevron-down navbar-profile-caret"></i>
                    </button>
                </div>
            </div>
        </header>

        <div class="page-header">
            <div>
                <h1 class="page-title">Dashboard financiero</h1>
                <p class="page-subtitle">Control de ingresos, egresos y metas de ahorro.</p>
            </div>
            <button class="btn-date-picker" type="button">
                <i class="bi bi-calendar4-event"></i>
                <span>{{ now()->translatedFormat('F d, Y') }}</span>
            </button>
        </div>

        <div class="row g-4">
            <div class="col-12">
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="card alert-green-card">
                            <div class="position-relative z-index-2">
                                <span class="alert-green-badge">Resumen</span>
                                <div class="alert-green-date">{{ now()->translatedFormat('M d, Y') }}</div>
                                <div class="alert-green-text">Ingresos acumulados del mes</div>
                            </div>
                            <a href="#" class="alert-green-link z-index-2">
                                <span>Ver detalles</span>
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card card-stat d-flex flex-column justify-content-between">
                            <div>
                                <div class="card-header">
                                    <span class="stat-label">Ingresos</span>
                                </div>
                                <div class="stat-value">$ {{ number_format($totalIngresos, 2) }}</div>
                                <div class="trend-badge trend-up">
                                    <i class="bi bi-arrow-up-right"></i>
                                    <span>Totales registrados</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card card-stat d-flex flex-column justify-content-between">
                            <div>
                                <div class="card-header">
                                    <span class="stat-label">Egresos</span>
                                </div>
                                <div class="stat-value">$ {{ number_format($totalEgresos, 2) }}</div>
                                <div class="trend-badge trend-down">
                                    <i class="bi bi-arrow-down-left"></i>
                                    <span>Gastos registrados</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-9 col-lg-8">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="card mb-0">
                            <div class="card-header mb-2">
                                <h2 class="card-title">Resumen financiero</h2>
                            </div>
                            <div class="d-flex align-items-baseline gap-2 mb-3">
                                <span class="stat-value-amount">$ {{ number_format($totalIngresos - $totalEgresos, 2) }}</span>
                                <span class="trend-badge trend-up fs-xs">Saldo neto</span>
                            </div>
                            <div id="revenue-chart"></div>
                        </div>
                    </div>

                    <div class="col-md-7 d-flex flex-column">
                        <div class="card h-100 flex-grow-1">
                            <div class="card-header">
                                <h2 class="card-title">Últimos movimientos</h2>
                            </div>

                            <div class="transaction-list">
                                @forelse($ultimosMovimientos as $mov)
                                    <div class="transaction-item">
                                        <div class="transaction-icon bg-forest-light text-lime">
                                            <i class="bi {{ $mov->tipo === 'INGRESO' ? 'bi-arrow-down-left' : 'bi-arrow-up-right' }}"></i>
                                        </div>
                                        <div class="transaction-info">
                                            <div class="transaction-name">{{ $mov->nombre }}</div>
                                            <div class="transaction-date">{{ \Carbon\Carbon::parse($mov->fecha)->translatedFormat('d M, Y • H:i') }}</div>
                                        </div>
                                        <div class="transaction-amount {{ $mov->tipo === 'INGRESO' ? 'text-success' : 'text-main' }}">
                                            {{ $mov->tipo === 'INGRESO' ? '+' : '-' }}$ {{ number_format($mov->monto, 2) }}
                                        </div>
                                    </div>
                                @empty
                                    <div class="transaction-item">
                                        <div class="transaction-info">
                                            <div class="transaction-name">Sin movimientos aún</div>
                                            <div class="transaction-date">Registra ingresos o egresos para ver el historial.</div>
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5 d-flex flex-column">
                        <div class="card h-100 flex-grow-1">
                            <div class="card-header">
                                <h2 class="card-title">Metas de ahorro</h2>
                            </div>

                            @forelse($metas as $meta)
                                <div class="progress-container">
                                    <div class="progress-label-row">
                                        <span class="progress-label">{{ $meta->nombre }}</span>
                                        <span class="progress-value">$ {{ number_format($meta->saldo, 2) }}</span>
                                    </div>
                                    <div class="progress" role="progressbar" aria-valuenow="{{ min(100, ($meta->saldo / max($meta->monto_meta, 1)) * 100) }}" aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar bg-lime-accent" style="width: {{ min(100, ($meta->saldo / max($meta->monto_meta, 1)) * 100) }}%"></div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-muted">No hay metas registradas.</div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4">
                <div class="right-panel-wrapper d-flex flex-column gap-4 h-100">
                    <div class="card flex-grow-1 d-flex flex-column justify-content-between mb-0">
                        <div class="card-header mb-1">
                            <h2 class="card-title">Categorías</h2>
                        </div>

                        @forelse($resumenPorCategoria as $categoria)
                            <div class="progress-container">
                                <div class="progress-label-row">
                                    <span class="progress-label">{{ $categoria->categoria }}</span>
                                    <span class="progress-value">$ {{ number_format($categoria->total, 2) }}</span>
                                </div>
                                <div class="progress" role="progressbar" aria-valuenow="{{ min(100, ($categoria->total / max($totalEgresos, 1)) * 100) }}" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar bg-brand-orange" style="width: {{ min(100, ($categoria->total / max($totalEgresos, 1)) * 100) }}%"></div>
                                </div>
                            </div>
                        @empty
                            <div class="text-muted">Sin categorías registradas.</div>
                        @endforelse
                    </div>

                    <div class="promo-banner-card">
                        <h3 class="promo-title">Resumen de tu flujo</h3>
                        <p class="promo-desc">Total de categorías de ingresos: {{ $totalCategoriasIngresos }}</p>
                        <p class="promo-desc">Total de categorías de egresos: {{ $totalCategoriasEgresos }}</p>
                        <p class="promo-desc">Metas registradas: {{ $totalMetas > 0 ? number_format($totalMetas, 2) : '0.00' }}</p>
                        <button class="btn-promo" type="button">Revisar detalle</button>
                    </div>
                </div>
            </div>
        </div>

        <footer class="footer-custom">
            <div class="footer-left">
                <span class="footer-logo"><i class="bi bi-coin"></i> Finanzas</span>
                <span class="footer-separator">|</span>
                <span class="footer-copy">&copy; {{ now()->year }} · Dashboard administrativo</span>
            </div>
        </footer>
    </div>

    <script src="{{ asset('spark-admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('spark-admin/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('spark-admin/assets/js/dashboard.js') }}"></script>
</body>
</html>
