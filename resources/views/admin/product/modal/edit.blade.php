<div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editProductModalLabel">Edit Product</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editProductForm" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="product_id" id="edit_product_id" value="{{ old('product_id') }}">
                    <div class="mb-3">
                        <label for="edit_category_id" class="form-label">Category</label>
                        <select class="form-select @error('category_id') is-invalid @enderror" name="category_id" id="edit_category_id">
                            <option value="">Select a Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
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
                            name="slug" value="{{ old('slug') }}" placeholder="example: nike-air-max">
                        @error('slug')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="edit_sku" class="form-label">SKU</label>
                        <input type="text" class="form-control @error('sku') is-invalid @enderror" id="edit_sku"
                            name="sku" value="{{ old('sku') }}" placeholder="example: NK-AM-001">
                        @error('sku')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="edit_description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="edit_description"
                            rows="3" placeholder="product description">{{ old('description') }}</textarea>
                        @error('description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="edit_price" class="form-label">Price</label>
                        <input type="text" class="form-control @error('price') is-invalid @enderror" id="edit_price"
                            name="price" value="{{ old('price') }}">
                        @error('price')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="edit_stock" class="form-label">Stock</label>
                        <input type="number" class="form-control @error('stock') is-invalid @enderror" id="edit_stock"
                            name="stock" value="{{ old('stock') }}">
                        @error('stock')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-2 d-flex flex-wrap gap-2" id="edit_image_preview"></div>
                    <div class="mb-3">
                        <label for="edit_images" class="form-label">Select an image</label>
                        <input class="form-control @error('images.*') is-invalid  @enderror" type="file"
                            name="images[]" id="edit_images" accept="image/*" multiple>
                        @error('images.*')
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
                <button type="submit" form="editProductForm" class="btn btn-primary">Update</button>
            </div>
        </div>
    </div>
</div>

@push('script')
     <script type="module">
        const editModal = document.getElementById('editProductModal');
        const editFrom = document.getElementById('editProductForm');
        const editId = document.getElementById('edit_product_id');
        const urlTemplate = @json(route('admin.product.update', ['product' => '__ID__']));

        const setAction = (id) => {
            editFrom.action = urlTemplate.replace('__ID__', id);
        };

        editModal.addEventListener('show.bs.modal', (event) => {
            const btn = event.relatedTarget;
            if (!btn) return;

            editId.value = btn.dataset.id;
            setAction(btn.dataset.id);

            document.getElementById('edit_category_id').value = btn.dataset.category ?? '';
            document.getElementById('edit_name').value = btn.dataset.name;
            document.getElementById('edit_slug').value = btn.dataset.slug;
            document.getElementById('edit_sku').value = btn.dataset.sku;
            document.getElementById('edit_description').value = btn.dataset.description ?? '';
            document.getElementById('edit_price').value = btn.dataset.price;
            document.getElementById('edit_stock').value = btn.dataset.stock;
            document.getElementById('edit_isActive').checked = btn.dataset.active === '1';
            const preview = document.getElementById('edit_image_preview');
            preview.innerHTML = '';
            JSON.parse(btn.dataset.images || '[]').forEach((src) => {
                const img = document.createElement('img');
                img.src = src;
                img.width = 60;
                img.className = 'rounded border';
                preview.appendChild(img);
            })
        })

        if (editId.value) setAction(editId.value);

        editModal.addEventListener('hidden.bs.modal', () => {
            document.getElementById('edit_images').value = '';
            editFrom.querySelectorAll('.is-invalid').forEach((el) => el.classList.remove('is-invalid'));
            editFrom.querySelectorAll('.text-danger').forEach((el) => el.remove());
        })
    </script>
@endpush