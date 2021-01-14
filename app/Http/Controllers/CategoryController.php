<?php

namespace App\Http\Controllers;

use App\Exceptions\NotFoundException;
use App\Helpers\APIHelpers;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
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
        if (!empty($filter)) {
            $categoires = Category::orderBy('id', 'desc')->where('categories.name', 'like', '%' . $filter . '%')->paginate(3);
        } else {
            $categoires = Category::orderBy('id', 'desc')->paginate(3);
        }
        $response = APIHelpers::apiResponse(false, 200, 'get all ', $categoires);

        return response()->json($response, 200);


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;

        if ($category->save()) {
            $response = APIHelpers::apiResponse(false, 201, 'Category created successfully', $category);
            return response($response, 200);
        } else {
            $response = APIHelpers::apiResponse(true, 400, 'Category created failed', null);
            return response($response, 400);
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
        $category = Category::find($id);
        if (is_null($category)) {
            throw new NotFoundException("Category not found");
        }

        return response()->json($category);

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
        $category = Category::find($id);
        if (is_null($category)) {
            throw new NotFoundException("Category not found");
        }
        $category->name = $request->name;
        $category->description = $request->description;

        if ($category->save()) {
            $response = APIHelpers::apiResponse(false, 200, 'Category updated successfully', $category);
            return response($response, 200);
        } else {
            $response = APIHelpers::apiResponse(true, 200, 'Category updated failed', null);
            return response($response, 200);
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
        $category = Category::find($id);
        if (is_null($category)) {
            throw new NotFoundException("Category not found", 404);
        }
        $category->delete();
        return response("Delete category success");
    }
}
