@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="col-md-6 col-md-offset-3">

            <h1 class="text-center text-uppercase text-primary">Ajout d'un article</h1>

            <form enctype="multipart/form-data" method="post" action="{{route('article.store')}}">
                {{csrf_field()}}
                @include('messages.errors')
                <div class="form-group">
                    <label for="title">Titre:</label>
                    <input type="text" name="title" class="form-control">
                </div>

                <div class="form-group">
                    <label for="contentu">Contenu:</label>
                    <textarea name="content" id="content" cols="30" rows="10" class="form-control"></textarea>
                </div>

                <input type="file" name="picture" class="form-control"><br>

                <input type="submit" name="submit" class="btn btn-success pull-right">
            </form>
        </div>
    </div>

@endsection