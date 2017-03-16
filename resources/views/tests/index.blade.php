@extends('layouts.admin')

@section('header_styles')
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Tests</div>
                <div class="panel-body">
					<div class="row">
						<div class="col-md-6 pull-left">
							<a class="btn btn-small btn-info " href="{{ URL::to('admin') }}">Go back</a>
						</div>
						<div class="col-md-6 ">
							<a class="btn btn-small btn-info pull-right" href="{{ URL::to('admin/tests/create') }}">Create Test</a>
						</div>
					</div>
					@include('notifications')

					<table class="table">
						<thead>
							<tr>
								<th>#</th>
								<th>Title</th>
								<th class="hidden-xs">Linked lesson</th>
								<th>Created at</th>
								<th>Updated at</th>
								<th class="text-center">Actions</th>
							</tr>
						</thead>

						<tbody>
						@foreach($tests as $test)
						<tr>
							<td> {{ $test->id }} </td>
							<td> {{ $test->title }} </td>
							<td class="hidden-xs"> {{ $test->lesson->id }} . {{ $test->lesson->title }} </td>
							<td> {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $test->created_at)->toDateString() }} </td>
							<td> {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $test->updated_at)->toDateString() }} </td>
							<td>
								<div class="row">
									<div class="col-md-4">
										<a class="btn btn-small btn-info" href="{{ URL::to('admin/tests/' . $test->id) }}">Show</a>
									</div>
									<div class="col-md-4">
										<a class="btn btn-small btn-warning" href="{{ URL::to('admin/tests/' . $test->id . '/edit') }}">Edit</a>
									</div>
									<div class="col-md-4">
										{!! Form::open(array('url' => URL::to('admin/tests') . '/' . $test->id, 'method' => 'delete', 'class' => 'form-horizontal')) !!}
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
