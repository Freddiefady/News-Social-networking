<!-- Edit Category Modal -->
<form action="{{ route('dashboard.categories.update', $category->id) }}" method="post">
    @csrf
    @method('PUT')
    <div class="modal fade" id="edit-category-{{$category->id}}" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-4">
                        <input type="text" name="name" class="form-control mb-2" value="{{$category->name}}">
                        <select name="status" val class="form-control">
                            <option value="">Select Status</option>
                            <option value="1" @selected($category->status == 1)>Active
                            </option>
                            <option value="0" @selected($category->status == 0)>Not Ative
                            </option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Category</button>
                </div>
            </div>
        </div>
    </div>
</form>
