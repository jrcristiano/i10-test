<div class="vh-100 border-end px-3">
    <ul class="nav flex-column pt-3 pb-3">
        <li class="nav-item">
            <a class="nav-link" aria-current="page" href="#">
                <x-application-logo />
            </a>
        </li>
    </ul>
    <ul id="dashboard-nav" class="nav flex-column ps-3">
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
        <li class="nav-item">
            <a class="nav-link d-flex rounded align-items-center {{ request()->is('artigos*') ? 'active' : '' }}"
               href="{{ url('artigos') }}">
                <div class="svg-container ms-2 me-3 d-flex justify-content-center align-items-center rounded-pill">
                    <svg fill="#2D343C" xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 512 512">
                        <path d="M96 96c0-35.3 28.7-64 64-64l288 0c35.3 0 64 28.7 64 64l0 320c0 35.3-28.7 64-64 64L80 480c-44.2 0-80-35.8-80-80L0 128c0-17.7 14.3-32 32-32s32 14.3 32 32l0 272c0 8.8 7.2 16 16 16s16-7.2 16-16L96 96zm64 24l0 80c0 13.3 10.7 24 24 24l112 0c13.3 0 24-10.7 24-24l0-80c0-13.3-10.7-24-24-24L184 96c-13.3 0-24 10.7-24 24zm208-8c0 8.8 7.2 16 16 16l48 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-48 0c-8.8 0-16 7.2-16 16zm0 96c0 8.8 7.2 16 16 16l48 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-48 0c-8.8 0-16 7.2-16 16zM160 304c0 8.8 7.2 16 16 16l256 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-256 0c-8.8 0-16 7.2-16 16zm0 96c0 8.8 7.2 16 16 16l256 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-256 0c-8.8 0-16 7.2-16 16z"/>
                    </svg>
                </div>
                <span class="ms-2">Artigos</span>
            </a>
        </li>
    </ul>
</div>
