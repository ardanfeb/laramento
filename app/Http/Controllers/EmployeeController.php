<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\User;
use App\Store;
use DataTables;
use Carbon\Carbon;

use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function __construct() 
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('employee.index');
    }

    public function create()
    {
        return view('employee.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric|unique:users,phone',
            'address' => 'required',
            'gender' => 'required',
            'birthdate' => 'required',
            'role' => 'required',
            'password' => 'required',
        ]);

        // Create codeuser
        $seed = str_split('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789');
        shuffle($seed);
        $rand = '';
        foreach (array_rand($seed, 6) as $k) $rand .= $seed[$k];
        if ($request->input('role') == 1) $codeuser = 'OWNER'.$rand; 
        if ($request->input('role') == 2) $codeuser = 'ADMIN'.$rand; 
        if ($request->input('role') == 3) $codeuser = 'LARAMENTO'.$rand; 

        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->birthdate = $request->input('birthdate');
        $user->gender = $request->input('gender');
        $user->phone = $request->input('phone');
        $user->address = $request->input('address');
        $user->stores_id = $request->input('store');
        $user->codeuser = $codeuser;
        $user->password = bcrypt($request->input('password'));
        $user->save();

        $findUser = User::where('phone', $request->input('phone'))->first();
        $setRole = DB::insert('insert into role_user (role_id, user_id, user_type) values (?, ?, ?)', [$request->input('role'), $findUser->id, 'App\User']);

        return redirect()->route('employee.index');
    }

    // Employee
    public function show($id)
    {
        $data = User::find($id);
        return view('employee.show', compact('data'));
    }

    public function edit($id)
    {
        $query_user = DB::table('users')
            ->join('role_user', 'users.id', '=', 'role_user.user_id')
            ->where('id', $id)
            ->first();

        $data = array(
            'user' => $query_user,
        );

        return view('employee.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric|unique:users,phone,'.$id,
            'address' => 'required',
            'gender' => 'required',
            'birthdate' => 'required',
            'role' => 'required',
            // 'password' => 'required',
        ]);

        $user = User::find($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->birthdate = $request->input('birthdate');
        $user->gender = $request->input('gender');
        $user->phone = $request->input('phone');
        $user->address = $request->input('address');
        $user->stores_id = $request->input('store');
        // $user->password = bcrypt($request->input('password'));
        $user->save();

        $findUser = User::where('phone', $request->input('phone'))->first();
        $updateRole = DB::table('role_user')->where('user_id', $findUser->id)->update(['role_id' => $request->input('role')]);

        return redirect()->route('employee.index');
    }

    public function destroy($id)
    {
        DB::table('users')->where('id', $id)->delete();
        DB::table('role_user')->where('user_id', $id)->delete();
        
        return redirect()->route('employee.index');
    }

    // Data Table

    public function data(Request $request)
    {
        $employee = DB::table('users')
            ->leftJoin('role_user', 'users.id', '=', 'role_user.user_id')
            ->leftJoin('roles', 'role_user.role_id', '=', 'roles.id')
            ->select(['users.*', 'roles.display_name as role'])
            ->whereNotIn('roles.id', [1])
            ->get();

        return Datatables::of($employee)
            ->addIndexColumn()
            ->addColumn('action', function($employee){
                return view('action._user', [
                    'delete_url' => route('employee.destroy', $employee->id),
                    'edit_url' => route('employee.edit', $employee->id),
                    'show_url' => route('employee.show', $employee->id),
                ]);
            })
            ->editColumn('role', function($employee){
                return '<span class="badge bgc-'. ($employee->role == 'Employee' ? 'green' : 'blue') .'">'. ($employee->role == 'Employee' ? 'Karyawan' : 'Reseller') .'</span>';
            })
            ->rawColumns(['action', 'role'])
            ->make(true);
    }
}
