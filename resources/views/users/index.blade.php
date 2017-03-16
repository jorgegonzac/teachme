@extends('layouts.admin')

@section('header_styles')
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Registered Users</div>
                <div class="panel-body">
					<a class="btn btn-small btn-info pull-right" href="{{ URL::to('admin/users/invitations/create') }}">Send invitation</a>
					@include('notifications')

					<table class="table">
						<thead>
							<tr>
								<th>#</th>
								<th class="hidden-xs">First Name</th>
								<th class="hidden-xs">Last Name</th>
								<th>Email</th>
								<th>Source</th>
								<th class="hidden-xs">Created at</th>
								<th class="hidden-xs">Course progress</th>
								<th>Actions</th>
							</tr>
						</thead>

						<tbody>
						@foreach($users as $user)
						<tr>
							<td> {{ $user->id }} </td>
							<td class="hidden-xs"> {{ $user->first_name }} </td>
							<td class="hidden-xs"> {{ $user->last_name }} </td>
							<td> {{ $user->email }} </td>
							<td> {{ $user->source }} </td>
							<td class="hidden-xs"> {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $user->created_at)->toDateString() }} </td>
							<td class="hidden-xs"> {{ ($user->lessons()->count()/$totalLessons) * 100 }}% </td>
							<td>
								<div class="row">
									<div class="col-md-6">
										<a class="btn btn-small btn-info" href="{{ URL::to('admin/users/' . $user->id) }}">Show</a>
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
