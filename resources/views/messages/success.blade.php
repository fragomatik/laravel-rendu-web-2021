@if(Session::has('success'))
    <div class="alert alert-success"><strong>Félicitation! {{Session::get('success')}}</strong></div>
@endif
@if(Session::has('successUpdate'))
    <div class="alert alert-info"><strong>Félicitation! {{Session::get('successUpdate')}}</strong></div>
@endif
@if(Session::has('successDestroy'))
    <div class="alert alert-warning"><strong>Félicitation! {{Session::get('successDestroy')}}</strong></div>
@endif