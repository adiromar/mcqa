										{{--  Front End Section  --}}
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<title>Apptitude Questions & Answers for your interview and Entrance Exam Preparations.</title>

	<link href="{{ asset('css/home.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrap/css/bootstrap.css') }}" rel="stylesheet">
    
</head>
<body>
	<div class="container">
		
		<a href="/"><img src="{{ asset('bix.gif') }}" class="img-responsive" width="150" height="70"></a>
	</div>
	<div class="container header-menu">
		<nav class="menu">
			{{-- <a href="#"><i class="fa fa-bars"></i></a> --}}

			@if(count($category) > 0)
            @foreach($category as $cat)
            @php
            	$cat_name = ucwords($cat->category_name);
            @endphp
			<a href="{{ url('cat/'.$cat->slug.'/'.$cat->id.'') }}" class="link_a">{{ $cat_name }}</a>

			@endforeach
			@endif

			@guest
    			<a href="{{ route('login') }}" class="float-right">Login</a>
   		 	@else
   		 		<a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="float-right"><i class="fa fa-key"></i> Log Out</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
				{{ csrf_field() }}
            	</form>
   		 	@endguest
		</nav>

		<div class="pagehead"><h6 class="">Welcome to NepalBIX.com !</h6></div>
		<div class="breadcrumb"><small>Here, you can read the aptitude questions and answers for your interview and entrance exams preparation.</small></div>
		 @yield('content')
	</div>

{{-- <footer>
	<div class="inner-footer">
		<div class="container-fluid footer-main">
			<a href="">Contact Us:</a><br>
		<a href="">Home</a>
		<a href="">Category</a>
		</div>
	</div>
	
</footer> --}}

	{{-- scripts --}}
	<script type="text/javascript" src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.0/css/all.css" integrity="sha384-Mmxa0mLqhmOeaE8vgOSbKacftZcsNYDjQzuCOm6D02luYSzBG8vpaOykv9lFQ51Y" crossorigin="anonymous">
</body>
</html>