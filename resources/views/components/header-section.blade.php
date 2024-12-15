<div class="w-100">
    <div class="w-100 px-3 d-flex justify-content-between align-items-center">
        <h1 class="i10-text-dark">{{ $title ?? env('APP_NAME') }}</h1>
        <a href="{{ route($routeName) ?? '/' }}" class="btn btn-gold shadow">
            <i class="bi bi-plus"></i> {{ $actionText ?? 'Novo' }}
        </a>
    </div>
</div>
