@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                @include('messages.success')
            </div>
        </div>
        @include('administrateur.article')
        @include('administrateur.commentary')
    </div>

@endsection