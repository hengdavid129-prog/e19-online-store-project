<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Storage;

class ProductController extends Controller
{
    public function index(Request $request) {
        $search = trim((string) $request->input('search'));
        $status = $request->input('status');
        $categoryId = $request->input('category');

        $products = Product::query()
            ->with(['category', 'productImages'])
            ->when($search !== '', function ($query) use ($search) {
                $term = '%' . addcslashes($search, '%_\\') . '%';
                $query->where(function ($query) use ($term) {
                    $query->where('name', 'like', $term)
                    ->orWhere('slug', 'like', $term)
                    ->orWhere('sku', 'like', $term);
                });
            })
            ->when($status === 'active', fn($query) => $query->where('is_active', true))
            ->when($status === 'inactive', fn($query) => $query->where('is_active', false))
            ->when($categoryId, fn($query) => $query->where('category_id', $categoryId))
            ->orderByDesc('created_at')
            ->paginate(10)
            ->withQueryString();

        return view('admin.product.index',[
            'products' => $products,
            'categories' => Category::orderBy('name')->get(['id','name']),
            'search' => $search,
            'status' => $status,
            'categoryId' => $categoryId,
        ]);
    }

    public function store(ProductRequest $request) {
        $validated = $request->validated();
        unset($validated['images']);

        try {
            DB::transaction(function() use ($request, $validated) {
                $product = auth()->user()->products()->create($validated);
                $this->storeImages($request, $product);
            });
        } catch (Exception $e) {
            report($e);
            return back()->with('error', 'Failed to create product.');
        }
        return back()->with('message', 'Product created successfully.');
    }

    public function update(ProductRequest $request, Product $product) {
        $validated = $request->validated();
        unset($validated['images']);

        try {
            DB::transaction(function() use ($request, $validated, $product) {
                $product->update($validated);
                $this->storeImages($request, $product);
            });

        } catch (Exception $e) {
            report($e);
            return back()->with('error', 'Failed to update product.');
        }
        return back()->with('message', 'Product updated successfully.');
    }

    public function destroy(Product $product) {
        try {
            $paths = $product->productImages()->pluck('path')->all();
            $product->delete();
            Storage::disk('public')->delete($paths);
        } catch (Exception $e) {
            report($e);
            return back()->with('error', 'Failed to delete product.');
        }
        return back()->with('message', 'Product deleted successfully.');
    }

    private function storeImages(ProductRequest $request, Product $product): void {
        if (! $request->hasFile('images')) {
            return;
        }

        $sortOrder = (int) $product->productImages()->max('sort_order');

        foreach($request->file('images') as $image) {
            $product->productImages()->create([
                'path' => $image->store('products', 'public'),
                'sort_order' => ++$sortOrder,
            ]);
        }
    }
}
