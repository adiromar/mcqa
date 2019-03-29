@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row">

		<div class="col-md-12 mt-4">
			<div class="card">
        		<div class="card-header">Category</div>
        		<div class="row">
					<div class="card-body col-md-6">
						<a href="create" class="btn btn-success ml-4">+ Add New Category</a>
					</div>

					<div style="border-left: 3px solid lightgrey;height: 95px;"></div>

					<div class="col-md-5 float-right">
						<form method='post' action='/uploadCategory' enctype='multipart/form-data' >
       					{{ csrf_field() }}
						<label class="col-md-12">Upload Category (CSV Format): </label>
						<input type="file" name="file" class="btn btn-light">
						<input type="submit" name="upload" value="Upload" class="btn btn-primary ml-2">
						</form>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-12 mt-4">
			<div class="card">
        		<div class="card-header"><h4>View Category</h4></div>
					<table class="table table-bordered table-responsive table-striped">
						<thead class="thead-dark">
							<tr>
								<th>S.N</th>
								<th>Category Name</th>
								<th>Created Date</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php $i=1; ?>
							@if(count($category) > 0)
							@foreach($category as $cat)
								<tr>
									<td>{{ $i }}</td>
									<td>{{ $cat->category_name }}</td>
									<td>{{ $cat->created_at }}</td>
									<td>
										<form method="POST" class="float-right" action="{{ action('CategoryController@destroy', $cat->id) }}">
											{{ csrf_field() }}
											{{ method_field('delete') }}
										<input type="submit" value="Delete" class="btn btn-danger">
										</form>
									</td>
								</tr>

								<?php $i++; ?>
								@endforeach
							
								{{ $category->links()}}
							@else
								<tr><td colspan="3">No Categories Found</td></tr>
							@endif
						</tbody>
					</table>
			</div>
		</div>
	</div>
	

</div>

@endsection