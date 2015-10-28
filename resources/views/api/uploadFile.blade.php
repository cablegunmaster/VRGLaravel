@section('title', 'Upload a file to the API.')

@section('content')
    <h1>Upload a file</h1>
    <div class="upload_file">
        {!! Form::open(['files' => true]) !!}
        {!! Form::hidden('user_id', '1') !!}
        {!! Form::file('file') !!}
        <div class="form-group primary_create">
            {!! Form::submit('Upload file', ['class' => 'btn btn-primary'] , array('files'=> true)) !!}
        </div>
        {!! Form::close() !!}
    </div>
@show
