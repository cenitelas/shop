<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::query()
            ->get();
        return view('categories.index', [
            'categories' => $categories
        ]);
    }

    public function create()
    {
        $this->authorize('create', Category::class);
        return view('categories.form');
    }

    public function store()
    {

        $this->authorize('create', Category::class);
        $data = $this->validated();
        /** @var User $user */
        $user = auth()->user();
        $user->categories()->create($data);

        return redirect()->route('categories.index');
    }

    public function edit(Category $category)
    {
        $this->authorize('update', $category);
        return view('categories.form', [
            'categories' => $category
        ]);
    }

    public function update(Category $category)
    {
        $this->authorize('update', $category);
        $data = $this->validated();
        $category->update($data);
        return redirect()->route('categories.index');
    }

    public function destroy(Category $category)
    {
        $this->authorize('delete', $category);
        $category->delete();
        return back();
    }

    protected function validated() {
        return request()->validate([
            'name' => 'required|string|min:2',
        ]);
    }
}
