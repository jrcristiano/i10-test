<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return view('categories.index', [
            'categories' => $this->categoryService->getPaginatedCategoryList($request),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $data = $request->only(array_keys($request->rules()));

        $createdCategory = $this->categoryService->saveCategory($data);

        return redirect()->route('categories.index')
            ->with('success', "Categoria {$createdCategory->title} foi criada com sucesso.");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        return view('categories.edit', [
            'category' => $this->categoryService->findCategoryByIdOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, int $id)
    {
        $category = $this->categoryService->findCategoryByIdOrFail($id);

        $data = $request->only(array_keys($request->rules()));

        $this->categoryService->saveCategory($data, $id);

        return redirect()->route('categories.index')
            ->with('success', "Categoria {$category->title} foi editada com sucesso.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $category = $this->categoryService->findCategoryByIdOrFail($id);

        $this->categoryService->deleteCategoryById($id);

        return redirect()->route('category.index')
            ->with('success', "Categoria {$category->title} foi removida com sucesso.");
    }
}
