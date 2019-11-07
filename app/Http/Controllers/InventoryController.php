<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use App\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class InventoryController extends Controller {

    public function __construct() 
    {
        $this->middleware('auth');
    }

    // NOTE: STOCK INTI

    public function index() 
    {
        return view('inventory.index');
    }

    public function stock_data() 
    {
        $inventories = DB::table('inventories')
            ->select('products.product_name', 'labels.label_name', 'categories.category_name', 'inventories.qty as stok_akhir')
            ->join('products', 'products.id', '=', 'inventories.products_id')
            ->join('labels', 'labels.id', '=', 'products.labels_id')
            ->leftJoin('categories', 'categories.id', '=', 'products.categories_id')
            ->get();

        return Datatables::of($inventories)
            ->editColumn('product_name', function($inventories){
                return "<div>".$inventories->product_name." <span class='badge' style='margin-left:5px;'>".$inventories->label_name."</span></div>";
            })
            ->editColumn('stok_akhir', function($inventories){
                if ($inventories->stok_akhir <= 0) {
                    return "<div class='text-right'><span style='margin-top:3px;' title='Stok Habis' class='fa fa-exclamation-circle txtc-red pull-left'></span><b class='txtc-red'>".$inventories->stok_akhir."</b></div>";
                } else if ($inventories->stok_akhir <= 10) {
                    return "<div class='text-right'><span style='margin-top:3px;' title='Stok Hampir Habis' class='fa fa-exclamation-circle txtc-yellow pull-left'></span><b class='txtc-yellow'>".$inventories->stok_akhir."</b></div>";
                } else {
                    return "<div class='text-right'><b>".$inventories->stok_akhir."</b></div>";
                }
            })
            ->rawColumns(['stok_akhir', 'product_name'])
            ->make(true);
    }

    // NOTE: STOCK MASUK

    public function stock_in() 
    {
        return view('inventory.stock_in.index');
    }

    public function stock_in_create()
    {
        $product = DB::table('products')
            ->select('products.id', 'products.product_name', 'labels.label_name')
            ->join('labels', 'labels.id', '=', 'products.labels_id')
            ->get();
        
        $data = array(
            'product' => $product,
        );

        return view('inventory.stock_in.create', $data);
    }

    public function stock_in_store(Request $request)
    {
        $this->validate($request, [
            'total_harga_final' => 'required|numeric|min:1',
        ]);

        // Built Code
        $code = 'SM-'.date('dmYHis');

        // Insert Stock In
        DB::table("stock_ins")->insert([
            'code' => $code,
            'note' => $request->input('note'),
            'input_by' => Auth::user()->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Config Stock In Items
        $stock_in = DB::table('stock_ins')->where('code', $code)->first();
        
        // Get Data Array + Count
        $product = $request->input('product');
        $qty = $request->input('qty');
        $price = $request->input('price_buy');
        $count = count($product);

        // Insert Stock In Items
        $items = array();
        for($i = 0; $i < $count; $i++){
            $item = array(
                'stock_ins_id' => $stock_in->id,
                'products_id' => $product[$i],
                'qty' => $qty[$i],
                'price_buy' => $price[$i],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            );
            $items[] = $item;

            // Insert Stok Global
            DB::table('inventories')->where('products_id', $product[$i])->increment('qty', $qty[$i]);
        }

        DB::table("stock_in_items")->insert($items);

        return redirect()->route('inventory.stock_in');
    }

    public function stock_in_show($id)
    {
        $items = DB::table('stock_in_items')
            ->select('stock_in_items.*', 'products.product_name', 'labels.label_name')
            ->where('stock_ins_id', $id)
            ->join('products', 'products.id', '=', 'stock_in_items.products_id')
            ->join('labels', 'labels.id', '=', 'products.labels_id')
            ->get();

        $data = array(
            'stock' => DB::table('stock_ins')->find($id),
            'items' => $items,
        );

        return view('inventory.stock_in.show', $data);
    }

    public function stock_in_data()
    {
        $stock_in = DB::table('stock_ins')
            ->select('stock_ins.id', 'stock_ins.code', 'stock_ins.created_at', 'users.name as input_by')
            ->join('users', 'users.id', '=', 'stock_ins.input_by')
            ->get();
            
        return Datatables::of($stock_in)
            ->addColumn('action', function($stock_in){
                return "<a class='btn btn-xs btn-default' href='" . route('inventory.stock_in.show', $stock_in->id) . "'><i class='fas fa-ellipsis-h' style='padding:0 10px;'></i></a>";
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    
    // NOTE: STOCK KELUAR
    
    public function stock_out() 
    {
        return view('inventory.stock_out.index');
    }

    public function stock_out_create()
    {
        $product = DB::table('products')
            ->select('products.id', 'products.product_name', 'labels.label_name')
            ->join('labels', 'labels.id', '=', 'products.labels_id')
            ->get();
        
        $data = array(
            'product' => $product,
        );

        return view('inventory.stock_out.create', $data);
    }

    public function stock_out_store(Request $request)
    {
        $this->validate($request, [
            'note' => 'required',
        ]);

        // Built Code
        $code = 'SK-'.date('dmYHis');

        // Insert Stock Out
        DB::table("stock_outs")->insert([
            'code' => $code,
            'note' => $request->input('note'),
            'input_by' => Auth::user()->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Config Stock Out Items
        $stock_outs = DB::table('stock_outs')->where('code', $code)->first();
        
        // Get Data Array + Count
        $product = $request->input('product');
        $qty = $request->input('qty');
        // $price = $request->input('price_buy');
        $count = count($product);

        // Insert Stock Out Items
        $items = array();
        for($i = 0; $i < $count; $i++){
            $item = array(
                'stock_outs_id' => $stock_outs->id,
                'products_id' => $product[$i],
                'qty' => $qty[$i],
                // 'price_buy' => $price[$i],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            );
            $items[] = $item;

            // Insert Stok Global
            DB::table('inventories')->where('products_id', $product[$i])->decrement('qty', $qty[$i]);
        }

        DB::table("stock_out_items")->insert($items);

        return redirect()->route('inventory.stock_out');
    }

    public function stock_out_show($id)
    {
        $items = DB::table('stock_out_items')
            ->select('stock_out_items.*', 'products.product_name', 'labels.label_name')
            ->where('stock_outs_id', $id)
            ->join('products', 'products.id', '=', 'stock_out_items.products_id')
            ->join('labels', 'labels.id', '=', 'products.labels_id')
            ->get();

        $data = array(
            'stock' => DB::table('stock_outs')->find($id),
            'items' => $items,
        );

        return view('inventory.stock_out.show', $data);
    }

    public function stock_out_data()
    {
        $stock_out = DB::table('stock_outs')
            ->select('stock_outs.id', 'stock_outs.code', 'stock_outs.created_at', 'users.name as input_by')
            ->join('users', 'users.id', '=', 'stock_outs.input_by')
            ->get();
            
        return Datatables::of($stock_out)
            ->addColumn('action', function($stock_out){
                return "<a class='btn btn-xs btn-default' href='" . route('inventory.stock_out.show', $stock_out->id) . "'><i class='fas fa-ellipsis-h' style='padding:0 10px;'></i></a>";
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    
    // STOCK OPNAME
    
    public function stock_opname() {
        return view('inventory.stock_opname.index');
    }

    // STOCK PURCHASE ORDER
    
    public function purchase_order() {
        return view('inventory.purchase_order.index');
    }

}
