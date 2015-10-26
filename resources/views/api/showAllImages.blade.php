@section('title', 'All images.')

@section('content')
    <h1>Show image ID</h1>
    <div class="show_file">
    <table>
        <th>ID</th>
    @foreach($measurements as $measurement)
            <tr>
                <td><a href="upload/{{$measurement->id}}">{{$measurement->id}}</a></td>
            </tr>
    @endforeach
    </table>
    </div>
@show
