<?php

namespace App\Services;

use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryService extends Service
{
    public function __construct(CategoryRepository $repository)
    {
        parent::__construct($repository);
    }

    public function getCategoryListWithIdAndName(Request $request)
    {
        return $this->repository->fetchAll([
            ...$this->filters($request),
            'columns' => [
                'id',
                'name',
            ],
        ]);
    }

    public function getPaginatedCategoryList(Request $request)
    {
        return $this->repository->fetchAll([
            ...$this->filters($request),
            'paginated' => true,
        ]);
    }

    public function findCategoryByIdOrFail(int $id)
    {
        return $this->findOrFail($id);
    }

    public function saveCategory(array $data, int|null $id = null)
    {
        $data['user_id'] = Auth::user()->id;

        if ($id) {
            $data['id'] = $id;
            return $this->save($data);
        }

        return $this->save($data);
    }

    public function deleteCategoryById(int $id)
    {
        return $this->delete($id);
    }
}
