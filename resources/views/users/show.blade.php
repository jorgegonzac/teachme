@extends('layouts.admin')

@section('header_styles')
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">User #{{ $user->id }}</div>
                <div class="panel-body">
					<a class="btn btn-small btn-info " href="{{ URL::to('admin/users') }}">Go back</a>
					@include('notifications')

					<form class="form-horizontal" role="form">

						<!-- // starts profile pic -->
						<div class="form-group{{ $errors->has('profile_img') ? ' has-error' : '' }}">
							<label for="profile_img" class="col-md-4 control-label">Profile Img</label>
							<div class="col-md-6">

								@if(empty($user->profile_img))
								<a href="/img/avatar.png" class="thumbnail" target="_blank">
									<img src="/img/avatar.png" alt="profile_pic" height="70" width="60">
								</a>
								@else
								<a href="{{ asset(Storage::disk('public')->url($user->profile_img)) }}" class="thumbnail" target="_blank">
									<img src="{{ asset(Storage::disk('public')->url($user->profile_img)) }}" alt="profile_pic" height="300" width="300">
								</a>
								@endif

							</div>
						</div>
						<!-- // end profile pic -->

                        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                            <label for="first_name" class="col-md-4 control-label">First Name</label>

                            <div class="col-md-6">
                                <input id="first_name" type="text" class="form-control" name="first_name" value="{{ $user->first_name }}" disabled>
                            </div>
                        </div>

						<div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
							<label for="last_name" class="col-md-4 control-label">Last Name</label>

							<div class="col-md-6">
								<input id="last_name" type="text" class="form-control" name="last_name" value="{{ $user->last_name }}" disabled>
							</div>
						</div>

						<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
							<label for="email" class="col-md-4 control-label">Email</label>

							<div class="col-md-6">
								<input id="email" type="text" class="form-control" name="email" value="{{ $user->email }}" disabled>
							</div>
						</div>

						<div class="form-group{{ $errors->has('source') ? ' has-error' : '' }}">
							<label for="source" class="col-md-4 control-label">Source</label>

							<div class="col-md-6">
								<input id="source" type="text" class="form-control" name="source" value="{{ $user->source }}" disabled>
							</div>
						</div>

						<div class="form-group{{ $errors->has('created_at') ? ' has-error' : '' }}">
							<label for="created_at" class="col-md-4 control-label">Created at</label>

							<div class="col-md-6">
								<input id="created_at" type="text" class="form-control" name="created_at" value="{{ $user->created_at }}" disabled>
							</div>
						</div>

						<div class="form-group{{ $errors->has('updated_at') ? ' has-error' : '' }}">
							<label for="updated_at" class="col-md-4 control-label">Last update</label>

							<div class="col-md-6">
								<input id="updated_at" type="text" class="form-control" name="updated_at" value="{{ $user->updated_at }}" disabled>
							</div>
						</div>

						<div class="form-group ">
							<label class="col-md-4 control-label">Course Progress</label>
							<div class="progress  col-md-6">
								<div class="progress-bar" role="progressbar" aria-valuenow="{{$takenLessons}}" aria-valuemin="0" aria-valuemax="{{$totalLessons}}" style="width:{{$progressPercentage}}%;">
  								{{$progressPercentage}}%
  							  </div>
							</div>
						</div>

						<div class="form-group{{ $errors->has('lessons') ? ' has-error' : '' }}">
							<label for="lessons" class="col-md-4 control-label">Lessons score</label>

							<div class="col-md-6">

								<table class="table">
									<thead>
										<tr>
											<th>Lesson #</th>
											<th>Score</th>
										</tr>
									</thead>

									<tbody>
										@foreach($user->lessons()->withTrashed()->get() as $lesson)
										<tr>
											<td> {{ $lesson->id }} </td>
											<td> {{ $lesson->pivot->score }} </td>
										</tr>
									@endforeach
									</tbody>
								</table>


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
