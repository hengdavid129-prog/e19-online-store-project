<div class="modal fade" id="createProductModal" tabindex="-1" aria-labelledby="createProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="createProductModalLabel">New Product</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="createProductForm" action="{{ route('admin.product.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category</label>
                        <select class="form-select @error('category_id') is-invalid @enderror" name="category_id" id="category_id">
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
                            name="slug" value="{{ old('slug') }}" placeholder="example: nike-air-max">
                        @error('slug')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="sku" class="form-label">SKU</label>
                        <input type="text" class="form-control @error('sku') is-invalid @enderror" id="sku"
                            name="sku" value="{{ old('sku') }}" placeholder="example: NK-AM-001">
                        @error('sku')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"
                            rows="3" placeholder="product description">{{ old('description') }}</textarea>
                        @error('description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="text" class="form-control @error('price') is-invalid @enderror" id="price"
                            name="price" value="{{ old('price') }}">
                        @error('price')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="stock" class="form-label">Stock</label>
                        <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock"
                            name="stock" value="{{ old('stock') }}">
                        @error('stock')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="images" class="form-label">Select an image</label>
                        <input class="form-control @error('images.*') is-invalid  @enderror" type="file"
                            name="images[]" id="image_upload" accept="image/*" multiple>
                        @error('images.*')
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
                <button type="submit" form="createProductForm" class="btn btn-primary">Add</button>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script type="module">
        const productModal = document.getElementById('createProductModal');
        const ProductForm = document.getElementById('createProductForm');

        productModal.addEventListener('hidden.bs.modal', () => {
            ProductForm.reset();
            // reset() restores the HTML defaults, which after a failed submit are the
            // old() values rendered server-side - so blank those fields explicitly
            ProductForm.querySelectorAll('input[type="text"], input[type="number"], textarea').forEach((el) => {
                el.value = '';
            });
            document.getElementById('category_id').value = '';
            document.getElementById('isActive').checked = true;
            ProductForm.querySelectorAll('.is-invalid').forEach((el) => {
                el.classList.remove('is-invalid');
            });
            ProductForm.querySelectorAll('.text-danger').forEach((el) => el.remove());
        });
    </script>
@endpush