<!-- Modal -->
<form action="{{route('dashboard.admins.store')}}" method="post">
    @csrf
    <div class="modal fade" id="addAdmins" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Admin</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-4">
                        <input type="text" name="name" class="form-control mb-2" placeholder="Enter Your name...">
                        @error('name')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                        <input type="text" name="username" class="form-control mb-2" placeholder="Enter username...">
                        @error('username')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                        <input type="text" name="email" class="form-control mb-2" placeholder="Enter email...">
                        @error('email')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                        <select name="status" class="form-control mb-2">
                            <option disabled>Select Status</option>
                            <option value="1">Active</option>
                            <option value="0">Not Active</option>
                        </select>
                        @error('status')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                        <select name="role_id" class="form-control mb-2">
                            <option disabled>Select Role</option>
                            @forelse ($roles as $role)
                            <option value="{{$role->id}}">{{$role->role}}</option>
                            @empty
                            <option selected disabled>Not Found</option>
                            @endforelse
                        </select>
                        @error('role_id')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                        <input type="password" name="password" class="form-control mb-2" placeholder="Enter password">
                        @error('password')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                        <input type="password" name="password_confirmation" class="form-control mb-2" placeholder="Enter password confirmation">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </div>
        </div>
    </div>
</form>
