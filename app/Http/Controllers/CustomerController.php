<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use DataTables;
use Carbon\Carbon;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function __construct() 
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('customer.index');
    }

    public function create()
    {
        return view('customer.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required|numeric',
            'address' => 'required',
        ]);

        DB::table('customers')->insert([
            'customer_name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'note' => $request->input('note'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->route('customer.index');
    }

    public function show($id)
    {
        $data = DB::table('customers')->find($id);
        return view('customer.show', compact('data'));
    }

    public function edit($id)
    {
        $data = DB::table('customers')
            ->where('id', $id)
            ->first();

        return view('customer.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required|numeric',
            'address' => 'required',
        ]);

        DB::table('customers')
        ->where('id', $id)
        ->update([
            'customer_name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'note' => $request->input('note'),
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->route('customer.index');
    }

    public function destroy($id)
    {
        DB::table('customers')->where('id', $id)->delete();
        return redirect()->route('customer.index');
    }

    // Data Table

    public function data()
    {
        DB::statement(DB::raw('set @rownum=0'));
        $customer = DB::table('customers')
            ->select([DB::raw('@rownum  := @rownum  + 1 AS rownum'), 'id', 'customer_name', 'phone'])
            ->get();
        return Datatables::of($customer)
            ->addColumn('action', function($customer){
                return view('action._user', [
                    'delete_url' => route('customer.destroy', $customer->id),
                    'edit_url' => route('customer.edit', $customer->id),
                    'show_url' => route('customer.show', $customer->id),
                ]);
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
