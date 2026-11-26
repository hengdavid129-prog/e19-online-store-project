<div class="modal fade" id="deleteCategoryModal" tabindex="-1" aria-labelledby="deleteCategoryLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteCategoryLabel">Delete Category</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete <strong id="deleteCategoryName"></strong>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteCategoryForm" method="POST">
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
        const deleteModal = document.getElementById('deleteCategoryModal');
        const deleteForm = document.getElementById('deleteCategoryForm');
        const deleteName = document.getElementById('deleteCategoryName');
        const urlTemplate = @json(route('admin.category.destroy', ['category' => '__ID__']));

        deleteModal.addEventListener('show.bs.modal', (event) => {
            const btn = event.relatedTarget;
            deleteName.textContent = btn.dataset.name;
            deleteForm.action = urlTemplate.replace('__ID__', btn.dataset.id);
        });
    </script>
@endpush