@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="col-md-8 col-md-offset-2">

            <h1 class="text-center text-uppercase text-primary">Modification de l'article n°{{$article->id}}</h1>

            <form enctype="multipart/form-data" method="post" action="{{route('article.update', ['article'=>$article->id])}}">
                <input type="hidden" name="_method" value="put">
                {{csrf_field()}}
                @include('messages.errors')
                <div class="form-group">
                    <label for="title">Titre:</label>
                    <input type="text" name="title" class="form-control" value="{{$article->title}}">
                </div>

                <div class="form-group">
                    <label for="contentu">Contenu:</label>
                    <textarea name="content" id="content" cols="30" rows="10" class="form-control">{{$article->content}}</textarea>
                </div>

                <input type="file" name="picture" class="form-control"><br>

                <input type="submit" name="submit" class="btn btn-success pull-right">
            </form>
        </div>
    </div>

@endsection