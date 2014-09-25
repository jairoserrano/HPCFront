<h1>{{{ $project->name }}}</h1>
{{ link_to_route('projects.index', 'Ver todos los proyectos') }}
{{ link_to_route('new_job', 'Crear Trabajo', array('id' => $project->id)) }}
<p>{{{ $project->description }}}</p>
<ul>
@foreach($project->jobs as $job)
<li>
{{ $job->name }} -- {{ $job->type }}
{{ link_to_route('run_job', 'Correr Trabajo', array('id' => $job->id)) }}
</li>
<h2>Archivos de entrada</h2>
{{ link_to_route('new_entry', 'Agregar Entrada', array('id' => $job->id)) }}
<ul>
@foreach($job->entries as $entry)
    <li>
    {{ $entry->name }} -- {{ link_to_action('EntriesController@getFile', 'Descargar Archivo', array('id' => $entry->id)) }}
    {{ link_to_route('entries.edit', 'Editar entrada', array('id' => $entry->id)) }}

    {{ Form::open(array('method' => 'DELETE','route' => array('entries.destroy', $entry->id), 'class' => 'form-horizontal', 'role' => 'form')) }}
        {{ Form::hidden('project_id', $project->id) }}
        <button type="submit" class="btn btn-danger">Eliminar Entrada</button>
    {{ Form::close() }}
    </li>
@endforeach
</ul>
<h2>Archivos de salida</h2>
<ul>
@foreach($job->results as $result)
    <li>
        {{ $result->name }}
        {{ Form::open(array('method' => 'DELETE','route' => array('results.destroy', $result->id), 'class' => 'form-horizontal', 'role' => 'form')) }}
                    {{ Form::hidden('project_id', $project->id) }}

            <button type="submit" class="btn btn-danger">Eliminar Resultados</button>
        {{ Form::close() }}
    </li>
@endforeach
</ul>
@endforeach
</ul>
