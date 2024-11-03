<!-- Edit Category Modal -->
<form action="{{ route('dashboard.authorization.update', $authorization->id) }}" method="post">
    @csrf
    @method('PUT')
    <div class="modal fade" id="edit-roles_{{$authorization->id}}" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit roles</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <input type="text" class="form-control" name="role" placeholder="Enter Role name" value="{{$authorization->role}}">
                                @error('role')
                                    <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach (config('authorization.permissions') as $key => $value)
                            <div class="col-4">
                                <div class="form-group">
                                    {{$value}} : <input type="checkbox" name="permissions[]" value="{{$key}}"
                                    @checked(in_array($key, $authorization->permissions))>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
</form>
