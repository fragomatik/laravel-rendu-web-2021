<div class="col-md-6">
    <h2 class="text-center text-uppercase">Tous les <strong>commentaires</strong></h2>
    <br>
    <div class="panel-group">
        @if(count($commentaries))
            <div class="panel admin-controls" style="padding-right: 25px;">
                <br>
                <ul>
                    @foreach($commentaries as $commentary)
                        <li><div class="text-justify">{{$commentary->content}} - Posté par <strong>{{$commentary->user->name}}</strong></div>
                            <form method="post"
                                  action="{{route('administrateur.destroy', ['com_id'=>$commentary->id])}}">
                                <input type="hidden" name="_method" value="DELETE">
                                {{csrf_field()}}
                                <input type="hidden" name="guess" value="commentary">
                                <input type="submit" name="submit" class="btn btn-danger btn-xs" value="Supprimer">
                            </form>
                        </li>
                        <br>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-6 col-md-offset-3">{{ $commentaries->links() }}</div>
        @else
            <h3 class="text-center"><strong>Aucun commentaire</strong></h3>
        @endif
    </div>
</div>