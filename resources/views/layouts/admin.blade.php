<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sightseeing Academy - @yield('title', 'Dashboard Admin')</title>
    <link rel="stylesheet" href="{{ asset('css/Adm/adminlayout.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    @stack('styles')
</head>


<body>

    <aside class="admin-sidebar bg-custom-sidebar">
        <div>
            <div class="admin-sidebar-logo">
                <img src="{{ asset('storage/uploads/logoEmpresa.png') }}" alt="Imagem do Projeto">
                <img src="{{ asset('storage/uploads/nomeEmpresa.png') }}" alt="Imagem do Projeto">
            </div>

            <nav class="admin-nav">
                <a href="{{ route('Adm.dashboard') }}"
                    class="admin-nav-link {{ request()->routeIs('Adm.dashboard') ? 'is-active' : '' }}">
                    <span>📊</span> <span>Dashboard</span>
                </a>
                {{-- TODO: criar rota "adm.emandamento.index" quando a tela existir --}}
                <a href="{{ route('Adm.tourist_points.index') }}" class="admin-nav-link">
                    <span>🚌</span> <span>Pontos turisticos</span>
                </a>
                <a href="{{ route('adm.schools.index') }}"
                    class="admin-nav-link {{ request()->routeIs('adm.schools.*') ? 'is-active' : '' }}">
                    <span>🏫</span> <span>Escolas</span>
                </a>
                <a href="#" class="admin-nav-link">
                    <span>⏳</span> <span>Em Andamento</span>
                </a>
                {{-- TODO: criar rota "adm.concluidos.index" quando a tela existir --}}
                <a href="#" class="admin-nav-link">
                    <span>✅</span> <span>Concluídos</span>
                </a>

                {{-- TODO: criar rota "adm.gerentes.index" quando a tela existir --}}
                <a href="#" class="admin-nav-link">
                    <span>👔</span> <span>Gerentes</span>
                </a>
                {{-- TODO: criar rota "adm.monitores.index" quando a tela existir --}}
                <a href="#" class="admin-nav-link">
                    <span>🧭</span> <span>Monitores</span>
                </a>
            </nav>
        </div>

        <div class="admin-sidebar-footer">
            {{-- TODO: criar rota "adm.perfil" quando a tela existir --}}
            <a href="#" class="admin-footer-link">
                <span>👤</span> <span>Perfil</span>
            </a>
            {{-- TODO: criar rota "logout" (ex: via Breeze/Fortify ou manualmente) quando existir --}}
            <a href="#" class="admin-footer-link is-logout">
                <span>🚪</span> <span>Sair</span>
            </a>
        </div>
    </aside>

    <main class="admin-main bg-custom-orange">

        <header class="admin-header">
            <h1 class="admin-header-title">@yield('page-title', 'Dashboard ADMIN')</h1>

            <div class="admin-user-box">
                <div class="admin-user-info">
                    <p class="admin-user-name">
                        {{ auth()->user()->name ?? 'César Vinícius' }}
                    </p>
                    <span class="admin-user-role">{{ auth()->user()->role ?? 'Administrator' }}</span>
                </div>
                <div class="admin-user-avatar">
                    {{ auth()->user()->initials ?? 'CV' }}
                </div>
            </div>
        </header>

        {{-- Conteúdo específico de cada página entra aqui --}}
        @yield('content')

    </main>

    @stack('scripts')
</body>

</html>