@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="{{route('members')}}">Retourner à la liste des membres</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                @include('messages.success')
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">

                <h2 class="text-center text-uppercase">Votre conversation avec <strong>{{$user_id_to->name}}</strong>
                </h2>

                <hr>
                <div class="conversation">
                    @foreach($conversations as $message)

                        @if($message->user_id_from == Auth::user()->id)
                            <div class="row" style="margin-top:20px;">
                                <div class="col-xs-7 col-xs-offset-5">
                                    <div class="col-xs-9" style="padding:0; word-wrap: break-word;">
                                        <div class="text-right">
                                            <span class="my-message">{{$message->content}}</span>
                                        </div>
                                    </div>
                                    <div class="col-xs-2" style="padding:0;">
                                        <img src="/uploads/profile_pictures/{{Auth::user()->picture}}"
                                             class="img-responsive img-circle center-block pull-right conversation-img">
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="row" style="margin-top:20px;">
                                <div class="col-xs-7">
                                    <div class="col-xs-2" style="padding:0;">
                                        <img src="/uploads/profile_pictures/{{$user_id_to->picture}}"
                                             class="img-responsive center-block img-circle conversation-img">
                                    </div>
                                    <div class="col-xs-9" style="padding:0; word-wrap:  break-word;">
                                        <span style="display:block;padding-top:10px; word-wrap:  break-word;">{{$message->content}}</span>
                                    </div>

                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

            </div>

        </div>

        <div class="row">

            <div class="col-md-6 col-md-offset-3">

                <form method="post" action="{{route('members.store', [$user_id_to->id,$id_conv])}}">
                    @include('messages.errors')
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="content">Qu'avez vous à dire {{Auth::user()->name}} ?</label>
                        <textarea name="content_msg" id="content_msg" cols="20" rows="4"
                                  class="form-control"></textarea>
                    </div>

                    <input type="submit" name="submit" class="btn btn-success pull-right">
                </form>

            </div>
        </div>

    </div>


@endsection