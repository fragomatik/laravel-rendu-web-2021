@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center text-uppercase">Modification <strong>de votre profil</strong></h1><br>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="col-md-4">
                    <img src="/uploads/profile_pictures/{{ $user->picture }}" class="img-responsive img-circle center-block"><br>
                    <p class="text-danger text-uppercase text-center">Image actuelle</p>
                </div>
                <div class="col-md-6">
                    <form enctype="multipart/form-data" action="/profile/update-picture" method="post">
                        {{csrf_field()}}
                        <input type="file" name="picture" class="form-control"><br>
                        <input type="submit" class="pull-right btn btn-sm btn-primary">
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection