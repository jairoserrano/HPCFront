{{ Form::open(array('route' => 'results.store','method' => 'POST')) }}
    {{ Form::select('job_to_run', $jobs) }}
    {{ $errors->first('job_to_run', '<p class="error_message">:message</p>') }}
    {{ Form::hidden('job_id', $job->id) }}
    {{ Form::hidden('job_type', $job->type) }}
    {{ Form::hidden('project_id', $job->project->id) }}
    {{ Form::submit('Agregar entrada') }}
{{ Form::close() }}