<div class="card-body">
    <form action="{{ route('dashboard.categories.index') }}" method="get">
        <div class="row">
            <div class="col-2">
                <select name="sorted_by" class="form-control">
                    <option disabled selected>Sort By</option>
                    <option value="id">ID</option>
                    <option value="name">Post title</option>
                    <option value="status">Status</option>
                </select>
            </div>
            <div class="col-2">
                <select name="order_by" class="form-control">
                    <option disabled selected>Order By</option>
                    <option value="asc">Ascending</option>
                    <option value="desc">Descending</option>
                </select>
            </div>
            <div class="col-2">
                <select name="limit_by" class="form-control">
                    <option disabled selected>Limit</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="35">35</option>
                </select>
            </div>
            <div class="col-2">
                <select name="status" class="form-control">
                    <option disabled selected>Status</option>
                    <option value="1">Active</option>
                    <option value="0">Not Active</option>
                </select>
            </div>
            <div class="col-3">
                <input type="text" name="keyword" class="form-control" placeholder="Enter Name ...">
            </div>
            <div class="col-1">
                <button type="submit" class="btn btn-info">Search</button>
            </div>
        </div>
    </form>
</div>


<!-- Modal -->
<form action="{{route('dashboard.categories.store')}}" method="post">
    @csrf
<div class="modal fade" id="add-category" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                    <select name="status" class="form-control">
                        <option disabled>Select Status</option>
                        <option value="1">Active</option>
                        <option value="0">Not Active</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Create Category</button>
            </div>
        </div>
    </div>
</div>
</form>
