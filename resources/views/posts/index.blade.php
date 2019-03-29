@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row">

	@if(Session::has('message'))
        <p >{{ Session::get('message') }}</p>
     @endif

		<div class="col-md-12 mt-4">
			<div class="card">
        		<div class="card-header">Posts</div>
        		<div class="row">
					<div class="card-body col-md-5">
						<a href="create" class="btn btn-success">+ Add New Post</a>
					</div>

					<div style="border-left: 3px solid lightgrey;height: 95px;"></div>

					<div class="col-md-5 float-right">
						<form method='post' action='/uploadFile' enctype='multipart/form-data' >
       					{{ csrf_field() }}
						<label class="col-md-12">Upload Questions (CSV): </label>
						<input type="file" name="file" class="btn btn-light" required>
						<input type="submit" name="submit" value="Import" class="btn btn-primary ml-2">
						</form>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-12 mt-4">
			<div class="card">
        		<div class="card-header"><h4>View Your Posts</h4></div>
					<table class="table table-bordered table-responsive table-striped">
						<thead class="thead-dark">
							<tr>
								<th>S.N</th>
								<th>Post Name</th>
								<th>Category Name</th>
								<th>All Options</th>
								<th>Correct Option</th>
								<th>Created Date</th>
								<th>Edit</th>
								<th>Delete</th>
							</tr>
						</thead>
						<tbody>
							<?php $i=1; ?>
							@if(count($posts) > 0)
							@foreach($posts as $cat)
								<tr>
									<td>{{ $i }}</td>
									<td>{{ $cat->post_name }}</td>
									<td>{{ $cat->category_name }}</td>
									<td>A. {{ $cat->option_a }}<br>
										B. {{ $cat->option_b }}<br>
										C. {{ $cat->option_c }}<br>
										D. {{ $cat->option_d }}
									</td>
									<td>{{ $cat->correct_option }}</td>
									<td>{{ $cat->created_at }}</td>
									<td><a href="/posts/{{ $cat->id }}/edit" class="btn btn-primary">Edit</a></td>
									<td>
										<form method="POST" class="float-right" action="{{ action('PostsController@destroy', $cat->id) }}">
									{{ csrf_field() }}
									{{ method_field('delete') }}
										<input type="submit" value="Delete" class="btn btn-danger">
									</form>
									</td>
								</tr>

								<?php $i++; ?>
								@endforeach
							
								{{ $posts->links()}}
							@else
								<tr><td colspan="5">No Posts Found</td></tr>
							@endif
						</tbody>
					</table>
			</div>
		</div>
	</div>
	

</div>

@endsection