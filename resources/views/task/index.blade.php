<table>
	<tr>
		<th>id</th>
		<th>incident</th>
		<th>type</th>
		<th>title</th>
		<th>description</th>
		<th>data</th>
	</tr>
	@foreach( $tasks as $task)
	<tr>

		<td>{{ $task->id }}</td>
		<td>{{ $task->incident_id }}</td>
		<td>{{ $task->task_type_id }}</td>
		<td>{{ $task->title }}</td>
		<td>{{ $task->description }}</td>
		<td>{{ $task->data }}</td>
	</tr>
	@endforeach
</table>

<script type="text/javascript">
	$(window).setTimeout(function() {
		reload();
	}, 1000);
</script>