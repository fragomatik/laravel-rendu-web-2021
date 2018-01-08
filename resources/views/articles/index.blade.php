@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            @include('messages.success')
            @if(Session::has('error'))
                <div class="alert alert-danger"><strong>{{Session::get('error')}}</strong></div>
            @endif

        </div>
        <div class="row">
            @foreach($lastArticle as $last)

                <div class="col-md-10 col-md-offset-1">
                    <h1 class="text-uppercase">Article à la <strong>Une</strong></h1>
                    <div class="panel">

                        <div class="panel-body">
                            @if(!empty($last->picture))
                                <div class="col-md-3">
                                    <img src="/uploads/article_pictures/{{$last->picture}}"
                                         class="center-block img-responsive article-img-index">
                                </div>

                            @else

                                <div class="col-md-3">
                                    <img src="http://placehold.it/200x200" class="img-responsive center-block">
                                </div>
                            @endif
                            <div class="col-md-9">p
                                <h3><strong>{{$last->title}}</strong></h3>

                                <!-- Afficher un extrait de l'article en affichant les retours à la ligne -->
                                <p> {!!nl2br(e(str_limit($last->content, $limit = 200, $end = '...')))!!}</p>

                                <a href="{{route('article.show', ['article'=>$last->id])}}">Lire la suite</a><br>

                                <!-- Je vérifie s'il existe des likes pour cet article -->
                                @if(count($last->likes)>0)
                                    <p style="display:inline;">
                                        Mentions J'aime: <strong class="text-primary">{{count($last->likes)}}</strong>
                                    </p>

                                    <!-- Je vérifie s'il existe un like pour cet article réalisé par la personne connectée -->
                                    @if(count(Auth::user()->likes()->where('article_id', $last->id)->get()) > 0)

                                        <!-- Je boucle pour pouvoir récupérer ce like en particulier -->
                                        @foreach(Auth::user()->likes()->where('article_id', $last->id)->get() as $like)

                                            <form class="form-inline" method="post" action="{{route('like.destroy',['id' => $like->id])}}">

                                                <input type="hidden" name="_method" value="DELETE">
                                                {{csrf_field()}}
                                                <input type="hidden" name="article_id" value="{{$last->id}}">
                                                <input type="submit" name="submit" class="btn btn-danger btn-xs" value="Je n'aime plus">
                                            </form>

                                        @endforeach

                                    @else

                                        <!-- Si la personne connectée n'a pas liké, alors on affiche le bouton j'aime -->
                                        <form class="form-inline" method="post" action="{{route('like.store')}}">
                                            {{csrf_field()}}
                                            <input type="hidden" name="article_id" value="{{$last->id}}">
                                            <input type="submit" name="submit" class="btn btn-primary btn-xs"
                                                   value="J'aime">
                                        </form>

                                    @endif


                                @else

                                    <!-- Si aucun like n'est trouvé -->
                                    <p style="display:inline;">Aucune mention J'aime</p>
                                    <form class="form-inline" method="post" action="{{route('like.store')}}">
                                        {{csrf_field()}}
                                        <input type="hidden" name="article_id" value="{{$last->id}}">
                                        <input type="submit" name="submit" class="btn btn-primary btn-xs"
                                               value="J'aime">
                                    </form>

                                @endif
                            </div>

                        </div>
                        <div class="panel-footer">
                            Rédigé par: {{$last->user->name}}
                        </div>

                    </div>
                </div>

            @endforeach
        </div>

        @if(count($articles)>0)
            <div class="row">
                <h2 class="text-center text-uppercase ">Tous les <strong>articles</strong></h2>
            </div>
        @endif

        @if(Auth::user()->isAdmin == true)
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <a class="text-center center-block btn btn-primary btn-sm text-uppercase"
                       href="{{route('article.create')}}">Créer un article</a> <br>

                </div>
            </div>
        @endif

        <div class="row" style="margin-top:50px;">
            @forelse($articles as $article)
                @if($article->id != $last->id)

                    <div class="col-md-3" style="min-height: 260px; margin-bottom: 10px;">
                        <div class="panel panel-default">
                            <div class="panel-heading" style="height:65px;"> {{$article->title}}</div>
                            <div class="panel-body" style="height:450px;">
                                @if(!empty($article->picture))
                                    <img src="/uploads/article_pictures/{{$article->picture}}"
                                         class="center-block img-responsive article-img-index">
                                    <br>
                                @else
                                    <img src="http://placehold.it/200x200" class="img-responsive center-block">
                                    <br>
                                    @endif

                                    <!-- Afficher un extrait de l'article en affichant les retours à la ligne -->
                                    <p> {!! nl2br(e(str_limit($article->content, $limit = 200, $end = '...')))!!}</p>

                                    <a href="{{route('article.show', ['article'=>$article->id])}}" class="pull-right">Lire la suite</a>
                            </div>
                            <div class="panel-footer">
                                @if(count($article->likes)>0)

                                    <p style="display:inline;">
                                        Mentions J'aime: <strong class="text-primary">{{count($article->likes)}}</strong>
                                    </p>

                                    @if(count(Auth::user()->likes()->where('article_id', $article->id)->get()) > 0)
                                        @foreach(Auth::user()->likes()->where('article_id', $article->id)->get() as $like)
                                            <form class="pull-right form-inline"  method="post"
                                                  action="{{route('like.destroy',['id' => $like->id])}}">
                                                <input type="hidden" name="_method" value="DELETE">
                                                {{csrf_field()}}
                                                <input type="hidden" name="article_id" value="{{$article->id}}">
                                                <input type="submit" name="submit" class="btn btn-danger btn-xs"
                                                       value="Je n'aime plus">
                                            </form>
                                        @endforeach

                                    @else

                                        <form class="pull-right form-inline"  method="post" action="{{route('like.store')}}">
                                            {{csrf_field()}}
                                            <input type="hidden" name="article_id" value="{{$article->id}}">
                                            <input type="submit" name="submit" class="btn btn-primary btn-xs"
                                                   value="J'aime">
                                        </form>
                                    @endif


                                @else

                                    <p style="display:inline;">Aucune mention J'aime</p>
                                    <form class="pull-right form-inline"  method="post" action="{{route('like.store')}}">
                                        {{csrf_field()}}
                                        <input type="hidden" name="article_id" value="{{$article->id}}">
                                        <input type="submit" name="submit" class="btn btn-primary btn-xs"
                                               value="J'aime">
                                    </form>

                                @endif


                            </div>
                        </div>
                    </div>
                @endif
            @empty

                <h1 class="text-center"><strong>Aucun article</strong></h1>

            @endforelse


        </div>
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                {{$articles->links()}}
            </div>
        </div>
    </div>


@endsection