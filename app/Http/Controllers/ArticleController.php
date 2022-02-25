<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

use App\Models\{
    Article,
    Category
};

use App\Http\Requests\ArticleRequest;

class ArticleController extends Controller
{
    protected $articlePerPage = 3;

    public function __construct()
    {
        /*
        *   on utilise le middleware 'auth' => App\Http\Middleware\Authenticatye.php,
        *   pour filtrer l'accès des utilisateurs à la bdd.
        *   En effet seul un membre connecté pourra créer, modifier ou supprimer un article.
        *   ici en paramètre, on spécifie avec 'except' que seules les méthodes 'index' et 'show'
        *   sont accessibles sans que auth = true, cad sans connexion utilisateur.
        */
        $this->middleware('auth')->except('index','show');        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::orderByDesc('id')->paginate($this->articlePerPage);
        // $articles = Article::orderByDesc('id')->simplePaginate($this->articlePerPage);

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
        $categories = Category::get();
        
        $data = [
            'title'         => $description = 'Ajouter un nouvel article',
            'description'   => $description,
            'categories'    => $categories
        ];
        return view('article.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        
        $validateData = $request->validated();
        
        // category_id doit être récupéré car non défini en REQUIRED dans ArticleRequest->rules
        $validateData['category_id'] = request('category', null);

        // Auth::id() renvoie l'id de l'utilisateur connecté qui crée l'article
        Auth::user()->articles()->create($validateData);

        $success = 'Article ajouté';
        
        return back()->withSuccess($success);
    }

    // public function store(Request $request)
    // {
        /*
        // METHODE 1 classique
        //
        // ici la méthode classique et basique pour créer un article
        // le pb est qu'un utilisateur malveillant peut insérer via la consolde de debug js 
        // des champs supplémentaires et planter le système
        //
        request()->validate(
            [
                'title'     => ['required', 'max:20', 'unique:articles,title'],
                'content'   => ['required'],
                'category'  => ['sometimes', 'nullable', 'exists:categories,id']
            ],
            [
                 // option on peut adapter le vocabulaire de base dans la 2ème partie de tableau
                 'title.required'   => 'Tu as oublié le titre pfff',
                 'title.max'        => 'nan trop long ton titre',
                 'content.required' => 'si c\'est pour mettre un post vide c nul'
              ]
        );

        // Après validation on instancie le nouvel article
        $article = new Article; 
        // Auth::id() renvoie l'utilisateur connecté  
        $article->user_id       = Auth::id();
        $article->category_id   = request('category', null);
        $article->title         = request('title');
        $article->slug          = Str::slug($article->title);
        $article->content       = request('content');
        $article->save();
        //
        */

        /*
        |
        | METHODE 2 MASS ASSIGNEMENT et FILLABLE
        |
        */
        
        // $article = Article::create(
        //     [
        //         'user_id'       => auth()->id(),
        //         'title'         => request('title'),
        //         'slug'          => Str::slug(request('title')),
        //         'content'       => request('content'),
        //         'category_id'   => request('category', null),
        //     ]
        // );
        // $article->save();

        /*
        |
        | METHODE 3 MASS ASSIGNEMENT et GUARDED
        |
        */
        // $article = Auth::user()->articles()->create(request()->validate(
        //     [
        //         'title'     => ['required', 'max:20', 'unique:articles,title'],
        //         'content'   => ['required'],
        //         'category'  => ['sometimes', 'nullable', 'exists:categories,id']
        //     ]
        // ));
        // $article->category_id = request('category', null);
        // $article->save();

        // $success = 'Article ajouté';
        // return back()->withSuccess($success);
    // }

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
    public function edit(Article $article)
    {
        // seul un user authentifié peut éditer un article
        // mais en plus il doit en être le créateur!
        // donc on vérifie avec abort_if si c'est bien le cas
        // si ce n'est pas le cas une page erruer 403 est générée
        abort_if(auth()->id() != $article->user_id, 403);

        $data = [
            'title'=> $description = 'Mise à jour de '.$article->title,
            'description'=>$description,
            'article'=>$article,
            'categories'=>Category::get()
        ];
        return view('article.edit', $data);   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, Article $article)
    {
        abort_if(auth()->id() != $article->user_id, 403);

        // category_id doit être récupéré car non défini en REQUIRED dans ArticleRequest->rules
        $validateData = $request->validated();
        $validateData['category_id'] = request('category', null);

        // Auth::id() renvoie l'id de l'utilisateur connecté qui crée l'article
        
        Auth::user()->articles()->updateOrCreate(['id'=>$article->id], $validateData);

        $success = 'Votre article a bien été modifié !';
        return redirect()->route('articles.edit',['article'=>$article->slug])->withSuccess($success);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        abort_if(auth()->id() != $article->user_id, 403);
        
        $article->delete();

        $success = 'Votre article a bien été supprimé !';
        return back()->withSuccess($success);
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
