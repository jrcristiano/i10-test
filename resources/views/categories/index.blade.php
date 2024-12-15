<x-app-layout>
    <div class="d-block col-12 col-xl-10 py-4 bg-white px-0">
            @include('components.i10-header-section', [
            'actionText' => 'Nova categoria',
            'routeName' => 'categories.create',
            'title' => 'Categorias'
        ])

        <div class="w-100 py-4 px-4">
            <form class="w-100 border rounded g-2 d-flex flex-nowrap">
                <div class="w-100 p-1 d-flex align-items-center shadow-sm">
                    <input
                        name="busca"
                        type="text"
                        class="border-0 form-control form-control-lg"
                        placeholder="Buscar categoria por nome"
                    >
                    <button
                        type="submit"
                        class="btn btn-lg btn-gold"
                    >
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </form>
        </div>

        <div class="w-100 py-3 px-4">
            <div class="border i10-table-rounded shadow-sm i10-data-list">
                <table class="table i10-table-rounded mb-0 align-middle table-striped table-hover">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Criada em</th>
                        <th scope="col">Ações</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($categories as $category)
                        <tr>
                            <th class="py-2 i10-text-dark" scope="row">{{ $category->id }}</th>
                            <td class="py-2 i10-text-dark">{{ $category->name }}</td>
                            <td class="py-2 i10-text-dark">{{ $category->created_at_formatted }}</td>
                            <td class="py-2 i10-text-dark">@mdo</td>
                        </tr>
                      @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="w-100 py-2 px-3">
            {{ $categories->links() }}
        </div>
    </div>
</x-app-layout>
