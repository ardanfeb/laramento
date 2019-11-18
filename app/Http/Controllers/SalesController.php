<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use Carbon\Carbon;

class SalesController extends Controller
{

    public function __construct() 
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        return view('sales.index');
    }

    public function create()
    {
        $product = DB::table('products')
            ->select('products.id', 'products.product_name', 'labels.label_name')
            ->join('labels', 'labels.id', '=', 'products.labels_id')
            ->get();

        $reseller = DB::table('users')
            ->join('role_user', 'role_user.user_id', '=', 'users.id')
            ->where('role_user.role_id', 3)
            ->get();

        $data = array(
            'customer' => DB::table('customers')->get(),
            'product' => $product,
            'reseller' => $reseller,
        );

        return view('sales.create', $data);
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    // Data Table
    public function data(Request $request)
    {
        $sales = DB::table('sales')->get();

        return Datatables::of($sales)
            ->addIndexColumn()
            ->addColumn('action', function($sales){
                return view('action._user', [
                    'delete_url' => route('sales.destroy', $sales->id),
                    'edit_url' => route('sales.edit', $sales->id),
                    'show_url' => route('sales.show', $sales->id),
                ]);
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
