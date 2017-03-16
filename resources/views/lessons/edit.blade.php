@extends('layouts.app')

@section('header_styles')
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Lesson # {{ $lesson->id }}</div>
                <div class="panel-body">
					<a class="btn btn-small btn-info " href="{{ URL::to('admin/lessons') }}">Go back</a>
					@include('notifications')

					{!! Form::model($lesson, array('url' => URL::to('admin/lessons') . '/' . $lesson->id, 'method' => 'put', 'class' => 'form-horizontal')) !!}
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

						<div class="form-group{{ $errors->has('content_url') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">Video URL</label>

                            <div class="col-md-6">
								{!! Form::text('content_url', null, array('class' => 'form-control', 'placeholder'=>'content_url', 'required' => 'required' )) !!}

                                @if ($errors->has('content_url'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('content_url') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

						<div class="form-group{{ $errors->has('start_date') ? ' has-error' : '' }}">
                            <label for="start_date" class="col-md-4 control-label">Start Date</label>

                            <div class="col-md-6">
								{!! Form::text('start_date', null, array('class' => 'form-control', 'placeholder'=>'start_date', 'required' => 'required' )) !!}

                                @if ($errors->has('start_date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('start_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

						<div class="form-group{{ $errors->has('end_date') ? ' has-error' : '' }}">
                            <label for="end_date" class="col-md-4 control-label">End Date</label>

                            <div class="col-md-6">
								{!! Form::text('end_date', null, array('class' => 'form-control', 'placeholder'=>'end_date', 'required' => 'required')) !!}

                                @if ($errors->has('end_date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('end_date') }}</strong>
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
