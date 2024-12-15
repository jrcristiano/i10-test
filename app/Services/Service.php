<?php

namespace App\Services;

use Illuminate\Http\Request;

abstract class Service
{
    protected $repository;

    public function __construct($repository)
    {
        $this->repository = $repository;
    }

    public function paginated(Request $request)
    {
        $filters = $this->filters($request);
        return $this->repository->fetchAll([
            ...$filters,
            'paginated' => true,
        ]);
    }


    public function fetchAll(Request $request)
    {
        $filters = $this->filters($request);
        return $this->repository->fetchAll($filters);
    }

    public function first(Request $request)
    {
        $filters = $this->filters($request);
        return $this->repository->first($filters);
    }

    public function firstOrFail(Request $request)
    {
        $filters = $this->filters($request);
        return $this->repository->firstOrFail($filters);
    }

    public function findOrFail(int $id)
    {
        return $this->repository->findOrFail($id);
    }

    public function find(int $id)
    {
        return $this->repository->find($id);
    }

    public function save(array $data)
    {
        $data['id'] = $data['id'] ?? null;

        if (!$data['id']) {
            return $this->create($data);
        }

        return $this->update($data);
    }

    public function create(array $data)
    {
        return $this->repository->create($data);
    }

    public function update(array $data)
    {
        return $this->repository->update($data);
    }

    public function updateOrCreate(array $data)
    {
        return $this->repository->updateOrCreate($data);
    }

    public function firstOrCreate(array $data)
    {
        return $this->repository->firstOrCreate($data);
    }

    public function delete(int $id)
    {
        return $this->repository->delete($id);
    }

    public function forceDelete(int $id)
    {
        return $this->repository->forceDelete($id);
    }

    public function restore(int $id)
    {
        return $this->repository->restore($id);
    }

    public function getModel()
    {
        return $this->repository->getModel();
    }

    public function count()
    {
        return $this->getModel()->count();
    }

    protected function filters(Request $request): array
    {
        $filters = [];

        $filters['columns'] = $request->filled('columns') ? explode(',', $request->get('columns')) : ['*'];

        $filters['where'] = $request->get('where', []);

        $filters['orderBy'] = $request->get('orderBy', 'desc');

        $filters['sortBy'] = $request->get('sortBy', 'created_at');

        $filters['paginated'] = filter_var($request->get('paginated', false), FILTER_VALIDATE_BOOLEAN);

        $filters['page'] = max((int) $request->get('page', 1), 1);

        $filters['perPage'] = max((int) $request->get('perPage', 15), 1);

        $filters['limit'] = max((int) $request->get('limit', 10), 1);

        $filters['offset'] = max((int) $request->get('offset', 0), 0);

        $filters['relations'] = is_array($request->get('relations'))
            ? $request->get('relations')
            : array_filter(explode(',', $request->get('relations', '')));

        return $filters;
    }

    protected function getPaginatedData($items, $mappedItems)
    {
        return [
            'current_page' => $items->currentPage(),
            'data' => $mappedItems,
            'first_page_url' => $items->url(1),
            'from' => $items->firstItem(),
            'last_page' => $items->lastPage(),
            'last_page_url' => $items->url($items->lastPage()),
            'links' => $items->toArray()['links'],
            'next_page_url' => $items->nextPageUrl(),
            'path' => $items->path(),
            'per_page' => $items->perPage(),
            'prev_page_url' => $items->previousPageUrl(),
            'to' => $items->lastItem(),
            'total' => $items->total(),
        ];
    }
}
