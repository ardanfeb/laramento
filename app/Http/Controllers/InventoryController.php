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

    // STOCK INTI

    public function index() 
    {
        return view('inventory.index');
    }

    // STOCK MASUK

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
            // DB::table('stocks')->where('products_id', $productArray[$i])->where('size', $sizeArray[$i])->decrement('stock', $pcsArray[$i]);
        }
        DB::table("stock_in_items")->insert($items);

        return redirect()->route('inventory.stock_in.create');
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
    
    // STOCK KELUAR
    
    public function stock_out() {
        return view('inventory.stock_out.index');
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
