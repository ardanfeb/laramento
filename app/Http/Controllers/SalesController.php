<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use Carbon\Carbon;
use App\Sales;
use App\Customer;
use Illuminate\Support\Facades\Auth;

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
            'marketplace' => DB::table('marketplaces')->get(),
        );

        return view('sales.create', $data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'customer_type' => 'required',
            'selling_type' => 'required',
            'status' => 'required',
        ]);

        // Customer Type
        if ($request->input('customer_type') == '1') { // Pelanggan Terdaftar
            $this->validate($request, [
                'customer' => 'required',
            ]);

            $customer = DB::table('customers')->find($request->input('customer'));

            $customer_name = $customer->customer_name;
            $customer_type = "customer";
        } else if ($request->input('customer_type') == '2') { // Pelanggan Belum Terdaftar
            $this->validate($request, [
                'customer_name' => 'required',
                'customer_phone' => 'required|numeric',
                'customer_address' => 'required',
            ]);

            $id = DB::table('customers')->insertGetId([
                'customer_name' => $request->input('customer_name'),
                'phone' => $request->input('customer_phone'),
                'address' => $request->input('customer_address'),
            ]);

            $customer_name = $request->input('customer_name');
            $customer_type = "customer";
        } else { // Reseller
            $this->validate($request, [
                'reseller' => 'required',
            ]);
                
            $reseller = DB::table('users')->find($request->input('reseller'));

            $customer_name = $reseller->name;
            $customer_type = "reseller";
        }

        // Selling Type
        if ($request->input('selling_type') == 'online') { // Online
            $this->validate($request, [
                'resi' => 'required',
                'marketplace' => 'required',
                'ekspedisi' => 'required',
                'ongkir' => 'required',
            ]);

            $marketplace = $request->input('marketplace');
            $invoice = "INV/".$request->input('marketplace')."/".Carbon::now()->format('dmY/His');
        } else { // Offline
            $invoice = "INV/OFFLINE/".Carbon::now()->format('dmY/His');
            $marketplace = "OFFLINE";
        }

        // Insert Into Sales Table
        $sales = new Sales;
        $sales->recipe = $request->input('resi');
        $sales->invoice = $invoice;
        $sales->marketplace = $marketplace;
        $sales->expedition = $request->input('ekspedisi');
        $sales->postal_fee = $request->input('ongkir');
        $sales->total_product = $request->input('total_product');
        $sales->customers_name = $customer_name;
        $sales->customers_type = $customer_type;
        $sales->users_id = Auth::user()->id;
        $sales->status = $request->input('status');
        $sales->save();

        // Insert Into Sales_items Table
        $productArr = $request->input('product');
        $qtyArr = $request->input('qty');
        $priceArr = $request->input('price_sell');

        if(count($productArr) > count($priceArr)) $count = count($priceArr);
        else $count = count($productArr);

        $items = array();
        for($i = 0; $i < $count; $i++){
            $item = array(
                'sales_id' => $sales->id,
                'product_name' => $productArr[$i],
                'qty' => $qtyArr[$i],
                'price_sell' => $priceArr[$i],
                // 'array_id' => $i,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            );
            $items[] = $item;

            DB::table('inventories')->where('products_id', $productArr[$i])->decrement('qty', $qtyArr[$i]);
        }

        DB::table("sales_items")->insert($items);

        return redirect()->route('sales.index');
    }

    public function show($id)
    {
        $product = DB::table('sales_items')
            ->select('sales_items.*', 'products.product_name', 'categories.category_name', 'labels.label_name')
            ->join('products', 'products.id', '=', 'sales_items.product_name')
            ->join('categories', 'categories.id', '=', 'products.categories_id')
            ->join('labels', 'labels.id', '=', 'products.labels_id')
            ->where('sales_id', $id)
            ->get();

        $data = array(
            'sales' => DB::table('sales')->find($id),
            'sales_items' => $product,
        );
        
        return view('sales.show', $data);
    }

    public function edit($id)
    {
        $product = DB::table('products')
            ->select('products.id', 'products.product_name', 'labels.label_name')
            ->join('labels', 'labels.id', '=', 'products.labels_id')
            ->get();

        $data = array(
            'sales' => Sales::find($id),
            'product' => $product,
        );

        return view('sales.edit', $data);
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
        $sales = DB::table('sales')
            ->select('sales.*', 'users.name as employee_name')
            ->join('users', 'users.id', '=', 'sales.users_id')
            ->get();

        return Datatables::of($sales)
            ->addIndexColumn()
            ->addColumn('action', function($sales){
                return view('action._user', [
                    'delete_url' => route('sales.destroy', $sales->id),
                    'edit_url' => route('sales.edit', $sales->id),
                    'show_url' => route('sales.show', $sales->id),
                ]);
            })
            ->editColumn('status', function($sales){
                return ($sales->status == "Sukses" ? '<span class="badge bgc-green">Sukses</span>' : '<span class="badge bgc-orange">Pending</span>');
            })
            ->editColumn('customer', function($sales){
                return ($sales->customers_type == "reseller" ? '<span class="badge bgc-blue" style="margin-right:5px;">Reseller</span> '.$sales->customers_name : '<span class="badge bgc-yellow" style="margin-right:5px;">Pelanggan</span> '.$sales->customers_name);
            })
            ->editColumn('invoice', function($sales){
                return '<a href="'. route('sales.show', $sales->id) .'">'. $sales->invoice .'</a>';
            })
            ->rawColumns(['invoice', 'action', 'customer', 'status'])
            ->make(true);
    }
}
