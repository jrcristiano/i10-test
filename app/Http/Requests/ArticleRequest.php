<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $articleId = $this->route('id');

       return [
            'banner' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'title' => "required|string|unique:articles,title,{$articleId}|min:3|max:255|regex:/^[\S]+(?:[\s\S]*[\S]+)?$/",
            'subtitle' => "required|string|min:3|max:255|unique:articles,subtitle,{$articleId}",
            'content' => 'required|string|min:5',
            'status' => 'required|in:rascunho,publicado',
            'category_id' => 'required|numeric|exists:categories,id',
        ];
    }
}
