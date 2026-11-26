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
        <div class="d-flex justify-content-end align-items-center">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createCategoryModal">Add New</button>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <table class="table table-striped">
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
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="text-center">{{ $category->name }}</td>
                    <td class="text-center">{{ $category->slug }}</td>
                    <td class="text-center">{{ $category->description }}</td>
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
                        <button type="button" class="bg-danger btn-action" data-bs-toggle="modal" data-bs-target="#deleteCategoryModal" data-id="{{ $category->id }}" data-name="{{ $category->name }}">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>  
            @empty
                <tr>
                    <td colspan="9" class="text-center">No categories yet.</td>
                </tr>
            @endforelse
        </table>
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
