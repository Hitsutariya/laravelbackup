<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use DataTables;
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

      
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // $products = Product::select(['id', 'name', 'detail', 'image']);
            $products = DB::table('products')->select('products.*') // Select the columns you need
                // ->leftJoin('categories', 'categories.id', '=', 'products.category')
                ->get();
 
            return Datatables::of($products)
                ->addColumn('name', function ($product) {
                    return $product->name;
                })
                ->addColumn('detail', function ($product) {
                    return $product->detail;
                })   
                // ->addColumn('cname', function ($product) {
                //     return $product->cname;
                // })
                ->addColumn('image', function ($product) {  
                    $image = asset('images/' . $product->image);
                    return '<img src="' . $image . '" alt="' . $product->image . '" width="100">';
                })
                ->addColumn('action', function ($product) {
                    $editUrl = route('products.edit', $product->id);
                    $deleteUrl = route('products.destroy', $product->id);
                    return '<a href="' . $editUrl . '" class="btn btn-primary btn-sm">Edit</a> &nbsp;&nbsp;'
                        . '<form action="' . $deleteUrl . '" method="GET" style="display:inline">'
                        . '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure?\')">Delete</button>'
                        . '</form>';
                })
                ->rawColumns(['image', 'action'])
                ->make(true);
        }

        return view('products.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::where('status', '0')->get();
        return view('products.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
            'category' => 'exists:category,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,png,heic,svg|max:4048',
        ]);

        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }

        Product::create($input);

        return redirect()->route('products.index')
            ->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response 
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product 
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    { 
        $category = Category::where('status', '0')->get();
        $product = Product::find($product->id);
        return view('products.edit', compact('category', 'product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,heic,svg|max:4048',
        ]);

        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        } else {
            unset($input['image']);
        }

        $product->update($input);

        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Detail deleted successfully');
    }
}
