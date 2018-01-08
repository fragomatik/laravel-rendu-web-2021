<div class="col-md-6">
    <h2 class="text-center text-uppercase">Tous les <strong>articles</strong></h2>
    <br>
    <div class="panel-group">
        @if(count($articles))
            <div class="panel admin-controls">
                <br>
                <ul>
                    @foreach($articles as $article)
                        <li>@if(!empty($article->picture))
                                <img src="/uploads/article_pictures/{{$article->picture}}"
                                     style="width: 70px; height: 50px; display: inline;" class="img-responsive">
                            @else
                                <img src="http://placehold.it/200x200"
                                     style="width: 70px; height: 50px; display: inline;" class="img-responsive">
                            @endif
                            <strong>Article {{$article->id}}</strong> : {{$article->title}}

                            <form method="post"
                                  action="{{route('administrateur.destroy', ['article_id'=>$article->id])}}">
                                <input type="hidden" name="_method" value="DELETE">
                                {{csrf_field()}}
                                <input type="hidden" name="guess" value="article">
                                <input type="submit" name="submit" class="btn btn-danger btn-xs"
                                       value="Supprimer">
                            </form>
                        </li>
                        <br>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-6 col-md-offset-4">{{ $articles->links() }}</div>
        @else
            <h3 class="text-center"><strong>Aucun article</strong></h3>
        @endif
    </div>
</div>