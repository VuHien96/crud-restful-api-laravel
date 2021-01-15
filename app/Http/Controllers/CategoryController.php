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
//        $filter = $request->query('filter');
//        if (!empty($filter)) {
//            $categoires = Category::orderBy('id', 'desc')->where('categories.name', 'like', '%' . $filter . '%')->paginate(3);
//        } else {
//            $categoires = Category::orderBy('id', 'desc')->paginate(3);
//        }
//        $response = APIHelpers::apiResponse(false, 200, 'get all ', $categoires);

        $categoires = Category::orderBy('id', 'desc')->get();
        return APIHelpers::success($categoires,200,"Get ALL");



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

        if ($category->save()){
            return APIHelpers::success($category,201,"Category created successfully");
        }else{
            return APIHelpers::error(null,400,"Category created failed");
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

        return APIHelpers::success($category,200,"");

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
            return APIHelpers::success($category,200,"Category updated successfully");
        } else {
            return APIHelpers::error(null,400,"Category updated failed");
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
        return APIHelpers::success("",200,"Delete category success");
    }
}
