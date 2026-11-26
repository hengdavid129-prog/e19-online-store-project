<div class="modal fade" id="createCategoryModal" tabindex="-1" aria-labelledby="createCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="categoryModalLabel">New Category</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="createCategoryForm" action="{{ route('admin.category.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" value="{{ old('name') }}">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug"
                            name="slug" value="{{ old('slug') }}" placeholder="example: men-shoes">
                        @error('slug')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"
                            rows="3" placeholder="category description">{{ old('description') }}</textarea>
                        @error('description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="image_path" class="form-label">Select an image</label>
                        <input class="form-control @error('image_path') is-invalid  @enderror" type="file"
                            name="image_path" id="image_path" accept="image/*">
                        @error('image_path')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3 form-check">
                        <input type="hidden" name="is_active" value="0">
                        <input class="form-check-input" type="checkbox" name="is_active" id="isActive" value="1"
                            {{ old('is_active', 1) ? 'checked' : '' }}>
                        <label class="form-check-label" for="isActive">Is Active</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" form="createCategoryForm" class="btn btn-primary">Add</button>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script type="module">
        const categoryModal = document.getElementById('createCategoryModal');
        const categoryForm = document.getElementById('createCategoryForm');

        categoryModal.addEventListener('hidden.bs.modal', () => {
            categoryForm.reset();
            // reset() restores the HTML defaults, which after a failed submit are the
            // old() values rendered server-side - so blank those fields explicitly
            categoryForm.querySelectorAll('input[type="text"], textarea').forEach((el) => {
                el.value = '';
            });
            document.getElementById('isActive').checked = true;
            categoryForm.querySelectorAll('.is-invalid').forEach((el) => {
                el.classList.remove('is-invalid');
            });
            categoryForm.querySelectorAll('.text-danger').forEach((el) => el.remove());
        });
    </script>
@endpush