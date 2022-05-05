<?php

namespace App\Http\Controllers;

use App\Models\ToDoList;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminToDoListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todolists = ToDoList::with('user')->orderby("created_at","desc")->get();
        if (Auth::user())
        {
            $user = Auth::user()->id;
            $loginUser = User::findOrFail($user);
        }else{
            $loginUser = '';
        }

        return view('toDoList.index', compact('todolists','loginUser'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('toDoList.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::user()){
            $to_do_list = new ToDoList();
            $to_do_list->taak = $request->taak;
            $to_do_list->user_id = Auth::user()->id;
            $to_do_list->save();
            return redirect('toDoList');
        }else{
           return redirect('/login');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $to_do_list =  ToDoList::findOrfail($id);
        $to_do_list->delete();
        Session::flash('taak_message', $to_do_list->taak . ' was Deleted!');
        return redirect('toDoList');
    }
}
