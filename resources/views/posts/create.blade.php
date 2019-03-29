@extends('layouts.app')

@section('content')

<div class="container">
	{{-- <div class="row mt-4"> --}}
		<div class="col-md-12 mt-4 mb-5">

		<div class="card">
			<form action="{{ action('PostsController@store') }}" method="post">
				<input name="_token" type="hidden" value="{{ csrf_token() }}"/>

				<div class="card-header">Create Posts</div>
				<div class="col-md-4 mt-4">
					<label>Category: </label>
						<select class="form-control" name="category_name" id="cat_name">
							<option value="">Select</option>
							@if(count($category) > 0)
								@foreach($category as $cat)
									<option value="{{  $cat->category_name }}" data-id="{{ $cat->id}}">{{ $cat->category_name }}</option>

								@endforeach
							@endif
						</select>
				</div>

				<select style="display: none;" name="category_id"><option id="append_id"></option></select>

				<div class="col-md-12 mt-4">
					<label>Question: </label>
					{{-- <input type="text" name="post" class="form-control"> --}}
					<textarea name="question" rows="4" cols="120"></textarea>
				</div>

				<div class="row mt-4 pl-4 pr-4">
				<div class="col-md-6">
					<label>Option A: </label>
					<input type="text" name="option_a" class="form-control">
				</div>

				<div class="col-md-6">
					<label>Option B: </label>
					<input type="text" name="option_b" class="form-control">
				</div>
				</div>

				<div class="row mt-4 pl-4 pr-4">
					<div class="col-md-6">
					<label>Option C: </label>
					<input type="text" name="option_c" class="form-control">
				</div>

				<div class="col-md-6">
					<label>Option D: </label>
					<input type="text" name="option_d" class="form-control">
				</div>
				</div>

				<div class="row mt-4 mb-4 pl-4 pr-4">
				<div class="col-md-6">
					<label>Correct Option: </label>
					<select class="form-control" name="correct_option">
						<option value="option_a">Option A</option>
						<option value="option_b">Option B</option>
						<option value="option_c">Option C</option>
						<option value="option_d">Option D</option>
						<option value="all">All of the above</option>
						<option value="none">None of the above</option>
					</select>
				</div>
				</div>

				<input type="submit" name="go" value="Submit" class="btm btn-primary ml-4 mb-4">
			</form>

		</div>

		</div>
	{{-- </div> --}}
</div>

 <script src="http://code.jquery.com/jquery-3.3.1.slim.min.js"
  integrity="sha256-3edrmyuQ0w65f8gfBsqowzjJe2iM6n0nKciPUp8y+7E="
  crossorigin="anonymous"></script>
<script type="text/javascript">
$(document).ready( function(){

  $('#cat_name').on('change', function (e){
    e.preventDefault(); // Stop posting to the server
    // var selectedOptions = $('select[data="id"] option:selected'); 
    var selectedOptions = $(this).find(':selected').attr('data-id')
    // alert(selectedOptions);
    $('#append_id').text(selectedOptions);
    
    // $('form').submit();
  });

});
</script>

@endsection