@extends('layouts.main')

@section('content')
    <div class="col-md-12">
        

        <div class="row box_wrap">
            <h4 class="cat-title col-md-12">Categories</h4>
            @if(count($category) > 0)
            @foreach($category as $cat)

            <div class="col-md-3 ml-4 mt-2">
                {{-- <h4 class="cat-title">Categories</h4> --}}
                <div class="box-shade">
                    <p>
                        @php

                        $cat_name = ucwords($cat->category_name);
                        @endphp
                         <a href="cat/{{ $cat->slug }}/{{ $cat->id }}" ><i class="fas fa-chevron-right"></i> {{ $cat_name }}</a>
                    </p>
                </div>
            </div>
            
            @endforeach
            @else
                <p>No Categories Found</p>
            @endif

        </div>
    </div>


@endsection


