{{ Form::open(array('route' => 'entries.store','method' => 'POST', 'files' => true)) }}
    {{ Form::text('name') }}
    {{ $errors->first('name', '<p class="error_message">:message</p>') }}
    {{ Form::file('path') }}
    {{ $errors->first('path', '<p class="error_message">:message</p>') }}
    {{ Form::hidden('job_id', $job->id) }}
    {{ Form::hidden('job_type', $job->type) }}
    {{ Form::hidden('project_id', $job->project->id) }}
    {{ Form::submit('Agregar entrada') }}
{{ Form::close() }}