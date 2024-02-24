@extends('admin.admin_master')

@section('admin')


<div class="row">
    <div class="col-lg-4">
        <div class="card"><br><br>
            <center>
            <img class="rounded-circle avatar-xl" src="{{!empty($adminData->profile_image)?asset('upload/admin_images/'.$adminData->profile_image):asset('upload/no_image.jpg')}}" alt="Profile Image">
            </center>
            <div class="card-body">
                <hr>
                <h4 class="card-title">Name : {{$adminData->name}}</h4>
                <hr>
                <h4 class="card-title">Email : {{$adminData->email}}</h4>
                <hr>
                <h4 class="card-title">Username : {{$adminData->username}}</h4>
                <hr>
                <a href="{{route('edit.profile')}}" class="btn btn-info btn-rounded waves-effect waves-light">Edit Profile</a>

            </div>
        </div>
    </div>

</div>



@endsection
