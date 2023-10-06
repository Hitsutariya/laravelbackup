<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use DataTables;
use App\Models\Product;
use Validator;
use Illuminate\Support\Facades\Hash;

class CategoryController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Category::all(['id','name','status','created_at']);
            
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('status', function ($row) {
                    return $row->status == 0 ? 'Active' : 'Inactive';
                })
                ->addColumn('created_at', function ($row) {
                    return $row->created_at->format('d-m-Y'); 
                })
                ->addColumn('action', function ($data) {
                    $edit_ = route('category.edit', $data->id);
                    $delete_ = route('category.destroy', $data->id);

                    $button = '<a href="' . $edit_ . '" name="edit" id="edit" class="edit btn btn-primary btn-sm"> <i class="bi bi-pencil-square"></i>Edit</a> &nbsp;&nbsp;';
                    $button .= '<a href="' . $delete_ . '" name="Delete" id="Delete" class="edit btn btn-danger btn-sm"> <i class="bi bi-pencil-square"></i>Delete</a>';
                    return $button;
                })
                ->make(true);
        }

        return view('category.index');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::distinct()->get();
        return view('category.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required',
        ]);

        $input = $request->all();

        Category::create($input);

        return redirect()->route('category.index')
            ->with('success', 'Category Created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $input = $request->all();

        // if($category->action = $request->action);   
        // return back()->with('message','Record Successfully Updated!');


        $category->update($input);

        return redirect()->route('category.index')
            ->with('success', ' Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();

        return redirect()->route('category.index')
            ->with('success', 'Detail deleted successfully');
    }
}