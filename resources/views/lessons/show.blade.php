@extends('layouts.app')

@section('header_styles')
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Lesson #{{ $lesson->id }}</div>
                <div class="panel-body">
					<a class="btn btn-small btn-info " href="{{ URL::to('admin/lessons') }}">Go back</a>
					@include('notifications')
					<form class="form-horizontal" role="form">
                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-4 control-label">Title</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" value="{{ $lesson->title }}" disabled>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">Description</label>

                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control" name="description" value="{{ $lesson->description }}" disabled>
                            </div>
                        </div>

						<div class="form-group{{ $errors->has('content_url') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">Video URL</label>

                            <div class="col-md-6">
                                <input id="content_url" type="text" class="form-control" name="content_url" value="{{ $lesson->content_url }}" disabled>
                            </div>
                        </div>

						<div class="form-group{{ $errors->has('start_date') ? ' has-error' : '' }}">
                            <label for="start_date" class="col-md-4 control-label">Start Date</label>

                            <div class="col-md-6">
                                <input id="start_date" type="text" class="form-control" name="start_date" value="{{ $lesson->start_date }}" disabled>
                            </div>
                        </div>

						<div class="form-group{{ $errors->has('end_date') ? ' has-error' : '' }}">
                            <label for="end_date" class="col-md-4 control-label">End Date</label>

                            <div class="col-md-6">
                                <input id="end_date" type="text" class="form-control" name="end_date" value="{{ $lesson->end_date }}" disabled>
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
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script>
	$(function() {
	  $( "#start_date" ).datepicker();
	  $( "#end_date" ).datepicker();
	});
</script>
@endsection
