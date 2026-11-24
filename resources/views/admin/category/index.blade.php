@extends('layouts.admin.master')

@section('title', 'Categories')

@section('content')

<div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-4">
    <div></div>
    <button></button>
</div>

<div class="row">
    <div class="col-md-12 mb-3">
        <div class="d-flex justify-content-end align-items-center">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#categoryModal">Add New</button>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <table class="table table-striped">
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Description</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Action</th>
            </tr>
            <tr>
                <td>1</td>
                <td>Cloth</td>
                <td>Clothes for men and women</td>
                <td>01-01-2026</td>
                <td>01-01-2026</td>
                <td>
                    <i class="fas fa-edit"></i>
                    <i class="fas fa-trash"></i>
                </td>
            </tr>
        </table>
    </div>
</div>

<div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="categoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="categoryModalLabel">New Category</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="">
                    <div class="mb-3">
                        <label for="category-name" class="col-form-label">Name</label>
                        <input type="text" class="form-control" id="category-name">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Add</button>
            </div>
        </div>
    </div>
</div>
@endsection
