@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-uppercase">Listes des <strong>membres</strong></h1>
                <br>
                @if(count($members)>0)
                    @foreach($members as $member)
                        <div class="col-md-5">
                            <div class="row">
                                @include('members.show')
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                    @endforeach
                @else
                    <h1 class="text-center">Aucun <strong>membre</strong></h1>
                @endif
            </div>
        </div>
    </div>

@endsection