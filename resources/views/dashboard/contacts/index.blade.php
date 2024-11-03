@extends('layouts.dashboard.app')
@section('title')
Contacts
@endsection
@section('body')
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Contacts</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">DataTables for contacts</h6>
    </div>
    @include('dashboard.contacts.filter')
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Phone</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Phone</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
                <tbody>
                    @forelse ($contacts as $contact)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$contact->name}}</td>
                        <td>{{$contact->email}}</td>
                        <td>{{$contact->title}}</td>
                        <td>{{$contact->status == 1 ? 'Read' : 'Unread'}}</td>
                        <td>{{$contact->phone}}</td>
                        <td>{{$contact->created_at->diffForHumans()}}</td>
                        <td>
                            <a href="javascript:void(0)" onclick="if(confirm('Do you want delete the contact')){document.getElementById('Deletecontact_{{$contact->id}}').submit()} return false"
                            ><i class="fa fa-trash" title="Delete" style="padding-right: 19px;"></i></a>

                            <a href="{{route('dashboard.contacts.show',$contact->id)}}"><i class="fa fa-eye" title="Show"></i></a>
                        </td>
                        <form action="{{route('dashboard.contacts.destroy', $contact->id)}}" id="Deletecontact_{{$contact->id}}" method="POST">
                            @csrf
                            @method('DELETE')
                        </form>
                        @empty
                        <tr>
                            <td class="alert alert-info" colspan="6">No contacts found.</td>
                        </tr>
                        @endforelse
                    </tr>
                </tbody>
            </table>
            {{$contacts->appends(request()->input())->links()}}
        </div>
    </div>
</div>

</div>
<!-- /.container-fluid -->
@endsection
