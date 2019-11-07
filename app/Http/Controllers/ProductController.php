<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Product;
use DataTables;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function __construct() 
    {
        $this->middleware('auth');
    }

    // PRODUCT
    
    public function index()
    {
        return view('product.index');
    }

    public function create()
    {
        $category = DB::table('categories')->select('id', 'category_name')->get();
        $label = DB::table('labels')->select('id', 'label_name')->get();

        $data = array(
            'category' => $category,
            'label' => $label,
        );

        return view('product.create', $data);
    }

    
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'label' => 'required',
            'price_buy' => 'required|numeric',
            'price_sell' => 'required|numeric',
        ]);

        $product = new Product;
        $product->categories_id = $request->input('category');
        $product->labels_id = $request->input('label');
        $product->price_buy = $request->input('price_buy');
        $product->price_sell = $request->input('price_sell');
        $product->note = $request->input('note');
        $product->sku = $request->input('sku');
        $product->barcode = $request->input('barcode');
        $product->product_name = $request->input('name');
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $filename = time() . '-' . $file->getClientOriginalName() . '.' . $file->getClientOriginalExtension();
            $request->file('img')->move("img/product/", $filename);
            $product->img = $filename;
        }
        $product->save();
        $id_product = $product->id;

        // Insert to Inventories
        if ($product) {
            DB::table('inventories')->insert([
                'products_id' => $id_product,
                'qty' => 0
            ]);
        }

        return redirect()->route('product.index')->with([
            'status' => $product ? 'success' : 'danger',
            'msg' => $product ? 'Product has been added.' : 'Failed add product.'
        ]);
    }

    // TODO: Tinggal Finishing
    public function show($id)
    {
        $data = Product::find($id);

        return view('product.show', compact('data'));
    }

    public function edit($id)
    {
        $category = DB::table('categories')->select('id', 'category_name')->get();

        $label = DB::table('labels')->select('id', 'label_name')->get();

        $product = Product::find($id);

        $data = array(
            'category' => $category,
            'label' => $label,
            'product' => $product,
        );

        return view('product.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'label' => 'required',
            'price_buy' => 'required|numeric',
            'price_sell' => 'required|numeric',
        ]);

        $product = Product::find($id);
        $product->categories_id = $request->input('category');
        $product->labels_id = $request->input('label');
        $product->price_buy = $request->input('price_buy');
        $product->price_sell = $request->input('price_sell');
        $product->note = $request->input('note');
        $product->sku = $request->input('sku');
        $product->barcode = $request->input('barcode');
        $product->product_name = $request->input('name');
        if ($request->hasFile('img')) {

            // Tambah foto
            $file = $request->file('img');
            $filename = time() . '-' . $file->getClientOriginalName() . '.' . $file->getClientOriginalExtension();
            $request->file('img')->move("img/product/", $filename);
            $oldfilename = $product->img;

            // Update database
            $product->img = $filename;
            
            // Hapus foto lama
            $filepath = "img/product/". $oldfilename;
            if (file_exists($filepath)) { @unlink($filepath); }
        }
        $product->save();

        return redirect()->route('product.index')->with([
            'status' => $product ? 'success' : 'danger',
            'msg' => $product ? 'Product has been updated.' : 'Failed update product.'
        ]);
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        $filepath = "img/product/". $product->img;

        if (file_exists($filepath)) {
            @unlink($filepath);
        }

        $product->delete();

        return redirect()->route('product.index')->with([
            'status' => $product ? 'success' : 'danger',
            'msg' => $product ? 'Product has been deleted.' : 'Failed to delete product.'
        ]);
    }

    public function data_product()
    {
        DB::statement(DB::raw('set @rownum=0'));
        $product = DB::table('products')
            ->select([
                DB::raw('@rownum  := @rownum  + 1 AS rownum'), 
                'products.id as id', 
                'product_name',
                'label_name',
                'category_name',
                'price_sell as price', 
            ])
            ->leftJoin('labels', 'labels.id', '=', 'products.labels_id')
            ->leftJoin('categories', 'categories.id', '=', 'products.categories_id')
            ->get();
            
        return Datatables::of($product)
            ->addColumn('action', function($product){
                return view('action._user', [
                    'delete_url' => route('product.destroy', $product->id),
                    'edit_url' => route('product.edit', $product->id),
                    'show_url' => route('product.show', $product->id),
                ]);
            })
            ->editColumn('product_name', function($product){
                return $product->product_name." <b class='badge' style='margin-left:5px;'>".$product->label_name."</b>";
            })
            ->editColumn('price', function($product){
                return "Rp. ".number_format($product->price, 0, ',', '.');
            })
            ->rawColumns(['product_name', 'action', 'price'])
            ->make(true);
    }


    // CATEGORY

    public function data_category()
    {
        DB::statement(DB::raw('set @rownum=0'));
        $category = DB::table('categories')
            ->select([DB::raw('@rownum  := @rownum  + 1 AS rownum'), 'id', 'category_name'])
            ->get();
        return Datatables::of($category)
            ->addColumn('action', function($category){
                return view('action._del', [
                    'delete_url' => route('category.destroy', $category->id),
                    // 'edit_url' => route('category.update', $category->id),
                ]);
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function store_category(Request $request)
    {
        DB::table('categories')->insert([
            'category_name' => $request->input('category_name'), 
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->route('product.index');
    }

    // NOTE: belum dipakai
    public function update_category(Request $request, $id)
    {
        return redirect()->route('product.index');
    }

    public function destroy_category($id)
    {
        DB::table('categories')->where('id', $id)->delete();

        return redirect()->route('product.index');
    }


    // LABEL
    
    public function data_label()
    {
        DB::statement(DB::raw('set @rownum=0'));
        $label = DB::table('labels')
            ->select([DB::raw('@rownum  := @rownum  + 1 AS rownum'), 'id', 'label_name'])
            ->get();
        return Datatables::of($label)
            ->addColumn('action', function($label){
                return view('action._del', [
                    'delete_url' => route('product.destroy', $label->id),
                    // 'edit_url' => route('product.edit', $label->id),
                ]);
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function store_label(Request $request)
    {
        DB::table('labels')->insert([
            'label_name' => $request->input('label_name'), 
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->route('product.index');
    }

    // NOTE: belum dipakai
    public function update_label(Request $request, $id)
    {
        return redirect()->route('product.index');
    }

    public function destroy_label($id)
    {
        DB::table('labels')->where('id', $id)->delete();
        
        return redirect()->route('product.index');
    }

}
