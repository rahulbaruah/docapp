<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('type','!=','doctor')
                        ->orWhereNull('type')
                        ->get();
        
		$data = ['users' => $users];
		return view('/admin.users.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('/admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
			'name' => 'required',
			'email' => 'required|email|unique:users',
			'password' => 'required',
		]);
        
        $credentials = array(
			'name' => $request->input('name'),
			'email' => $request->input('email'),
			'password' => bcrypt($request->input('password'))
		);
		
		$user = User::create($credentials);
		$user->role = $request->input('role');
		$user->save();
		
		$data = ["msg" => ["User added successfully"]];
		return redirect('admin/users')->with($data);
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
        $user = User::find($id);
						 
		$data = ['user' => $user];
		
		return view('/admin.users.edit')->with($data);
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
        $this->validate($request, [
			'name' => 'required',
			'email' => 'required|email'
		]);
		
		$user = User::find($id);
		
		if($user->email != $request->input('email')){
			$this->validate($request, [
				'email' => 'unique:users'
			]);
		}
		
		if($request->input('password')) {
    		$user->password = bcrypt($request->input('password'));
		}
		
		$user->name = $request->input('name');
		$user->email = $request->input('email');
		$user->role = $request->input('role');
		$user->save();
		
		$data = ["msg" => ["User updated successfully"]];
		return redirect()->back()->with($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($id>1) {
            User::destroy($id);
        }
    }
}
