<?php

namespace App\Http\Controllers;

use App\Article;
use App\Commentary;
use App\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;

class ArticleController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lastArticle = Article::orderBy('id','DESC')->take(1)->get();
        $articles = Article::orderBy('id', 'DESC')->paginate(8);
        return view('articles.index', ['articles' => $articles,'lastArticle'=>$lastArticle]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request,
            [
                'title' => 'required',
                'content' => 'required',
                'picture' => 'required',
            ],
            [
                'title.required' => 'Vous devez donner un titre',
                'content.required' => 'Votre article ne doit pas être vide',
                'picture.required' => 'Votre article doit contenir une image',
            ]);


        //On recupere le fichier
        $articlePicture = $request->file('picture');

        //On isole l'extension original du fichier
        $extension = Input::file('picture')->getClientOriginalExtension();

        //On prepare le futur nom du fichier
        $filename = rand(1111111, 9999999) . '.' . $extension;

        //On resize l'image et la stock dans un dossier
        Image::make($articlePicture)->save(public_path('/uploads/article_pictures/' . $filename));


        //Instancier un Article
        $article = new Article;

        //Récupérer tous les champs de request
        $input = $request->input();

        //Ajouter le user_id avec l'id du user actif
        $input['user_id'] = Auth::user()->id;
        $input['picture'] = $filename;

        //Tout le contenu de $article est envoyé en BDD
        $article->fill($input)->save();

        return redirect('article')->with('success', 'Votre article a bien été enregistré');

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function show($id)
    {
        $otherArticles= Article::where('id', '!=', $id)->take(20)->get();
        $article = Article::find($id);
        return view('articles.show', ['article' => $article,'others'=>$otherArticles]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function edit($id)
    {
        $article = Article::find($id);
        return view('articles.edit', ['article' => $article]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function update(Request $request, $id)
    {


        $this->validate($request,
            [
                'title' => 'required',
                'content' => 'required'
            ],
            [
                'title.required' => 'Vous devez modifier un titre',
                'content.required' => 'Vous devez modifier le contenu'
            ]);

        if ($request->hasFile('picture')) {

            $article = Article::find($id);
            if(!empty($article->picture)){
                $currentPicture = $article->picture;
                $file_path = public_path() . '/uploads/article_pictures/' . $currentPicture;
                unlink($file_path);
            }
            //On recupere le fichier
            $articlePicture = $request->file('picture');

            //On isole l'extension original du fichier
            $extension = Input::file('picture')->getClientOriginalExtension();

            //On prepare le futur nom du fichier
            $filename = rand(1111111, 9999999) . '.' . $extension;

            //On resize l'image et la stock dans un dossier
            Image::make($articlePicture)->resize(300, 300)->save(public_path('/uploads/article_pictures/' . $filename));

            $input = $request->input();
            $input['picture'] = $filename;

            $article->fill($input)->save();

        } else {
            $input = $request->input();
            $article = Article::find($id);
            $article->fill($input)->save();
        }


        return redirect('article')->with('successUpdate', 'Votre article a bien été modifié !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function destroy($id)
    {
        Like::where('article_id', $id)->delete();
        Commentary::where('article_id', $id)->delete();
        $article = Article::find($id);
        if(!empty($article->picture)){
            $currentPicture = $article->picture;
            $file_path = public_path() . '/uploads/article_pictures/' . $currentPicture;
            unlink($file_path);
        }
        $article->delete();


        return redirect('article')->with('successDestroy', 'Votre article a bien été détruit');
    }
}
