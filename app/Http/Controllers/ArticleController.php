<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Article;

class ArticleController extends Controller
{
    protected $perPage = 3;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::orderByDesc('id')->paginate($this->perPage);
        // $articles = Article::orderByDesc('id')->simplePaginate($this->perPage);
        $data = [
            'title'=>'Liste des articles - '.config('app.name'),
            'description'=>'Retrouvez ici tous les articles '.config('app.name'),
            'articles'=>$articles
        ];
        return view('article.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return "formulaire de création";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // sauvegarde nouvel article
    }

    /**
     * Display the specified resource.
     *
     * @param  Article->id (par défaut) 
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        $data = [
            'title'=>$article->title.' - '.config('app.name'),
            'description'=>$article->title.'. '.Str::words($article->content, 10),
            'article'=>$article
        ];
        return view('article.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // user authentifié et peut éditer l'article via un formulaire
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
        // mise à jour de l'article en database
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // uniquement par l'auteur 
    }

    /**
     * Set the value of perPage
     *
     * @return  self
     */ 
    public function setPerPage($perPage)
    {
        $this->perPage = $perPage;

        return $this;
    }
}
