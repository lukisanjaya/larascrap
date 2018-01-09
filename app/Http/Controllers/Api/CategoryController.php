<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Category;

class CategoryController extends APIController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category, Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 8;

        if (!empty($keyword)) {
            $categories = Category::where('name', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $categories = Category::paginate($perPage);
        }
        return $this->sendResponse($categories->toArray(), 'Berhasil Menampilkan Category.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::with('articles')->find($id);

        if (is_null($category)) {
            return $this->sendError('Category Tidak Ditemukan.');
        }

        return $this->sendResponse($category->toArray(), 'Berhasil Menampilkan Category.');
    }
}
