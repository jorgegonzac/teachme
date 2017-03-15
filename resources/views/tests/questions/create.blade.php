@extends('layouts.app')

@section('header_styles')
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create a question for Test # {{ $test->id }}</div>
                <div class="panel-body">
					@include('notifications')

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('admin/tests') . '/' . $test->id . '/questions' }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                            <label for="content" class="col-md-4 control-label">Content</label>

                            <div class="col-md-6">
								<textarea class="form-control" rows="5" id="content" name="content" value="{{ old('content') }}" required autofocus></textarea>

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
