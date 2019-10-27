<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use DataTables;
use Carbon\Carbon;

use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('supplier.index');
    }

    public function create()
    {
        return view('supplier.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required|numeric',
            'address' => 'required',
        ]);

        DB::table('suppliers')->insert([
            'supplier_name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'note' => $request->input('note'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->route('supplier.index');
    }

    public function show($id)
    {
        $data = DB::table('suppliers')->find($id);
        return view('supplier.show', compact('data'));
    }

    public function edit($id)
    {
        $data = DB::table('suppliers')
            ->where('id', $id)
            ->first();

        return view('supplier.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required|numeric',
            'address' => 'required',
        ]);

        DB::table('suppliers')
        ->where('id', $id)
        ->update([
            'supplier_name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'note' => $request->input('note'),
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->route('supplier.index');
    }

    public function destroy($id)
    {
        DB::table('suppliers')->where('id', $id)->delete();
        return redirect()->route('supplier.index');
    }

    // Data Table

    public function data()
    {
        DB::statement(DB::raw('set @rownum=0'));
        $supplier = DB::table('suppliers')
            ->select([DB::raw('@rownum  := @rownum  + 1 AS rownum'), 'id', 'supplier_name', 'phone'])
            ->get();
        return Datatables::of($supplier)
            ->addColumn('action', function($supplier){
                return view('action._user', [
                    'delete_url' => route('supplier.destroy', $supplier->id),
                    'edit_url' => route('supplier.edit', $supplier->id),
                    'show_url' => route('supplier.show', $supplier->id),
                ]);
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
