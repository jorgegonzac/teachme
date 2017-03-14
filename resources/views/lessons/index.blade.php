@extends('layouts.app')

@section('header_styles')
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Lessons</div>
                <div class="panel-body">
					@include('notifications')

					<table class="table">
						<thead>
							<tr>
								<th>#</th>
								<th>Title</th>
								<th class="hidden-xs">Content Link</th>
								<th>Start Date</th>
								<th>End Date</th>
								<th>Actions</th>
							</tr>
						</thead>

						<tbody>
						@foreach($lessons as $lesson)
						<tr>
							<td> {{ $lesson->id }} </td>
							<td> {{ $lesson->title }} </td>
							<td class="hidden-xs"> <a href="{{ $lesson->content_url }}" target="_blank"> video </a> </td>
							<td> {{ \Carbon\Carbon::createFromFormat('Y-m-d h:i:s', $lesson->start_date)->toDateString() }} </td>
							<td> {{ \Carbon\Carbon::createFromFormat('Y-m-d h:i:s', $lesson->end_date)->toDateString() }} </td>
							<td>
								<div class="row">
									<div class="col-md-6">
										<a class="btn btn-small btn-info" href="{{ URL::to('admin/lessons/' . $lesson->id . '/edit') }}">Edit</a>
									</div>
									<div class="col-md-6">
										{!! Form::open(array('url' => URL::to('admin/lessons') . '/' . $lesson->id, 'method' => 'delete', 'class' => 'form-horizontal')) !!}
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
