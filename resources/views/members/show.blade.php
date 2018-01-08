@if($member->isAdmin == 1)
    <div class="panel panel-success panel-admin">
        <div class="panel-body">

            <div class="col-md-4">
                <img src="/uploads/profile_pictures/{{$member->picture}}"
                     class="img-responsive center-block member-admin">
            </div>
            <div class="col-md-8">
                <ul>
                    <li>Identifiant: n°{{$member->id}}</li>
                    <li>{{$member->name}}</li>
                    <li>{{$member->email}}</li>
                    <li>Rôle: <strong>Administrateur</strong></li>
                </ul>
            </div>

        </div>
        <div class="panel-footer">
            <a class="text-center center-block btn btn-success btn-sm text-uppercase"
                   href="{{route('members.conv',[$member->id])}}">Contacter</a>
        </div>
    </div>
@else
    <div class="panel panel-primary">
        <div class="panel-body">

            <div class="col-md-4">
                <img src="/uploads/profile_pictures/{{$member->picture}}"
                     class="img-responsive center-block member-user">
            </div>
            <div class="col-md-8">
                <ul>
                    <li>Identifiant: n°{{$member->id}}</li>
                    <li>{{$member->name}}</li>
                    <li>{{$member->email}}</li>
                    <li>Rôle: Utilisateur</li>
                </ul>
            </div>

        </div>
        <div class="panel-footer">
                <a class="text-center center-block btn btn-primary btn-sm text-uppercase"
                   href="{{route('members.conv',[$member->id])}}">Contacter</a>
        </div>
    </div>
@endif