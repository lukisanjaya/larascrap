<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Article;

class ArticleController extends APIController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Article $article, Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 8;

        if (!empty($keyword)) {
            $articles = Article::with('categories')
                ->where('title', 'LIKE', "%$keyword%")
                ->orWhere('content', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $articles = Article::with('categories')
                ->paginate($perPage);
        }
        return $this->sendResponse($articles->toArray(), 'Berhasil Menampilkan Artikel.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::with('categories')->find($id);

        if (is_null($article)) {
            return $this->sendError('Artikel Tidak Ditemukan.');
        }

        return $this->sendResponse($article->toArray(), 'Berhasil Menampilkan Artikel.');
    }
}
