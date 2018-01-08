<?php
namespace App\Http\Controllers;
use App\Article;
use App\Commentary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class CommentaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $commentaries = Commentary::orderBy('id', 'ASC')->where('article_id', $id)->paginate(8);
        return view('article.show', ['article' => $id, 'commentaries' => $commentaries]);
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
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $this->validate($request,
            [
                'content' => 'required'
            ],
            [
                'content.required' => 'Votre commentaire ne doit pas être vide'
            ]);
     
        Commentary::create([
            'user_id' => Auth::user()->id,
            'article_id' => $id,
            //Ne tenez pas compte de "l'erreur"
            'content' => $request->content,
        ]);
        return redirect()->route('article.show', $id);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
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
     * @param $article_id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $article_id)
    {
        $input = $request->input();
        $commentary = Commentary::find($id);
        $commentary->fill($input)->save();
        return redirect()->route('article.show', $article_id);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param $com_id
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function destroy(Request $request, $com_id)
    {
        $article_id = $request->article_id;
        $commentary = Commentary::find($com_id);
        $commentary->delete();
        return redirect()->route('article.show', $article_id);
    }
}