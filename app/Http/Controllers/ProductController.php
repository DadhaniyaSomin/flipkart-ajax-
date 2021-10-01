<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\Products;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use file;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = [];
        $category = category::select('id', 'c_name')->get();
        if ($request->ajax()) {
            $data = Products::get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    if (Auth::user()->role_id == 2) {
                        if (Auth::user()->id == $row->user_id) {
                            $btn = '<div class="form-group">
                            <button type="button" class="btn btn-success product_edit" data-toggle="modal" data-target="#update_modal" data-id="' . $row->id . '" ><i class="fa fa-edit"></i></button>
                            <button type="button" class="btn btn-danger product_delete" data-toggle="modal" data-target="#modalConfirmDelete" data-id="' . $row->id . '" ><i class="fa fa-trash"></i></button></div>';
                            return $btn;
                        }
                    } elseif (Auth::user()->role_id == 1) {
                        $btn = '<div class="form-group">
                        <button type="button" class="btn btn-success product_edit" data-toggle="modal" data-target="#update_modal" data-id="' . $row->id . '" ><i class="fa fa-edit"></i></button>
                            <button type="button" class="btn btn-danger product_delete" data-toggle="modal" data-target="#modalConfirmDelete" data-id="' . $row->id . '"><i class="fa fa-trash"></i></button></div>';
                        return $btn;
                    }
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('products.index', compact('products', 'category'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products1 = category::select('id', 'c_name')->get();

        return view('products.create', compact('products1'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        if ($request->has('image')) {
            // dd($request->has('image'));
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = "image";
            $dd = $file->move(public_path($path), $filename);
        }

        //  // form submit karie ne ama problem 6e 
        // if ($request->hasFile('image')) {

        //     $image = $request->file('image');

        //     $name = time().rand(1, 99999) . "." . $image->getClientOriginalExtension();
        //     $image->public_path('image/', $name);
        //     // dd($image);
        // }

        $products = new Products();
        $products->name = $request->name;
        $products->description = $request->des;
        $products->price = $request->price;
        $products->image = isset($filename) ? $filename : "";

        $products->created_by = Auth::user()->role_id;
        $products->user_id = Auth::user()->id;
        // dd($products);

        $save = $products->save();
        $products1 =  $request->category;
        $products->category()->attach($products1);
        if ($save) {
            return redirect()->route('products.index');
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $category = category::find($id)->products;
        // return view('products.index', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        // $data = products::with('category')->whereId($id)->first();
        // if (isset($data)) {
        //     if (Auth::user()->id == $data->user_id || Auth::user()->role_id == 1) {
        //         $category = category::all();

        //         // dd($category,$products1);
        //         //dd($category);
;
        //         $products = Products::find($id);
        //         return view('products.edit', compact('products', 'category'));
        //     } else {
        //         return redirect()->route('products.index');
        //     }
        // } else {
        //     return redirect()->route('products.index');
        // }
              
        $data = products::where('id',$id)->first();
        //  dd($data);
        return response()->json($data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        // $request->validate([
        //     'name' => 'required|max:s20',
        //     'description' => 'required|max:255',
        //     'price' => 'required|numeric',

        // ]);


        $products = Products::find($id);
        $products->name = $request->name;
        $products->description = $request->description;
        $products->price = $request->price;
        // $products->image = isset($name) ? $name : "";
        //$products->category =  implode(',', $request->category);
        // $products->user_role = $request->user_role;
        //   dd($products);
        $products->update();

        $products1 =  $request->category;
        $products->category()->sync($products1);

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        Products::whereId($id)->delete();
        return  redirect()->route('products.index');
    }
}
