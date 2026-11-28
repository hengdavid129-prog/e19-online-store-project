@extends('layouts.admin.master')

@section('title', 'Categories')

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
            <form method="GET" action="{{ route('admin.category.index') }}" class="d-flex gap-2 flex-wrap">
                <input type="search" name="search" value="{{ $search }}" class="form-control" style="width: 16rem;" placeholder="Search name or slug...">

                <select name="status" class="form-select" style="width: 10rem;">
                    <option value="">All status</option>
                    <option value="active" @selected($status === 'active')>Active</option>
                    <option value="inactive" @selected($status == 'inactive')>Inactive</option>
                </select>

                <button type="submit" class="btn btn-outline-primary">
                    <i class="fas fa-search"></i>
                </button>

                @if ($search !== '' || $status)
                    <a href="{{ route('admin.category.index') }}" class="btn btn-outline-secondary">Reset</a>
                @endif
            </form>

            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createCategoryModal">Add New</button>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover align-middle text-nowrap">
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Slug</th>
                    <th class="text-center">Description</th>
                    <th class="text-center">Image</th>
                    <th class="text-center">Active</th>
                    <th class="text-center">Created At</th>
                    <th class="text-center">Updated At</th>
                    <th class="text-center">Action</th>
                </tr>
                @forelse ($categories as $category)
                    <tr>
                        <td class="text-center">{{ $categories->firstItem() + $loop->index }}</td>
                        <td class="text-start">{{ $category->name }}</td>
                        <td class="text-start">{{ $category->slug }}</td>
                        <td class="text-start">{{ $category->description }}</td>
                        <td class="text-center">
                            @if ($category->image_path)
                                <img src="{{ asset('storage/' . $category->image_path) }}" alt="{{ $category->name }}" width="60">
                            @endif
                        </td>
                        <td class="text-center">{{ $category->is_active ? 'Yes' : 'No' }}</td>
                        <td class="text-center">{{ $category->created_at->format('Y-m-d') }}</td>
                        <td class="text-center">{{ $category->updated_at->format('Y-m-d') }}</td>
                        <td class="text-center">
                            <button type="button" class="bg-success btn-action" 
                                data-bs-toggle="modal" data-bs-target="#editCategoryModal"
                                data-id="{{ $category->id }}"
                                data-name="{{ $category->name }}"
                                data-slug="{{ $category->slug }}"
                                data-description="{{ $category->description }}"
                                data-active="{{ $category->is_active ? 1 : 0 }}"
                                data-image="{{ $category->image_path ? asset('storage/' . $category->image_path) : '' }}">
                                <i class="fas fa-edit"></i>
                            </button>
                            @if ($category->products_count > 0)
                                <span class="badge text-bg-secondary">{{ $category->products_count }} products</span>
                                <button class="btn btn-sm btn-outline-danger" disabled>
                                    <i class="fas fa-trash"></i>
                                </button>
                            @else
                                <button type="button" class="bg-danger btn-action" data-bs-toggle="modal" data-bs-target="#deleteCategoryModal" data-id="{{ $category->id }}" data-name="{{ $category->name }}">
                                    <i class="fas fa-trash"></i>
                                </button> 
                            @endif
                        </td>
                    </tr>  
                @empty
                    <tr>
                        <td colspan="9" class="text-center">
                            @if ($search !== '' || $status)
                                No categories match your search.
                            @else
                                No category yet.
                            @endif
                        </td>
                    </tr>
                @endforelse
            </table>
        </div>
        @if ($categories->hasPages())
            {{ $categories->links() }}
        @endif
    </div>
</div>

@include('admin.category.modal.create')
@include('admin.category.modal.delete')
@include('admin.category.modal.edit')

@endsection
@section('script')
    @if ($errors->any())
        <script>
            window.addEventListener('DOMContentLoaded', function () {
                const id = @json(old('category_id'));
                const target = id ? 'editCategoryModal' : 'createCategoryModal';
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
