@extends('layouts.user')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Profile</div>

				<!-- Notifications -->
		        @include('notifications')

				<!-- starts submit form -->
				<form class="form-horizontal" role="form" method="POST" action="{{ url('profile') }}" enctype="multipart/form-data">
					{{ csrf_field() }}

	                <div class="panel-body">
						<!-- // starts main row -->
						<div class="row">
							<div class="col-lg-6 col-md-6 text-center">
								<div class="form-group {{ $errors->first('profile_img', 'has-error') }}">

									<!-- // starts profile pic -->
									@if(empty($user->profile_img))
									<a href="/img/avatar.png" class="thumbnail" target="_blank">
									  	<img src="/img/avatar.png" alt="profile_pic" height="300" width="300">
									</a>
									@else
									<a href="{{ asset(Storage::disk('public')->url($user->profile_img)) }}" class="thumbnail" target="_blank">
									  	<img src="{{ asset(Storage::disk('public')->url($user->profile_img)) }}" alt="profile_pic" height="300" width="300">
									</a>
									@endif
									<!-- // end profile pic -->

									<label class="control-label">Upload image</label>
									<input id="profile_img" name="profile_img" type="file" class="file">
								</div>
								<span class="help-block">{{ $errors->first('profile_img', ':message') }}</span>
							</div>
							<div class="col-lg-6 col-md-6 text-center">
								<div class="col-lg-12 col-md-12 text-center">
									<div class="form-group {{ $errors->first('first_name', 'has-error') }}">
										<label>First Name</label>
										<input id="first_name" type="text" value="{!! old('first_name') ? old('first_name') :  $user->first_name !!}" name="first_name" class="form-control" >
									</div>
									<span class="help-block">{{ $errors->first('first_name', ':message') }}</span>
								</div>

								<div class="col-lg-12 col-md-12 text-center">
									<div class="form-group {{ $errors->first('last_name', 'has-error') }}">
										<label>Last Name</label>
										<input id="last_name" type="text" value="{!! old('last_name') ? old('last_name') :  $user->last_name !!}" name="last_name" class="form-control" >
									</div>
									<span class="help-block">{{ $errors->first('last_name', ':message') }}</span>
								</div>

								<div class="col-lg-12 col-md-12 text-center">
									<div class="form-group {{ $errors->first('email', 'has-error') }}">
										<label>Email</label>
										<input id="email" type="email" value="{!! old('email') ? old('email') :  $user->email !!}" name="email" class="form-control" disabled>
									</div>
									<span class="help-block">{{ $errors->first('email', ':message') }}</span>

								</div>

								<div class="col-lg-12 col-md-12 text-center">
									<div class="form-group ">
										<label>Course Progress</label>
										<div class="progress">
										  <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
											60%
										  </div>
										</div>
									</div>
								</div>
							</div>

							<div class="col-lg-6 col-md-6 text-center">
								<input type="submit" class="btn btn-lg btn-primary" value="Save">
							</div>

						</div>
						<!-- // ends main row -->


	                </div>
				</form>
				<!-- // ends submit form -->

            </div>
        </div>
    </div>
</div>
@endsection
