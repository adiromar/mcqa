<?php

?>
@extends('layouts.main')

@yield('styles')
<style media="screen" type="text/css">
    .corr_ans{color: green;font-weight: 700;}
    .wro_ans{color: red;font-weight: 700;}
    .v-color{
        color: #9f9797  !important;
        opacity: 0.8;
        /*background-color: lightgrey !important;*/
    }
    .v-color a{
        color: red !important;
        background-color: lightgrey !important;
    }
    .tru_color{
        color: black !important;
        background-color: lightgreen !important;
    }
</style>

@section('content')
    <div class="col-md-12">
        

        <div class="row mt-5">
        @if(count($postss) > 0)
        @php
            $cat_name = ucwords($postss[0]->category_name);
        @endphp
            <h4 class="col-md-12">{{ $cat_name }}</h4>

    <?php $k=1;$ii=1; ?>
	@foreach($postss as $pos)
            <div class="col-md-12 post_div{{ $ii}}" style="padding: 15px;background: #e9ecef;margin-bottom: 12px;">
            	<label><?= $k . '. ' ?> {{ $pos->post_name }}</label>
            	<p><a data-id="option_a" data-value="{{ $pos->option_a }}" data-correct="{{ $pos->correct_option  }}" id="{{ $k }}" href="javascript:void()" class="option_color options_clk">A. {{ $pos->option_a}}</a></p>
            	<p><a data-id="option_b" data-value="{{ $pos->option_b }}" data-correct="{{ $pos->correct_option  }}" id="{{ $k }}" href="javascript:void()" class="option_color options_clk">B. {{ $pos->option_b}}</a></p>
                <p><a data-id="option_c" data-value="{{ $pos->option_c }}" data-correct="{{ $pos->correct_option  }}" id="{{ $k }}" href="javascript:void()" class="option_color options_clk">C. {{ $pos->option_c}}</a></p>
                <p><a data-id="option_d" data-value="{{ $pos->option_d }}" data-correct="{{ $pos->correct_option  }}" id="{{ $k }}" href="javascript:void()" class="option_color options_clk">D. {{ $pos->option_d}}</a></p>

                {{-- <p class="correct_val" style="display: none;">{{ $pos->correct_option }}</p> --}}
            	<p class="show_correct{{ $k }}" style="display: none;"><i class="fa fa-check-circle" style="color: green;"></i></p>
                {{-- <p class="wrong{{ $k }}" style="display: none;"><i class="fa fa-times-circle" style="color: red;"></i></p> --}}
                
                <div class="collapse" id="collapseExample{{ $k }}">
                    <div class="card card-body">
                        <?php $cor_value = str_replace('_', ' ', $pos->correct_option); 
                              $cor_value = ucwords($cor_value);
                        ?>
                        <p><span class="corr_ans">Answer: </span>{{ $cor_value }}</p>

                    </div>
                </div>
                <a class="" data-toggle="collapse" href="#collapseExample{{ $k }}" role="button" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-book"></i> View Answer</a></p>
            </div>
<?php $k++;$ii++; ?>
    @endforeach

        @else
            <h4>No Questions to Show</h4>
        @endif

        </div>
    </div>

<script src="http://code.jquery.com/jquery-3.3.1.slim.min.js"
  integrity="sha256-3edrmyuQ0w65f8gfBsqowzjJe2iM6n0nKciPUp8y+7E="
  crossorigin="anonymous"></script>
<script type="text/javascript">
    $(document).ready( function(){

  $('.options_clk').on('click', function (e){
    e.preventDefault(); 
    // var selectedOptions = $('select[data="id"] option:selected'); 
    // var selectedOptions = $(this).find(':selected');
    var id = $(this).attr('id')
    var options = $(this).data('id');
    var correct = $(this).data('correct');
    // alert(id);
    if (options == correct){
        $(this).addClass('tru_color');
        $('.show_correct'+id+'').show();
        // $('.wrong'+id+'').hide();
        $(this).removeClass('option_color');
    }else{
        // alert("incorrect");
        // document.getElementByClassName.style.backgroundColor = "transparent";
        // document.getElementsByClassName('wrong'+id+'').style.color = "red";
        // $(this).css('background-color', 'red');
         $(this).addClass('v-color');
         $(this).removeClass('option_color');
        $('.show_correct'+id+'').hide();
        // $('.wrong'+id+'').show();
    }
    
    
    console.log(correct);
  });

});
</script>
@endsection


