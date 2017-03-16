@extends('layouts.user')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Test  - {{$test->title}}</div>
				<div class="panel-body">

					<!-- Notifications -->
			        @include('notifications')

					<!-- test information -->

					<blockquote class="blockquote-reverse">
					  <p>{{$test->description}}</p>
					  <footer> - The MOOC admin</footer>
					</blockquote>

					<hr>
					<!-- // test information -->

					<form class="form-horizontal" role="form" method="POST" action="{{ url('lesson/' . $test->lesson->id . '/tests/' . $test->id) }}">
                        {{ csrf_field() }}

						@foreach($test->questions as $key=>$question)
							<div class="col-md-12">
								<div class="form-group">
										<label for="question{{$question->id}}" class="control-label">Question #{{$key+1}} </label>
		                                <textarea class="form-control" name="question{{$question->id}}" disabled> {{$question->content}} </textarea>
		                        </div>

								@foreach($question->answers as $k=>$answer)
								<div class="col-md-3">
									<input type="checkbox" name="questions[{{$question->id}}][]" id="answer_{{$answer->id}}" value="{{$answer->id}}"> {{$answer->content}}</input>
								</div>
								@endforeach
							</div>

							<hr>
						@endforeach

						<div class="form-group{{ $errors->has('questions') ? ' has-error' : '' }} text-center">
							<div class="col-md-12">
								@if ($errors->has('questions'))
									<span class="help-block">
										<strong>{{ $errors->first('questions') }}</strong>
									</span>
								@endif
							</div>
						</div>

						<div class="form-group">
                            <div class="col-md-12 text-center">


                                <button type="submit" class="btn btn-primary">
                                    Grade
                                </button>
								<a class="btn btn-small btn-warning pull-right" href="{{ URL::to('home') }}">Go back</a>
                            </div>
                        </div>
					</form>
				</div>

            </div>
        </div>
    </div>
</div>
@endsection

@section('footer_scripts')

<script>
	// the selector will match all input controls of type :checkbox
	// and attach a click event handler
	$("input:checkbox").on('click', function() {
	  // in the handler, 'this' refers to the box clicked on
	  var $box = $(this);
	  if ($box.is(":checked")) {
	    // the name of the box is retrieved using the .attr() method
	    // as it is assumed and expected to be immutable
	    var group = "input:checkbox[name='" + $box.attr("name") + "']";
	    // the checked state of the group/box on the other hand will change
	    // and the current value is retrieved using .prop() method
	    $(group).prop("checked", false);
	    $box.prop("checked", true);
	  } else {
	    $box.prop("checked", false);
	  }
	});
</script>
@endsection
