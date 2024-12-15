<div class="vh-100 border-end">
    <ul class="nav border-bottom px-3 flex-column pt-3 pb-3 mb-2">
        <li class="nav-item">
            <a class="nav-link" aria-current="page" href="#">
                <x-application-logo />
            </a>
        </li>
    </ul>
    <ul id="dashboard-nav" class="nav px-3 flex-column ps-3">
        <li class="nav-item">
            <a class="nav-link rounded py-3 {{ request()->routeIs('home') ? 'active' : '' }}"
               aria-current="page" href="{{ route('home') }}">
                <i class="bi bi-house-door-fill ms-2 me-3 rounded-pill"></i> Início
            </a>
        </li>
        <li class="nav-item rounded">
            <a class="nav-link py-3 rounded {{ request()->routeIs('categories.index') ? 'active' : '' }}"
               href="{{ route('categories.index') }}">
                <i class="bi bi-grid-fill ms-2 me-3 rounded-pill"></i> Categorias
            </a>
        </li>

        <li class="nav-item rounded">
            <a class="nav-link py-3 rounded {{ request()->routeIs('articles.index') ? 'active' : '' }}"
               href="{{ route('articles.index') }}">
                <i class="bi bi-newspaper ms-2 me-3 rounded-pill"></i> Artigos
            </a>
        </li>

    </ul>
</div>
