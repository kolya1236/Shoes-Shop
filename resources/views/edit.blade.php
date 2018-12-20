@include('layouts/header')
@foreach($single_shoes as $shoes)
    <form method="POST" action="{{asset('edit')}}" class="container admin_panel" enctype="multipart/form-data">	
    	

    	{{-- GENERATE TOKEN AND METHOD --}}
    	<input type="hidden" name="_method" value="PUT">
    	<input type="hidden" name="_token" value="{{ csrf_token() }}">
		@foreach($shoes as $key=>$value)

			@if($key != "id" and $key != "price")
			{{-- GENERATE USUAL FIELDS --}}

			<div class="row">
				<label class="col-md-2 h4 row_name" for="{{$key}}">{{$key}}</label>
				<input class="col-md-10" id="{{$key}}" type="text" name="{{$key}}" value="{{$value}}">
			</div>

			@elseif($key=="price")
				{{-- GENERATE PRICE FIELD --}}
				{{-- MAKE IN ANOTHER FIELD BECAUSE
				INPUT TYPE IS NUMBER --}}
			<div class="row">
				<label class="col-md-2 h4 row_name" for="{{$key}}">{{$key}}</label>
				<input class="col-md-10" id="{{$key}}" type="number" name="{{$key}}" value="{{$value}}">
			</div>
			@elseif($key == "id")
				{{-- GENERATE ID FIELD --}}

				<input type="hidden" name="{{$key}}" value="{{$value}}">

			@endif
		@endforeach
		<div class="row">
			{{-- GENERATE IMG UPLOAD FIELD AND BUTTON --}}
			<label class="col-md-2 h4 row_name" for="img">IMAGE</label>
			<input class="col-md-10 loadImg" accept="image/webp" id="img" type="file" name="img">

			<button class="col-md-offset-5 button col-md-2">Submit</button>
		</div>
	</form>

@endforeach

@include('layouts/footer')