	<ul class="collapsible popout" data-collapsible="expandable">
		@foreach( $tasks as $task)
		<li>
			<div class="collapsible-header waves-effect truncate"> 
				@if($task->task_type_id == 0)
					<i class="material-icons">message</i>
				@elseif($task->task_type_id == 2)
					<i class="material-icons">cloud</i>
				@endif
				{{ $task->title }}
			</div>
			<div class="collapsible-body white black-text">
				<p>{{ $task->description}} </p>
			</div>	
		</li>
		@endforeach
	</ul>