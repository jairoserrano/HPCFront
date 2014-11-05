<div class="modal-dialog">
<div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <h4 class="modal-title">Editar Ejecutable</h4>
  </div>
  <div class="modal-body">
    {{ Form::open(array('route' => array('executables.update', $executable->id),'method' => 'PUT', 'role' =>'form', 'class' =>'form edit-executable', 'files' => true)) }}
        {{ Field::name('name', $executable->name) }}
        {{ Field::select('type', $types, $executable->type) }}
        <div class="form-group">
            {{ Form::label('path', 'Ejecutable') }}
            <div class="fileinput fileinput-new input-group" data-provides="fileinput">
              <div class="form-control" data-trigger="fileinput"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
              <span class="input-group-addon btn btn-default btn-file"><span class="fileinput-new">Seleccione un archivo</span>
              <span class="fileinput-exists">Cambiar</span>{{ Form::file('path') }}</span>
              <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Quitar</a>
            </div>
        </div>
        <div class="form-actions">
            {{ Form::submit('Actualizar', array('class' => 'btn btn-success')) }}
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
    {{ Form::close() }}
  </div>

</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->