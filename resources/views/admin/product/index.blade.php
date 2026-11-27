@extends('layouts.admin.master')

@section('title', 'Products')

@section('style')
    <style>
        .btn-action {
            color: white;
            padding: 0.5rem;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            border-radius: 0.3rem;
            transition: opacity 0.05s ease, transform 0.08s ease;
            border: none;
        }

        .btn-action:hover {
            opacity: 0.9;
            transform: scale(1.02)
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 mb-3">
            <div class="d-flex justify-content-between align-items-center gap-2 flex-wrap">
                <form method="GET" action="{{ route('admin.product.index') }}" class="d-flex gap-2 flex-wrap">
                    <input type="search" name="search" value="{{ $search }}" class="form-control" style="width: 16rem" placeholder="Search name, slug or SKU...">
                    <select name="category" class="form-select" style="width: 12rem">
                        <option value="">All categories</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected((string) $categoryId === (string) $category->id)>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>

                    <select name="status" class="form-select" style="width: 10rem;">
                        <option value="">All status</option>
                        <option value="active" @selected($status === 'active')>Active</option>
                        <option value="inactive" @selected($status === 'inactive')>Inactive</option>
                    </select>

                    <button type="submit" class="btn btn-outline-primary">
                        <i class="fas fa-search"></i>
                    </button>

                    @if ($search !== '' || $status || $categoryId)
                        <a href="{{ route('admin.product.index') }}" class="btn btn-outline-secondary">Reset</a>
                    @endif
                </form>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createProductModal">Add New</button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover align-middle text-nowrap">
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Image</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Slug</th>
                        <th class="text-center">SKU</th>
                        <th class="text-center">Category</th>
                        <th class="text-center">Description</th>
                        <th class="text-center">Price</th>
                        <th class="text-center">Stock</th>
                        <th class="text-center">Active</th>
                        <th class="text-center">Created At</th>
                        <th class="text-center">Updated At</th>
                        <th class="text-center">Action</th>
                    </tr>
                    @forelse ($products as $product)
                        <tr>
                            <td class="text-center">{{ $products->firstItem() + $loop->index }}</td>
                            <td class="text-center">
                                @if ($product->productImages->isNotEmpty())
                                    <img src="{{ asset('storage/' . $product->productImages->first()->path) }}" alt="{{ $product->name }}" width="60" class="rounded border">
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td class="text-start">{{ $product->name }}</td>
                            <td class="text-start">{{ $product->slug }}</td>
                            <td class="text-start">{{ $product->sku }}</td>
                            <td class="text-start">{{ $product->category?->name }}</td>
                            <td class="text-start">{{ Str::limit($product->description, 60) }}</td>
                            <td class="text-center">{{ $product->price }}</td>
                            <td class="text-center">{{ $product->stock }}</td>
                            <td class="text-center">{{ $product->is_active ? 'Yes' : 'No' }}</td>
                            <td class="text-center">{{ $product->created_at->format('Y-m-d') }}</td>
                            <td class="text-center">{{ $product->updated_at->format('Y-m-d') }}</td>
                            <td class="text-center">
                                <button type="button" class="bg-success btn-action"
                                    data-bs-toggle="modal" data-bs-target="#editProductModal"
                                    data-id="{{ $product->id }}"
                                    data-category="{{ $product->category_id }}"
                                    data-name="{{ $product->name }}"
                                    data-slug="{{ $product->slug }}"
                                    data-sku="{{ $product->sku }}"
                                    data-description="{{ $product->description }}"
                                    data-price="{{ $product->price }}"
                                    data-stock="{{ $product->stock }}"
                                    data-active="{{ $product->is_active ? 1 : 0 }}"
                                    data-images="{{ $product->productImages->map(fn ($image) => asset('storage/' . $image->path))->toJson() }}">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button type="button" class="bg-danger btn-action" data-bs-toggle="modal" data-bs-target="#deleteProductModal" data-id="{{ $product->id }}" data-name="{{ $product->name }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="13" class="text-center">
                                @if ($search !== '' || $status || $categoryId)
                                    No products match your search.
                                @else
                                    No Product Yet.
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </table>
            </div>
            @if ($products->hasPages())
                {{ $products->links() }}
            @endif
        </div>
    </div>

    @include('admin.product.modal.create')
    @include('admin.product.modal.edit')
    @include('admin.product.modal.delete')
@endsection

@section('script')
    @if ($errors->any())
        <script>
            window.addEventListener('DOMContentLoaded', function () {
                const id = @json(old('product_id'));
                const target = id ? 'editProductModal' : 'createProductModal';
                new bootstrap.Modal(document.getElementById(target)).show();
            });
        </script>
    @endif
    @if (session('message'))
        <script type="module">toast(@json(session('message')))</script>
    @endif
    @if (session('error'))
        <script type="module">toast(@json(session('error')), 'error')</script>
    @endif
@endsection
