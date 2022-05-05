<?php

namespace App\Http\Controllers;

use App\Events\UsersSoftDelete;
use App\Http\Requests\UsersEditRequest;
use App\Http\Requests\UsersRequest;
use App\Models\Photo;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {

        $users = User::with('role','photo')->withTrashed()->orderBy('updated_at', 'desc')->paginate(20);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = $request->role;
        $user->password = Hash::make($request['password']);

        /** photo opslaan **/
        if ($file = $request->file('photo_id')) {
            $name = time() . $file->getClientOriginalName();
            $file->move('img/users', $name);
            $photo = Photo::create(['file' => $name]);
            $user->photo_id = $photo->id;
        }
        $user->save();

        Session::flash('user_message','User ' . $request->name . ' was created!');
        return redirect('admin/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(UsersEditRequest $request, $id)
    {
        $user = User::findOrFail($id);
        if (trim($request->password) == '') {
            $input = $request->except('password');
        } else {
            $input = $request->all;
            $input['password'] = Hash::make($request['password']);
        }
        /** opvragen oude image **/
        $oldImage = Photo::find($user->photo_id);
        if($oldImage){
            //fysisch verwijderen uit img directory
            unlink(public_path() . '/img/users' . $oldImage->file);
            //oude image uit de tabel photos verwijderen
            $oldImage->delete();
        }
        /** photo overschrijven **/
        if ($file = $request->file('photo_id')) {
            $name = time() . $file->getClientOriginalName();
            $file->move('img/users', $name);
            $photo = Photo::create(['file' => $name]);
            $user->photo_id = $input['photo_id'] = $photo->id;
        }
        $user->update($input);

        /** Wegschrijven tussentabel met de nieuwe rollen **/
        Session::flash('user_message','User ' . $request->name . ' was updated!');
        return redirect('admin/users');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        Session::flash('user_message', $user->first_name . $user->last_name . ' was deleted!');
        return redirect('/admin/users');
    }

    public function restore($id)
    {
        User::onlyTrashed()->where('id', $id)->restore();
        $user = User::findOrFail($id);
        Session::flash('user_message', $user->first_name . $user->last_name . ' was restored!');
        return redirect('/admin/users');
    }
}

