{{ Form::open(array('route' => 'projects.store','method' => 'POST')) }}
    {{ Form::text('name') }}
    {{ $errors->first('name', '<p class="error_message">:message</p>') }}
    {{ Form::textarea('description') }}
    {{ $errors->first('description', '<p class="error_message">:message</p>') }}
    {{ Form::submit('Crear') }}
{{ Form::close() }}
