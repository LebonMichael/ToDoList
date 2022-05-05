@extends('layouts.admin')
@section('content')
    <div class="col-12">
        @include('includes.form_error')
        <div class="card mb-3" style="width:auto;">
            <div class="row no-gutters">
                <div class="col-md-4">
                    <div class="m-3 align-items-stretch">
                        <img class="img-fluid img-thumbnail bg-black"
                             src="{{$user->photo ? asset('img/users') . $user->photo->file : 'http://via.placeholder.com/500x500'}}"
                             alt="{{$user->name}}">
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card-body img-thumbnail bg-black m-3">
                        <div>
                            <h5 class="card-title text-white">Name : {{$user->name}}</h5>
                            <p class="card-text text-white">E-mail : {{$user->email}}</p>
                            <p class="card-text text-white">
                                Role :
                                @if($user->role)
                                    <span class="badge rounded-pill bg-primary">{{$user->role->name}}</span>
                            @endif
                            <p class="card-text my-3"><small
                                    class="text-muted">{{$user->updated_at->diffForhumans()}}</small></p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
