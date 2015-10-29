@foreach( $tasks as $task)
	<div class="card-panel">
		<h5>{{ $task->title }}</h5>
		<p>{{ $task->description}} </p>
	</div>
@endforeach