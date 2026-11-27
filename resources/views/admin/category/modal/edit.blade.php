<div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editCategoryModalLabel">Update Category</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editCategoryForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="category_id" id="edit_category_id" value="{{ old('category_id') }}">
                    <div class="mb-3">
                        <label for="edit_name" class="form-label">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="edit_name"
                            name="name" value="{{ old('name') }}">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="edit_slug" class="form-label">Slug</label>
                        <input type="text" class="form-control @error('slug') is-invalid @enderror" id="edit_slug"
                            name="slug" value="{{ old('slug') }}" placeholder="example: men-shoes">
                        @error('slug')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="edit_description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="edit_description"
                            rows="3" placeholder="category description">{{ old('description') }}</textarea>
                        @error('description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="edit_image_path" class="form-label">Select an image</label>
                        <div class="mb-2">
                            <img id="edit_image_prview" src="" alt="" width="80" class="d-none">
                        </div>
                        <input class="form-control @error('image_path') is-invalid  @enderror" type="file"
                            name="image_path" id="edit_image_path" accept="image/*">
                        <div class="form-text">Leave empty to keep the current image.</div>
                        @error('image_path')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3 form-check">
                        <input type="hidden" name="is_active" value="0">
                        <input class="form-check-input" type="checkbox" name="is_active" id="edit_isActive" value="1"
                            {{ old('is_active', 1) ? 'checked' : '' }}>
                        <label class="form-check-label" for="edit_isActive">Is Active</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" form="editCategoryForm" class="btn btn-primary">Update</button>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script type="module">
        const editModal = document.getElementById('editCategoryModal');
        const editFrom = document.getElementById('editCategoryForm');
        const editId = document.getElementById('edit_category_id');
        const urlTemplate = @json(route('admin.category.update', ['category' => '__ID__']));

        const setAction = (id) => {
            editFrom.action = urlTemplate.replace('__ID__', id);
        };

        editModal.addEventListener('show.bs.modal', (event) => {
            const btn = event.relatedTarget;
            if (!btn) return;

            editId.value = btn.dataset.id;
            setAction(btn.dataset.id);

            document.getElementById('edit_name').value = btn.dataset.name;
            document.getElementById('edit_slug').value = btn.dataset.slug;
            document.getElementById('edit_description').value = btn.dataset.description ?? '';
            document.getElementById('edit_isActive').checked = btn.dataset.active === '1';

            const preview = document.getElementById('edit_image_prview');
            preview.src = btn.dataset.image || '';
            preview.classList.toggle('d-none', !btn.dataset.image); 
        })

        if (editId.value) setAction(editId.value);

        editModal.addEventListener('hidden.bs.modal', () => {
            document.getElementById('edit_image_path').value = '';
            editFrom.querySelectorAll('.is-invalid').forEach((el) => el.classList.remove('is-invalid'));
            editFrom.querySelectorAll('.text-danger').forEach((el) => el.remove());
        })
    </script>
@endpush