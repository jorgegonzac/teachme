@extends('layouts.app')

@section('header_styles')
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Test # {{$question->test->id}} - Question # {{$question->id}} - Answers </div>
                <div class="panel-body">
					<div class="row">
						<div class="col-md-6 pull-left">
							<a class="btn btn-small btn-info " href="{{ URL::to('admin/tests/' . $question->test->id . '/questions/' . $question->id . '/edit') }}">Go back</a>
						</div>
						<div class="col-md-6 ">
							<a class="btn btn-small btn-info pull-right" href="{{ URL::to('admin/tests/' . $question->test->id . '/questions/' . $question->id . '/answers/create') }}">Create Answer</a>
						</div>
					</div>

					@include('notifications')

					<table class="table">
						<thead>
							<tr>
								<th>#</th>
								<th>Content</th>
								<th>Valid?</th>
								<th class="hidden-xs">Created at</th>
								<th class="hidden-xs">Updated at</th>
								<th>Actions</th>
							</tr>
						</thead>

						<tbody>
						@foreach($question->answers as $answer)
						<tr>
							<td> {{ $answer->id }} </td>
							<td> {{ $answer->content }} </td>
							<td>
								@if($answer->is_valid)
								yes
								@else
								no
								@endif
							</td>
							<td class="hidden-xs"> {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $answer->created_at)->toDateString() }} </td>
							<td class="hidden-xs"> {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $answer->updated_at)->toDateString() }} </td>
							<td>
								<div class="row">
									<div class="col-md-4">
										<a class="btn btn-small btn-info" href="{{ URL::to('admin/tests/' . $question->test->id . '/questions/'. $question->id .'/answers/' . $answer->id) }}">Show</a>
									</div>
									<div class="col-md-4">
										<a class="btn btn-small btn-warning" href="{{ URL::to('admin/tests/' . $question->test->id . '/questions/'. $question->id .'/answers/' . $answer->id . '/edit') }}">Edit</a>
									</div>
									<div class="col-md-4">
										{!! Form::open(array('url' => URL::to('admin/tests/' . $question->test->id . '/questions/'. $question->id .'/answers/' . $answer->id), 'method' => 'delete', 'class' => 'form-horizontal')) !!}
										<div class="form-group">
				                                <button type="submit" class="btn btn-danger">
				                                    Destroy
				                                </button>
				                        </div>
										{!! Form::close() !!}
									</div>
								</div>



							</td>
						</tr>
						@endforeach
						</tbody>
					</table>
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
