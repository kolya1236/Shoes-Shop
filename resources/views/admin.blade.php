@include('layouts/header')
    <div class="container-fluid administration">

            <div class="row text-center user">
                <div class="col-md-1 h4 col-md-offset-2">User name</div>
                <div class="col-md-2 h4">Email fiels</div>
                <div class="col-md-2 h4">Is user admin?</div>
                <p class="col-md-2 h4 row">
                    Change user rights
                </p>
                <p class="col-md-2 h4 row">
                    Delete user
                </p>
            </div>


        @foreach($users as $u)
            <div class="row text-center user">
                <div class="col-md-1 col-md-offset-2">{{$u->name}}</div>
                <div class="col-md-2">{{$u->email}}</div>
                <div class="col-md-2">{{$u->admin}}</div>
                <a href="../admin/changeRights/{{$u->id}}/{{$u->admin}}" class="col-md-2 col-xs-12 row">
                    @if(0 == $u->admin)
                        <button class="col-md-12 button">Make admin</button>
                    @else
                        <button class="col-md-12 button">Make user</button>
                    @endif
                </a>
                <a href="../admin/delete/{{$u->id}}" class="col-md-2 col-xs-12 row">
                    <button class="col-md-12 button">Delete user</button>
                </a>
            </div>
        @endforeach
    </div>
@include('layouts/footer')