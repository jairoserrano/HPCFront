{{ Form::open(array('route' => array('projects.update', $project->id), 'method' => 'PUT')) }}
    {{ Form::text('name', $project->name) }}
    {{ $errors->first('name', '<p class="error_message">:message</p>') }}
    {{ Form::textarea('description', $project->description) }}
    {{ $errors->first('description', '<p class="error_message">:message</p>') }}
    {{ Form::submit('Enviar') }}
{{ Form::close() }}
