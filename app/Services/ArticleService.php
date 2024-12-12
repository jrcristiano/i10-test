<?php

namespace App\Services;

use App\Repositories\ArticleRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleService extends Service
{
    public function __construct(ArticleRepository $repository)
    {
        parent::__construct($repository);
    }

    public function getAll(Request $request)
    {
        return $this->repository->fetchAll([
            ...$this->filters($request),
            'columns' => [
                'id',
                'name',
            ],
        ]);
    }

    public function getArticleListByUserId()
    {
        return $this->repository->fetchAll();
    }

    public function findArticleBySlugOrFail(string $slug)
    {
        return $this->repository->findArticleBySlugOrFail($slug);
    }

    public function getPaginatedArticleList(Request $request)
    {
        return $this->repository->fetchAll([
            ...$this->filters($request),
            'paginated' => true,
        ]);
    }

    public function findArticleByIdOrFail(int $id)
    {
        return $this->findOrFail($id);
    }

    public function saveArticle(array $data, int|null $id = null)
    {
        $data['user_id'] = Auth::user()->id;

        if ($id) {
            $data['id'] = $id;
            return $this->save($data);
        }

        return $this->save($data);
    }

    public function deleteArticleById(int $id)
    {
        return $this->delete($id);
    }
}
