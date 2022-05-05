@extends('layouts.admin')
@section('content')
    <div class="col-12">
        <div class="border border-2 rounded-3 my-3 bg-black">
            <h1 class="text-center text-white">Create User</h1>
        </div>
        <div class="row py-3">
            <div class="col-8 offset-2 img-thumbnail bg-black">
                @include('includes.form_error')
                <form action="{{route('users.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group pe-2">
                        <label class="text-white" for="name">Name:</label>
                        <input type="text" name="name" id="title"
                               class="form-control"
                               placeholder="Name..">
                    </div>
                    <div class="form-group">
                        <label class="text-white" for="email">E-mail:</label>
                        <input type="email" name="email" id="title"
                               class="form-control"
                               placeholder="E-mail..">
                    </div>
                    <div class="form-group">
                        <label class="text-white" for="role">Role:</label>
                        <select name="role" class="form-control">
                            @foreach($roles as $role)
                                <option value="{{$role->id}}">
                                    {{$role->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="text-white" for="email">Password:</label>
                        <input value="" type="password" name="password" id="password"
                               class="form-control"
                               placeholder="Password...">
                    </div>
                    <div class="form-group">
                        <label class="text-white me-3" for="file">Profile Photo:</label>
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Your Profile Picture</h5>
                                    <input type="file" name="photo_id" class="dropify"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center my-3">
                        <button type="submit" class="btn btn-primary">Create User</button>
                    </div>

                </form>
            </div>
        </div>
@endsection
