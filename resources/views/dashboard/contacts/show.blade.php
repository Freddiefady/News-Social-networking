@extends('layouts.dashboard.app')
@section('title')
contacts
@endsection
@section('body')
<div class="card-header">
    <h2>contact: {{$contact->name}}</h2>
</div>
<div class="container-fluid card  mb-4"><br>
<div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <!-- Button trigger modal -->
                <a href="{{route('dashboard.contacts.index')}}" class="btn btn-primary">
                    Return To Contacts
                </a>
            </div><br>
    <div class="card-body shadow mb-4">
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label class="form-label">Name:</label>
                    <input class="form-control" disabled value="{{$contact->name}}">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label class="form-label">Title:</label>
                    <input class="form-control" disabled value="{{$contact->title}}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label class="form-label">Email:</label>
                    <input class="form-control" disabled value="{{$contact->email}}">
                </div>
            </div>
            <div class="col-6">
                <div div class="form-group">
                    <label class="form-label">Phone:</label>
                    <input class="form-control" disabled value="{{$contact->phone}}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <p>{{$contact->body}}</p>
                </div>
            </div>
        </div>

<center>
<!-- <a href="" class="btn btn-warning">{{$contact->status == 1 ? "Pan" : "Active"}}</a> -->
<a href="mailto:{{$contact->email}}?subject=Re:{{urlencode($contact->title)}}" class="btn btn-primary">Reply <i class="fa fa-reply"></i></a>
<a href="javascript:void(0)"
    onclick="if(confirm('Do you want delete the contact')){document.getElementById('Deletecontact_{{$contact->id}}').submit()} return false"
    class="btn btn-danger">Delete <i class="fa fa-trash"></i></a>
<form action="{{route('dashboard.contacts.destroy', $contact->id)}}" id="Deletecontact_{{$contact->id}}" method="POST">
    @csrf
    @method('DELETE')
</form>
</center>
</div>
</div>
@endsection
