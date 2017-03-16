@extends('layouts.user')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Home</div>
				<div class="panel-body">

					<!-- Notifications -->
			        @include('notifications')

					@if(!$lesson)

						<div class="well well-lg">Wow, aparently there are no lessons for today.</div>

					@else
						<h4>Today's lesson - <b>{{$lesson->title}}</b></h4>
						<hr>
						<blockquote class="blockquote-reverse">
						  <p>{{$lesson->description}}</p>
						  <footer> - The MOOC admin</footer>
						</blockquote>

						<!-- 16:9 aspect ratio -->
						<div class="embed-responsive embed-responsive-16by9">
						  <iframe class="embed-responsive-item" src="{{$lesson->content_url}}"></iframe>
						</div>

						<hr>

						<div class="form-group">
                            <div class="col-md-12 text-center">
								
							<!-- Test call to action-->
							@foreach($lesson->tests as $test)
								@if(! in_array($test->id, $takenTests))
									<a class="btn btn-small btn-info" href="{{ URL::to('lesson/' . $lesson->id . '/tests/' . $test->id ) }}">Start Test # {{$test->id}}</a>
								@endif
							@endforeach
							<!-- // Test call to action-->

							</div>
						</div>


					@endif
				</div>

            </div>
        </div>
    </div>
</div>
@endsection
