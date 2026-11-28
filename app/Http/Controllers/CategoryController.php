<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Storage;

class CategoryController extends Controller
{
    public function index(Request $request) {
        $search = trim((string) $request->input('search'));
        $status = $request->input('status');

        $categories = Category::query()
            ->withCount('products')
            ->when($search !== '', function ($query) use ($search) {
                $term = '%' . addcslashes($search, '%_\\') . '%';

                $query->where(function ($query) use ($term) {
                    $query->where('name', 'like', $term)
                        ->orWhere('slug', 'like', $term);
                });
            })
            ->when($status === 'active', fn ($query) => $query->where('is_active', true))
            ->when($status === 'inactive', fn($query) => $query->where('is_active', false))
            ->orderByDesc('created_at')
            ->paginate(10)
            ->withQueryString();

        return view('admin.category.index', [
            'categories' => $categories,
            'search' => $search,
            'status' => $status,
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

        return back()->with('message', 'Create Category Successfully');
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

        return back()->with('message', 'Category updated successfully.');
    }

    public function destroy(Category $category) {
        if ($category->products()->exists()) {
            return back()->with('error', 'Cannot delete a category that still has products.');
        }
        try {
            if ($category->image_path) {
                Storage::disk('public')->delete($category->image_path);
            }
            $category->delete();
        } catch (Exception $e) {
            report($e);
            return back()->with('error', 'Failed to delete category.');
        }

        return back()->with('message', 'Category deleted successfully.');
    }
}
