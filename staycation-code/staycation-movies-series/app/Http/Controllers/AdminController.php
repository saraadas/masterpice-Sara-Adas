<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $admins = Admin::all();
        return view('admin_dashboard.view_admin',compact('admins'));
    }

    public function validation($request)
    {
        $request->validate([
            'email' => 'required|email',
            'username' => 'required',
            'password' => 'required|min:8|max:16|confirmed',
            'password_confirmation' =>'required'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validation($request);
        Admin::create($request->all());
        return redirect('/admin_dashboard/view_admin');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        return view('admin_dashboard.manage_admin_edit',compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        $request->validate([
            'email' => 'required|email',
            'username' => 'required',
            'password' => 'required|min:8|max:16|confirmed',
            'password_confirmation' =>'required'
        ]);

        $admin=Admin::find($admin->id);
        // Admin::create($request->all());
        $admin->username =$request->fullname;
        $admin->email =$request->email;
        $admin->password =$request->password;
        $admin->save();
        return redirect('/dashboard/admin');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Admin::findOrFail($id)->delete();
        return redirect('/dashboard/admin');

    }

}
