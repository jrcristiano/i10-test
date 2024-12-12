<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository extends Repository
{
    public function __construct(Category $model)
    {
        parent::__construct($model);
    }

    public function getPaginatedCategoryList($params = [])
    {
        return $this->model->fetchAll($params);
    }
}
