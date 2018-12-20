@include('layouts/header')

        
        <div class="container-fluid shoes">
            <div class="row">
                <div class="col-md-1 col-xs-12 categories row">
                    @foreach($categories as $c)
                        <a class="col-md-12 col-xs-12 category" href="../categories/{{$c}}">{{$c}}</a>
                    @endforeach
                </div>
                <div class="col-md-10 col-xs-12 col-md-offset-1 shoesContainer row">

                    @foreach($shoes as $s)

                    <div class="col-md-2 col-xs-12 oneShoes text-center row">
                        <img class="col-md-12 col-xs-12" src={{'../img/pic'.$s->id.'.webp'}} alt="">
                        <p class="col-md-12 name h3 col-xs-12"> {{$s->name}} </p>
                        <p class="col-md-12 price h4 col-xs-12">{{$s->price}}$</p>

                        @if(1 == Auth::user()["admin"])

                        <a href="../edit/{{$s->id}}" class="col-md-6 col-xs-12 row">
                            <button class="col-md-12 button col-xs-12">edit</button>
                        </a>
                        <a href="../cart/add/{{$s->id}}" class="col-md-6 col-xs-12 row">
                            <button class="col-md-12 button col-xs-12">add</button>
                        </a>

                        @else

                            <a href="../cart/add/{{$s->id}}" class="col-md-12 col-xs-12 row">
                                <button class="button col-md-12 col-xs-12">add</button>
                            </a>

                        @endif

                    </div>

                    @endforeach

                </div>
            </div>
        </div>

@include('layouts/footer')