@extends('layouts.app')
@section('content')
    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col">
                    <div class="card" id="list1" style="border-radius: .75rem; background-color: #eff1f2;">
                        <div class="card-body py-4 px-4 px-md-5">

                            <p class="h1 text-center mt-3 mb-4 pb-3 text-primary">
                                <u>My To Do List</u>
                            </p>
                            <div class="col">
                                @if(session('taak_message'))
                                    <div class="alert alert-info alert-dismissible">
                                        <strong>Info!</strong> {{session('taak_message')}}
                                    </div>
                                @endif
                            </div>
                            <div class="pb-2">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="">
                                            <form action="{{route('toDoList.store')}}" method="POST">
                                                @csrf

                                                <input name="taak" type="text" class="form-control form-control-lg"
                                                       id="exampleFormControlInput1"
                                                       placeholder="Add new...">

                                                <div class="my-2 text-center">
                                                    <button type="submit" class="btn btn-primary">Add Task</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Taak</th>
                                    <th>User</th>
                                    <th>Created At</th>
                                    <th>Complete</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($todolists as $todolist)
                                    <tr>
                                        <td>{{$todolist->taak}}</td>
                                        <td>{{$todolist->user->name}}</td>
                                        <td>{{$todolist->created_at->diffForHumans()}}</td>
                                        <td>
                                            @if(Auth::user())
                                                @if($loginUser->id == $todolist->user->id)
                                                    <form action="{{route('toDoList.destroy', $todolist->id)}}"
                                                          method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm m-1">Delete
                                                        </button>
                                                    </form>
                                                @elseif($loginUser->role_id == 1)
                                                    <form action="{{route('toDoList.destroy', $todolist->id)}}"
                                                          method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm m-1">Delete
                                                        </button>
                                                    </form>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


