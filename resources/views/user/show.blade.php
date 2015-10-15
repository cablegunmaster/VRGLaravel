<p>
Mijn naam: {{ $user->name }}
</p>
{!! link_to('user/' . $user->id .'/delete/', $title = $user->name, $attributes = array('class' => 'link', "data-method" => "delete" ), $secure = null) !!}
