@extends('layouts.user')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Grades</div>
				<div class="panel-body">

					<!-- Notifications -->
			        @include('notifications')


						<table class="table">
							<thead>
								<tr>
									<th>Test #</th>
									<th>Title</th>
									<th class="hidden-xs">Linked lesson</th>
									<th>Score</th>
								</tr>
							</thead>

							<tbody>
							@foreach($tests as $test)
								<tr>
									<td> {{ $test->id }} </td>
									<td> {{ $test->title }} </td>
									<td class="hidden-xs"> {{ $test->lesson->id }} . {{ $test->lesson->title }} </td>
									<td> {{ $test->pivot->score }} </td>
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

<script>
	// the selector will match all input controls of type :checkbox
	// and attach a click event handler
	$("input:checkbox").on('click', function() {
	  // in the handler, 'this' refers to the box clicked on
	  var $box = $(this);
	  if ($box.is(":checked")) {
	    // the name of the box is retrieved using the .attr() method
	    // as it is assumed and expected to be immutable
	    var group = "input:checkbox[name='" + $box.attr("name") + "']";
	    // the checked state of the group/box on the other hand will change
	    // and the current value is retrieved using .prop() method
	    $(group).prop("checked", false);
	    $box.prop("checked", true);
	  } else {
	    $box.prop("checked", false);
	  }
	});
</script>
@endsection
