@extends('layouts.app')

@section('header_styles')
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Test # {{ $test->id }}</div>
                <div class="panel-body">
					<a class="btn btn-small btn-info " href="{{ URL::to('admin/tests') }}">Go back</a>

					@include('notifications')

					{!! Form::model($test, array('url' => URL::to('admin/tests') . '/' . $test->id, 'method' => 'put', 'class' => 'form-horizontal')) !!}
						<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
							<label for="title" class="col-md-4 control-label">Title</label>

							<div class="col-md-6">
								{!! Form::text('title', null, array('class' => 'form-control', 'placeholder'=>'title', 'required' => 'required' )) !!}

								@if ($errors->has('title'))
									<span class="help-block">
										<strong>{{ $errors->first('title') }}</strong>
									</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">Description</label>

                            <div class="col-md-6">
								{!! Form::text('description', null, array('class' => 'form-control', 'placeholder'=>'description', 'required' => 'required' )) !!}

                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

						<div class="form-group{{ $errors->has('lesson_id') ? ' has-error' : '' }}">
							<label for="lesson_id" class="col-md-4 control-label">Select a lesson</label>

							<div class="col-md-6">
								<select class="form-control" id="lesson_id" name="lesson_id">
									<option value=""> Select a lesson</option>
								  @foreach($lessons as $lesson)
								  	@if($test->lesson_id === $lesson->id)
										<option value="{{$lesson->id}}" selected>{{$lesson->id}} . {{$lesson->title}}</option>
									@else
										<option value="{{$lesson->id}}">{{$lesson->id}} . {{$lesson->title}}</option>
									@endif

								  @endforeach

								</select>

								@if ($errors->has('lesson_id'))
									<span class="help-block">
										<strong>{{ $errors->first('lesson_id') }}</strong>
									</span>
								@endif

							</div>
						</div>

						<div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
								<a class="btn btn-small btn-info " href="{{ URL::to('admin/tests/' . $test->id . '/questions') }}">Edit Questions</a>
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
