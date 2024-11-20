<!-- Modal -->
<form action="{{route('dashboard.related.store')}}" method="post">
    @csrf
    <div class="modal fade" id="add-link" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-4">
                        <input type="text" name="name" class="form-control mb-2" placeholder="Title Name Category...">
                        <input type="text" name="url" class="form-control mb-2" placeholder="Enter URL...">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create link</button>
                </div>
            </div>
        </div>
    </div>
</form>
