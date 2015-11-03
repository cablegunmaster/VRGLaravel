@if($task->task_type_id == 2)
	MeetOpdracht:
@elseif($task->task_type_id == 3)
	RijOpdracht:
@endif
{{ $task->title }}
{{ $task->description}}