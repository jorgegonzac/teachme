@extends('layouts.app')

@section('header_styles')
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Test # {{$test->id}} - Question #{{ $question->id }}</div>
                <div class="panel-body">
					@include('notifications')

					{!! Form::model($question, array('url' => URL::to('admin/tests') . '/' . $test->id . '/questions/' . $question->id, 'method' => 'put', 'class' => 'form-horizontal')) !!}

						<div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
							<label for="content" class="col-md-4 control-label">Title</label>

							<div class="col-md-6">
								{!! Form::textarea('content', null, array('class' => 'form-control', 'placeholder'=>'content', 'required' => 'required' )) !!}

								@if ($errors->has('content'))
									<span class="help-block">
										<strong>{{ $errors->first('content') }}</strong>
									</span>
								@endif
							</div>
						</div>


						<div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                            </div>
                        </div>
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('footer_scripts')
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script>
	$(function() {
	  $( "#start_date" ).datepicker();
	  $( "#end_date" ).datepicker();
	});
</script>
@endsection
