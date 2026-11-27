<div class="modal fade" id="deleteProductModal" tabindex="-1" aria-labelledby="deleteProductLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteProductLabel">Delete Product</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete <strong id="deleteProductName"></strong>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteProductForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@push('script')
    <script type="module">
        const deleteModal = document.getElementById('deleteProductModal');
        const deleteForm = document.getElementById('deleteProductForm');
        const deleteName = document.getElementById('deleteProductName');
        const urlTemplate = @json(route('admin.product.destroy', ['product' => '__ID__']));

        deleteModal.addEventListener('show.bs.modal', (event) => {
            const btn = event.relatedTarget;
            deleteName.textContent = btn.dataset.name;
            deleteForm.action = urlTemplate.replace('__ID__', btn.dataset.id);
        });
    </script>
@endpush
