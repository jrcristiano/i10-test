<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use App\Services\ArticleService;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    private CategoryService $categoryService;
    private ArticleService $articleService;

    public function __construct(ArticleService $articleService, CategoryService $categoryService)
    {
        $this->articleService = $articleService;
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return view('welcome', [
            'articles' => $this->getPaginatedArticleList($request),
        ]);
    }

    public function show(string $slug)
    {
        return view('articles.show', [
            'article' => $this->articleService->findArticleBySlugOrFail($slug),
        ]);
    }

    public function getPaginatedArticleList()
    {
        return view('articles.index', [
            'articles' => [], // $this->getPaginatedArticleList($request),
        ]);
    }

    public function getArticleListByUserId()
    {
        return view('articles.my-articles', [
            'articles' => $this->articleService->getArticleListByUserId(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view('articles.create', [
            'categories' => $this->categoryService->getAll($request),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleRequest $request)
    {
        $data = $request->only(array_keys($request->rules()));

        $createdArticle = $this->articleService->saveArticle($data);

        return redirect()->route('welcome')
            ->with('success', "Artigo {$createdArticle->title} foi criado com sucesso.");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        return view('articles.edit', [
            'article' => $this->articleService->findArticleByIdOrFail($id),
            'categories' => [],
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArticleRequest $request, int $id)
    {
        $data = $request->only(array_keys($request->rules()));

        $article = $this->articleService->findArticleByIdOrFail($id);

        $this->articleService->saveArticle($data, $id);

        return redirect()->route('welcome')
            ->with('success', "Artigo {$article->title} foi removido com sucesso.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $article = $this->articleService->findArticleByIdOrFail($id);

        $this->articleService->deleteArticleById($id);

        return redirect()->route('welcome')
            ->with('success', "Artigo {$article->title} foi removido com sucesso.");
    }
}