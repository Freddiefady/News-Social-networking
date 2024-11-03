<div class="card-body">
    <form action="{{ route('dashboard.users.index') }}" method="get">
        <div class="row">
            <div class="col-2">
                <select name="sorted_by" class="form-control">
                    <option disabled selected>Sort By</option>
                    <option value="id">ID</option>
                    <option value="name">Name</option>
                    <option value="created_at">Created At</option>
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

