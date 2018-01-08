@extends('layouts.app')


@section('content')
    <div class="container">

        <div class="row">

            <div class="col-md-8">
                <div class="row">
                    <div class="heading-article">
                        <h2 class="text-center text-uppercase"><strong>{{$article->title}}</strong></h2>
                        <p class="text-center">
                            <img src="/uploads/profile_pictures/{{$article->user->picture}}"
                                 class="img-responsive img-circle writer-img">
                            <strong> {{$article->user->name}} | Le {{$article->created_at}}</strong>
                        </p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="panel">

                            <div class="panel-body">
                                @if(!empty($article->picture))
                                    <img src="/uploads/article_pictures/{{$article->picture}}"
                                         class="center-block img-responsive" style="max-height:300px;">

                                @else

                                    <img src="http://placehold.it/500x200" class="img-responsive center-block"
                                         style="margin:20px auto;">
                                @endif
                                <?php $currentUrl = Request::url();?>

                                <p class="article-content">{!! nl2br(e($article->content)) !!}</p>
                            </div>

                            <div class="center-block text-center">
                                <p>Partagez sur les réseaux sociaux:
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{$currentUrl}}"
                                       class="social-links">

                                        <i class="fa fa-facebook-official fa-2x facebook"></i>
                                    </a>

                                    <a href="https://twitter.com/intent/tweet/?url={{$currentUrl}}&text={{$article->title}}"
                                       class="social-links">

                                        <i class="fa fa-twitter fa-2x twitter"></i>
                                    </a>

                                    <a href="https://plus.google.com/share?url={{$currentUrl}}&hl={{$article->title}}"
                                       class="social-links">

                                        <i class="fa fa-google-plus fa-2x google-plus"></i>
                                    </a>

                                    <a href="https://pinterest.com/pin/create/button/?url={{$currentUrl}}&description={{$article->title}}"
                                       class="social-links">

                                        <i class="fa fa-pinterest fa-2x pinterest"></i>
                                    </a>
                                </p>
                            </div>

                            <div class="panel-footer">
                                Rédigé par <strong>{{$article->user->name}}</strong><br>

                                <!-- Je vérifie s'il existe des likes pour cet article -->
                                @if(count($article->likes)>0)

                                    <p style="display:inline;">Mentions J'aime: <strong
                                                class="text-primary">{{count($article->likes)}}</strong></p>

                                    <!-- Je vérifie s'il existe un like pour cet article réalisé par la personne connectée -->
                                    @if(count(Auth::user()->likes()->where('article_id', $article->id)->get()) > 0)

                                            <!-- Je boucle pour pouvoir récupérer ce like en particulier -->
                                        @foreach(Auth::user()->likes()->where('article_id', $article->id)->get() as $like)

                                            <form class="pull-right form-inline" method="post" action="{{route('like.destroy',['id' => $like->id])}}">

                                                <input type="hidden" name="_method" value="DELETE">
                                                {{csrf_field()}}

                                                <input type="hidden" name="article_id" value="{{$article->id}}">

                                                <input type="submit" name="submit" class="btn btn-danger btn-xs" value="Je n'aime plus">
                                            </form>
                                        @endforeach

                                    @else
                                    <!-- Si la personne connectée n'a pas liké, alors on affiche le bouton j'aime -->
                                        <form class="pull-right form-inline" method="post" action="{{route('like.store')}}">
                                            {{csrf_field()}}
                                            <input type="hidden" name="article_id" value="{{$article->id}}">
                                            <input type="submit" name="submit" class="btn btn-primary btn-xs" value="J'aime">
                                        </form>

                                    @endif


                                @else
                                    <!-- Si aucun like n'est trouvé -->
                                    <p style="display:inline;">Aucune mention J'aime</p>
                                    <form class="pull-right form-inline" method="post" action="{{route('like.store')}}">
                                        {{csrf_field()}}

                                        <input type="hidden" name="article_id" value="{{$article->id}}">

                                        <input type="submit" name="submit" class="btn btn-primary btn-xs" value="J'aime">
                                    </form>

                                @endif

                            </div>
                        </div>
                    </div>


                </div>
            </div>

            <div class="col-md-4">

                <div class="panel">
                    <div class="panel-heading text-uppercase">
                        Quelques articles similaires
                    </div>

                    <div class="panel-body">

                        @foreach($others as $other)
                            <a href="{{route('article.show', ['article'=>$other->id])}}">{{$other->title}}</a>
                            <hr style="margin: 5px 0;">
                        @endforeach

                    </div>
                </div>

            </div>
        </div>


        @if(Auth::user()->isAdmin == true)
            <div class="row">
                <div class="col-md-5 col-md-offset-2">

                    <div class="col-md-5">
                        <a class="text-center center-block btn btn-primary btn-sm text-uppercase"
                           href="{{route('article.edit', ['article'=>$article->id])}}">Modifier</a> <br>
                    </div>
                    <div class="col-md-5">

                        <form method="post" action="{{route('article.destroy',['id'=>$article->id])}}"
                              class="pull-right">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="submit" class="btn btn-danger btn-sm text-uppercase"
                                   value="Supprimer cet article">
                        </form>
                    </div>
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @if(count($article->commentaries)>0)
                    <h3 class="text-uppercase text-center">Tous les commentaires</h3>
                    <hr>
                    <div class="comments-block">
                        @foreach($article->commentaries as $commentary)
                            <div class="individual-comment">

                                <span class="header-comment">
                                    <strong>
                                        Posté par: {{$commentary->user->name}} |
                                        Le: {{$commentary->created_at}} |
                                        Modifié le: {{$commentary->updated_at}}
                                    </strong>
                                </span>

                                <p>{{$commentary->content}}</p>

                                @if(Auth::user()->name == $commentary->user->name)
                                    <button class="btn btn-primary btn-xs update-comment form-button-inline">Modifier</button>

                                    <form class="update-comment-form" style="display:none;" method="post" action="{{route('commentary.update', ['com_id'=>$commentary->id,'article_id'=>$article->id])}}">

                                        <input type="hidden" name="_method" value="put">
                                        {{csrf_field()}}

                                        <div class="form-group">
                                            <label for="content">Contenu:</label>
                                            <textarea name="content" id="content" cols="6" rows="3" class="form-control">{{$commentary->content}}</textarea>
                                        </div>

                                        <input type="submit" name="submit" class="btn btn-success btn-xs pull-right" value="Valider les modifications">
                                    </form>

                                    <form class="form-button-inline" method="post" action="{{route('commentary.destroy', ['com_id'=>$commentary->id])}}">

                                        <input type="hidden" name="_method" value="DELETE">
                                        {{csrf_field()}}

                                        <input type="hidden" name="article_id" value="{{$article->id}}">

                                        <input type="submit" name="submit" class="btn btn-danger btn-xs" value="Supprimer">
                                    </form>

                                @endif

                                <hr>
                            </div>
                        @endforeach
                    </div>

                @else

                    <h3 class="text-uppercase text-center">Aucun commentaire</h3>
                    <hr>
                @endif
            </div>
        </div>

        <div class="row">

            <div class="col-md-8 col-md-offset-2">

                <form method="post" action="{{route('commentary.store', $article->id)}}">

                    @include('messages.errors')
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="content">Qu'avez vous à dire {{Auth::user()->name}} ?</label>
                        <textarea name="content" id="content" cols="20" rows="4" class="form-control"></textarea>
                    </div>

                    <input type="submit" name="submit" class="btn btn-success pull-right">
                </form>

            </div>

        </div>
    </div>

@endsection