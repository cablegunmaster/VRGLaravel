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
				<p>{{ $task->description}}
				    <div id="container" style="margin-left: 35px">
				    Benodigdheden:
				        <div id="bravoData" style="margin-left: 10px; margin-top: -20px;">
                            <br/>
                        	<?php $data = json_decode($task->data); ?>
                            Bravos: {{$data->buisnummer}}
                        </div>
                        <div id="items"  style="margin-left: 10px;">
                            @foreach($data->items as $item)
                                {{ $item }}
                            @endforeach
            	        </div>
				    </div>
                </p>
			</div>	
		</li>
		@endforeach
	</ul>