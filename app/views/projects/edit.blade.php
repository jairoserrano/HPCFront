<div class="modal-dialog">
<div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <h4 class="modal-title">Actilzar proyecto {{{ $project->name }}}</h4>
  </div>
  <div class="modal-body">
    {{ Form::open(array('route' => array('projects.update', $project->id), 'method' => 'PUT')) }}
        {{ Field::text('name', $project->name) }}
        {{ Field::textarea('description', $project->description) }}
        <div class="form-actions">
            {{ Form::submit('Actualizar', array('class' => 'btn btn-success')) }}
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
    {{ Form::close() }}
  </div>

</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->