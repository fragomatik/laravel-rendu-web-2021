@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-uppercase">N'hésitez plus, <strong>contactez-nous !</strong></h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <form method="post" action="{{route('contact.store')}}">
                    {{csrf_field()}}
                    @include('messages.success')
                    @include('messages.errors')
                    <div class="form-group">
                        <label for="name">Nom:</label>
                        <input type="text" name="name" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" name="email" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="object">Objet:</label>
                        <input type="text" name="object" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="contentu">Contenu:</label>
                        <textarea name="content" id="content" rows="4" class="form-control"></textarea>
                    </div>


                    <input type="submit" name="submit" class="btn btn-success pull-right">
                </form>
            </div>
        </div>
    </div>

@endsection