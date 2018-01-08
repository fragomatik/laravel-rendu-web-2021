@extends('layouts.app')

@section('content')
    @if(Auth::check())
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <h1 class="text-center text-uppercase">Interface <strong>personnelle</strong></h1>
                    <div class="col-md-4 col-md-offset-4">
                        <hr class="red-hr">
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel">
                        <div class="panel-body">

                            <div class="col-md-4">
                                <img src="/uploads/profile_pictures/{{ $user->picture }}"
                                     class="img-responsive center-block img-circle">
                            </div>

                            <div class="col-md-6">
                                <strong>Nom: </strong>{{Auth::user()->name}}<br>
                                <strong>E-mail: </strong>{{Auth::user()->email}}<br>
                                <strong>Date d'inscription: </strong>{{Auth::user()->created_at}}<br>
                                @if(Auth::user()->isAdmin == true)
                                    <strong>Rôle: </strong>Administrateur<br>
                                @else
                                    <strong>Rôle: </strong>Utilisateur<br>
                                @endif
                                <a href="{{ route('update-picture') }}" class="btn btn-danger btn-sm"
                                   style="margin-top:20px;">Modifier mon image</a>
                            </div>

                        </div>
                    </div>

                </div>

            </div>

            @if(count($articles))
                <div class="row">
                    <h2 class="text-center text-uppercase">Vos <strong>articles</strong></h2>
                    <hr>
                </div>
                <div class="row">
                    @forelse($articles as $article)

                        <div class="col-md-3" style="height: 250px;">
                            <div class="panel panel-default">
                                <div class="panel-heading"> {{$article->title}}</div>
                                <div class="panel-body">
                                    <p> {!! nl2br(e(str_limit($article->content, $limit = 200, $end = '...')))!!}</p>

                                    <a href="{{route('article.show', ['article'=>$article->id])}}" class="pull-right">Voir l'article</a>
                                </div>
                            </div>
                        </div>

                    @empty
                        @if(Auth::user()->isAdmin == true)
                            <h1 class="text-center"><strong>Aucun article</strong></h1>
                        @endif
                    @endforelse

                </div>
            @else
                <hr>
                <h1 class="text-center">Vous ne possédez aucun <strong>article</strong></h1>
            @endif
        </div>
    @endif
@endsection