{{-- Update Category --}}
<div class="modal fade" id="edit-category-{{ $category->id }}">
    <div class="modal-dialog">
        <form action="{{ route('admin.categories.update', $category->id) }}" method="post">
            @csrf
            @method('PATCH')
            <div class="modal-content border-warning">
                <div class="modal-header border-warning">
                    <h5 class="modal-title">
                        <i class="fa-regular fa-pen-to-square text-warning"></i><span class="text-warning">Edit
                            Category</span>
                    </h5>
                </div>
                <div class="modal-body">
                    <input type="text" name="new_name" id="" class="form-control" placeholder="Categoryname"
                        value="{{ $category->name }}">
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-outline-warning btn-sm"
                        data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-warning btn-sm">Update</button>
                </div>
            </div>
        </form>
    </div>

</div>

{{-- Delete Category --}}
<div class="modal fade" id="delete-category-{{ $category->id }}">
    <div class="modal-dialog">
        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="post">
            @csrf
            @method('DELETE')
            <div class="modal-content border-danger">
                <div class="modal-header border-danger">
                    <h5 class="modal-title">
                        <i class="fa-solid fa-teash-can text-danger"></i> <span class="text-danger">Delete Category</span>
                    </h5>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete <span class="fw-bold">{{ $category->name }}</span>?</p>
                    <p class="fw-light">This action will affect all the posts under this category. Post without category will fall under Uncategoried.</p>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-outline-danger btn-sm"
                        data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-warning btn-sm">Delete</button>
                </div>
            </div>
        </form>
    </div>

</div>
