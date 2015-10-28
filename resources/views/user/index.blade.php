<table>
    <tr>
        <th>id</th>
        <th>team</th>
        <th>gebruiker</th>
        <th>email</th>
    </tr>
    @foreach( $users as $user)
    <tr>

        <td>{{ $user->id }}</td>
        <td>{{ $user->team_id }}</td>
        <td>{!! link_to('user/' . $user->id, $title = $user->name, $attributes = array('class' => 'link', ), $secure = null) !!}</td>
        <td>{{ $user->email }}</td>
    </tr>
    @endforeach
</table>