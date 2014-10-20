<div class="modal-dialog">
<div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <h4 class="modal-title">Crear Trabajo</h4>
  </div>
  <div class="modal-body">
    {{ Form::open(array('route' => array('project.jobs.store', $project_id),'method' => 'POST', 'role' =>'form', 'class' =>'form', 'files' => true)) }}
        {{ Field::name('name') }}
        {{ Field::select('type', $types) }}
        {{ Field::textarea('description', null, array('row' => '8')) }}
        <div class="fileinput fileinput-new input-group" data-provides="fileinput">
          <div class="form-control" data-trigger="fileinput"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
          <span class="input-group-addon btn btn-default btn-file"><span class="fileinput-new">Seleccione un archivo</span>
          <span class="fileinput-exists">Cambiar</span>{{ Form::file('executable') }}</span>
          <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Quitar</a>
        </div>

        {{ Form::hidden('project_id', $project_id) }}
        <div class="form-actions">
            {{ Form::submit('Crear', array('class' => 'btn btn-success')) }}
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
    {{ Form::close() }}
  </div>

</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->