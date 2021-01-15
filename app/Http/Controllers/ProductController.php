<?php

namespace App\Http\Controllers;

use App\Exceptions\NotFoundException;
use App\Helpers\APIHelpers;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
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

//        $filter = $request->query('filter');
//        if (!empty($filter)) {
//            $product = Product::orderBy('id', 'desc')->where('products.name', 'like', '%' . $filter . '%')->paginate(3);
//        } else {
//            $product = Product::orderBy('id', 'desc')->paginate(3);
//        }
        $product = Product::orderBy('id', 'desc')->get();
        return APIHelpers::success($product,200,'Get all');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {

        $category = Category::find($request->category_id);
//        if ($category == null) {
//            throw new NotFoundException('Danh muc không tồn tại',404);
//        }
        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->status = $request->status;
        if ($category->products()->save($product)) {
            return APIHelpers::success($product,201,"Product created successfully");
        } else {
            return APIHelpers::error(null,400,"Product created failed");
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
        return APIHelpers::success($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        //
        $product = Product::find($id);
        if (is_null($product)) {
            throw new NotFoundException();
        }
        $category = Category::find($request->category_id);
//        if ($category == null) {
//            throw new NotFoundException('Danh muc không tồn tại',404);
//        }
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->status = $request->status;
        if ($category->products()->save($product)) {
            return APIHelpers::success($product,200,"Product updated successfully");
        } else {
            return APIHelpers::error(null,400,"Product updated failed");
        }
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
        return APIHelpers::success(null,200,"Product successfully deleted");
    }
}
