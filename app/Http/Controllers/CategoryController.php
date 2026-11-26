<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Exception;
use Storage;

class CategoryController extends Controller
{
    public function index() {
        $categories = Category::orderByDesc('created_at')->get();

        return view('admin.category.index', [
            'categories' => $categories
        ]);
    }

    public function store(CategoryRequest $request) {
        $validated = $request->validated();

        try {
            if ($request->hasFile('image_path')) {
                $validated['image_path'] = $request->file('image_path')->store('categories', 'public');
            }

            auth()->user()->categories()->create($validated);
        } catch (Exception $e) {
            report($e);
            return back()->with('error', 'Failed to create category.');
        }

        return redirect()->route('admin.category.index')->with('message', 'Create Category Successfully');
    }

    public function update(CategoryRequest $request, Category $category) {
        $validated = $request->validated();

        try {
            if ($request->hasFile('image_path')) {
                if ($category->image_path) {
                    Storage::disk('public')->delete($category->image_path);
                }
                $validated['image_path'] = $request->file('image_path')->store('categories', 'public');
            } else {
                unset($validated['image_path']);
            }
            $category->update($validated);
        } catch (Exception $e) {
            report($e);
            return back()->with('error', 'Failed to update category.');
        }

        return redirect()->route('admin.category.index')->with('message', 'Category updated successfully.');
    }

    public function destroy(Category $category) {
        try {
            if ($category->image_path) {
                Storage::disk('public')->delete($category->image_path);
            }
            $category->delete();
        } catch (Exception $e) {
            report($e);
            return back()->with('error', 'Failed to delete category.');
        }

        return redirect()->route('admin.category.index')->with('message', 'Category deleted successfully.');
    }
}
