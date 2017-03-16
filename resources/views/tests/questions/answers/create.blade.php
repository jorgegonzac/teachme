@extends('layouts.admin')

@section('header_styles')
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create an answer for Question # {{ $question->id }}</div>
                <div class="panel-body">
					<a class="btn btn-small btn-info " href="{{ URL::to('admin/tests/' . $question->test->id . '/questions/' . $question->id . '/answers') }}">Go back</a>
					@include('notifications')

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('admin/tests/' . $question->test->id . '/questions/' . $question->id . '/answers') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                            <label for="content" class="col-md-4 control-label">Content</label>

                            <div class="col-md-6">
								<textarea class="form-control" rows="5" id="content" name="content" required autofocus>{{ old('content') }}</textarea>

                                @if ($errors->has('content'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

						<div class="form-group{{ $errors->has('is_valid') ? ' has-error' : '' }}">
                            <label for="content" class="col-md-4 control-label">Is this answer correct?</label>

                            <div class="col-md-6">
								<input class="form-control text-center" type="checkbox" name="is_valid" id="is_valid" value="true">

                                @if ($errors->has('is_valid'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('is_valid') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Create
                                </button>
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
