<x-app-layout>
    <div class="d-block col-12 col-xl-10 py-4 bg-white px-0">
            @include('components.i10-header-section', [
            'actionText' => 'Novo artigo',
            'routeName' => 'articles.create',
            'title' => 'Artigos'
        ])

        <div class="w-100 py-4 px-4">
            <form class="w-100 g-2 d-flex flex-nowrap">
                <div class="w-100 d-flex align-items-center">
                    <div class="w-75 border p-1 shadow-sm rounded me-3">
                        <input
                            name="busca"
                            type="text"
                            class="form-control border-0 form-control-lg"
                            placeholder="Buscar artigo por título"
                        >
                    </div>
                    <div class="w-25 border p-1 rounded shadow-sm me-3">
                        <select
                            name="categoria"
                            class="form-select border-0 form-select-lg"
                            aria-label="Large select example"
                        >
                            <option selected>Categoria</option>
                            @foreach ($categories as $category)
                                <option value={{ $category->id }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

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
                      @foreach ($articles as $article)
                        <tr>
                            <th class="py-2 i10-text-dark" scope="row">{{ $article->id }}</th>
                            <td class="py-2 i10-text-dark">{{ $article->shortened_title }}</td>
                            <td class="py-2 i10-text-dark">{{ $article->created_at_formatted }}</td>
                            <td class="py-2 i10-text-dark">@mdo</td>
                        </tr>
                      @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="w-100 py-2 px-3">
            {{ $articles->links() }}
        </div>
    </div>
</x-app-layout>
