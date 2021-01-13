<?php

namespace App\Http\Controllers;

use App\Exceptions\NotFoundException;
use App\Helpers\APIHelpers;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $filter = $request->query('filter');
        if (!empty($filter)){
            $product = Product::orderBy('id', 'desc')->where('products.name', 'like', '%'.$filter.'%')->paginate(3);
        }else{
            $product = Product::orderBy('id', 'desc')->paginate(3);
        }
        $response = APIHelpers::apiResponse(false,200,'get all ',$product);

        return response()->json($response,200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {

        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->status = $request->status;
        $product->save();
        if ($product->save()){
         $response = APIHelpers::apiResponse(false,201,'Product created successfully ',$product);
            return response()->json($response,200);
        }else{
            $response = APIHelpers::apiResponse(true,400,'Product created failed',null);
            return response()->json($response,400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $product = Product::find($id);
        if (is_null($product)) {
            throw new NotFoundException();
        }
        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $product = Product::find($id);
        if (is_null($product)) {
            throw new NotFoundException();
        }
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->status = $request->status;
        $product->save();
        if ($product->save()){
            $response = APIHelpers::apiResponse(false,200,'Product updated successfully',$product);
            return response()->json($response,200);
        }else{
            $response = APIHelpers::apiResponse(true,400,'Product updated failed',null);
            return response()->json($response,400);
        }
        return response()->json($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $product = Product::find($id);
        if (is_null($product)) {
            throw new NotFoundException();
        }
        $product->delete();
        return response()->json("Product successfully deleted");
    }
}
