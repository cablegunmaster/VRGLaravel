@section('title', 'File uploaded.')

@section('content')
    <h1>Show image</h1>
    <div class="show_file">
        <img src="/upload/{{$image}}" />
    </div>
@show
