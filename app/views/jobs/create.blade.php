{{ Form::open(array('route' => 'jobs.store','method' => 'POST')) }}
    {{ Form::text('name') }}
    {{ $errors->first('name', '<p class="error_message">:message</p>') }}
    {{ Form::textarea('description') }}
    {{ $errors->first('description', '<p class="error_message">:message</p>') }}
    {{ Form::select('type', $types) }}
    {{ $errors->first('type', '<p class="error_message">:message</p>') }}
    {{ Form::submit('Crear Trabajo') }}
    {{ Form::hidden('project_id', $project_id) }}
{{ Form::close() }}