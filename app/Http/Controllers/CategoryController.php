<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use Exception;
use Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::where("user_id", auth()->id())->count();

        return view('categories.index', [
            'categories' => $categories,
        ]);
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(StoreCategoryRequest $request)
    {
        Category::create([
            "user_id" => auth()->id(),
            "name" => $request->name,
            "slug" => Str::slug($request->name)
        ]);

        return redirect()
            ->route('categories.index')
            ->with('success', 'La categoría ha sido creada!');
    }

    public function show(Category $category)
    {
        return view('categories.show', [
            'category' => $category
        ]);
    }

    public function edit(Category $category)
    {
        return view('categories.edit', [
            'category' => $category
        ]);
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update([
            "name" => $request->name,
            "slug" => Str::slug($request->name)
        ]);

        return redirect()
            ->route('categories.index')
            ->with('success', 'La categoria ha sido actualizado!');
    }

    public function destroy(Category $category)
    {
        try {
            $category->delete();

            return redirect()
                ->route('categories.index')
                ->with('success', 'La categoría ha sido eliminada!');
        } catch (Exception $e) {
            return redirect()
                ->back()
                ->with('success', 'No se ha podido eliminar porque cuenta con datos asociados!');
        }
    }
}
