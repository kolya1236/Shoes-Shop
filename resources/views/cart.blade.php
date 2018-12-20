@include('layouts/header')

    <div class="container-fluid text-center">
        @foreach($items as $id => $value)
            <div class="row cartRow">
                <div class="col-md-2 h4 col-md-offset-2">{{$value["name"]}}</div>
                <div class="col-md-1 h4">Quantity: {{$value["quantity"]}}</div>
                <div class="col-md-1 h4">Price: {{(int)$value["price"]*(int)$value["quantity"]}}</div>
                <a href="../cart/decrement/{{$id}}" class="col-md-2 row">
                    <button class="button col-md-12">Drop one</button>
                </a>
                <a href="../cart/remove/{{$id}}" class="col-md-2 row">
                    <button class="button col-md-12">Remove all</button>
                </a>
            </div>
        @endforeach
        @if($quantity>0)
            <div class="row">
                <a href="../cart/buy" class="col-md-2 col-md-offset-5 row" onclick="ThanksForPurchaising()">
                    <button class="col-md-12 button">Purchase</button>
                </a>
            </div>
        @else
            <div class="row">
                <div class="col-md-12 text-center h1">Please put something in your cart</div>
            </div>
        @endif
    </div>
@include('layouts/footer')
