<?php

namespace App\Http\Controllers;

use App\Models\Product;  // Cambiado a singular
use App\Models\Departament;
use DB;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::select('products.*', 'departments.name as department')
            ->join('departments', 'departments.id', '=', 'products.department_id')
            ->paginate(10);
        return response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'name'=> 'required|string|min:1|max:100',
            'marca'=> 'required|string|min:1|max:100',
            'precio'=> 'required|string|min:1|max:100',
            'department_id'=> 'required|numeric',
        ];
        $validator = \Validator::make($request->input(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status'=> false,
                'errors'=> $validator->errors()->all()
            ], 400);
        }

        $product = new Product($request->input());
        $product->save();
        return response()->json([
            'status'=> true,
            'message'=> 'Product created successfully'
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)  // Cambiado a singular
    {
        return response()->json(['status'=> true, 'data'=> $product]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)  // Cambiado a singular
    {
        $rules = [
            'name'=> 'required|string|min:1|max:100',
            'marca'=> 'required|string|min:1|max:100',
            'precio'=> 'required|string|min:1|max:100',
            'department_id'=> 'required|numeric',
        ];
        $validator = \Validator::make($request->input(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status'=> false,
                'errors'=> $validator->errors()->all()
            ], 400);
        }

        $product->update($request->input());
        return response()->json([
            'status'=> true,
            'message'=> 'Product updated successfully'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)  // Cambiado a singular
    {
        $product->delete();
        return response()->json([
            'status'=> true,
            'message'=> 'Product deleted successfully'
        ], 200);
    }

    /**
     * Get products by department.
     */
    public function ProductsByDepartment()
    {
        $products = Product::select(DB::raw('count(products.id) as count, departments.name'))
            ->rightJoin('departments', 'departments.id', '=', 'products.department_id')
            ->groupBy('departments.name')->get();
        return response()->json($products);
    }

    /**
     * Get all products.
     */
    public function all()
    {
        $products = Product::select('products.*', 'departments.name as department')
            ->join('departments', 'departments.id', '=', 'products.department_id')
            ->get();
        return response()->json($products);
    }
}
