<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use App\Photo;
use Illuminate\Http\Request;
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
        //
		$users = User::all();
		return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
		$roles = Role::pluck('name','id')->all();
		return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
		$this->validate($request, [
            'name' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required|unique:users',
            'role_id' => 'required',
            'password' => 'required|min:6',
            'photo_id' => 'mimes:jpeg,png,bmp'
        ]);
				
		if(trim($request->password == '')){
			$input = $request->except('password');
		} else {		
			$input = $request->all();
		  }

		if($file = $request->file('photo_id')){
			$name = time() . $file->getClientOriginalName();
            //$file->move('images', $name);
			$file->store('images', $name);
			$photo = Photo::create(['file'=>$name]);
			$input['photo_id'] = $photo->id;
		}
		
		$input['password'] = bcrypt($request->password);
		
		User::create($input);

        Session::flash('created_message', 'The user has been created');
		
		return redirect('/admin/users');
		
		//return $request->all();
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
		$user = User::findOrFail($id);
		$roles = Role::pluck('name', 'id')->all();
		
		return view('admin.users.edit', compact('user', 'roles'));
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
        $user = User::findOrFail($id);

        $this->validate($request, [
            'name' => 'required',
            'username' => 'required|unique:users,username,'.$user->id,
            'email' => 'required|unique:users,email,'.$user->id,
            'role_id' => 'required',
            'password' => 'min:6',
            'photo_id' => 'mimes:jpeg,png,bmp'
        ]);
		
		if(trim($request->password == '')){
			$input = $request->except('password');
		} else {		
			$input = $request->all();
            $input['password'] = bcrypt($request->password);
		  }
		
		if($file = $request->file('photo_id')){
			$name = time() . $file->getClientOriginalName();
			$file->move('images', $name);
			$photo = Photo::create(['file'=>$name]);
			$input['photo_id'] = $photo->id;
		}
		
		$user->update($input);

        Session::flash('updated_message', 'The user has been updated');

		return redirect('admin/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
		$user = User::findOrFail($id);
		if($user->photo){
			unlink(public_path() . $user->photo->file);
		}
		$user->delete();
		
		Session::flash('deleted_message', 'The user has been deleted');
		
		return redirect('/admin/users');
    }
}
