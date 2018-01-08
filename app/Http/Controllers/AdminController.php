<?php

namespace App\Http\Controllers;

use App\Article;
use App\Commentary;
use App\Like;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Afficher une pagination pour les articles et les commentaires
        $articles = Article::orderBy('id', 'DESC')->paginate(5, ['*'], 'articles');
        $commentaries = Commentary::orderBy('id', 'DESC')->paginate(5, ['*'], 'commentaries');
        return view('administrateur.index', ['articles' => $articles, 'commentaries' => $commentaries]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $type = $request->input('guess');
        if ($type == 'commentary') {
            $commentary = Commentary::find($id);
            $commentary->delete();
            return redirect()->route('administrateur.index')->with('success',"Le commentaire a bien été supprimé");
            
        } else {
            Like::where('article_id', $id)->delete();
            Commentary::where('article_id', $id)->delete();
            $article = Article::find($id);
            $article->delete();
            return redirect()->route('administrateur.index')->with('success',"L'article ses commentaires et ses likes ont bien été supprimés");
        }
    }
}
