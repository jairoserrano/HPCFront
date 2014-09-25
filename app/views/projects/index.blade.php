{{ link_to_route('projects.create', 'Vamos a crear un proyecto') }}
<br>
<ul>
@foreach($projects as $project)
<li>
<h2>{{{ $project->name }}}</h2>
<p>{{{ $project->description }}}</p>
{{ link_to_route('projects.show', 'Ver detalles', $project->id) }}
{{ link_to_route('projects.edit', 'Editar', $project->id) }}
{{ Form::open(array('route' => array('projects.destroy', $project->id), 'method' => 'DELETE')) }}
    {{Form::submit('Eliminar')}}
{{ Form::close() }}
</li>
@endforeach
</ul>