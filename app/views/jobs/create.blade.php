<div class="modal-dialog">
<div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <h4 class="modal-title">Crear Trabajo</h4>
  </div>
  <div class="modal-body">
    {{ Form::open(array('route' => array('project.jobs.store', $project_id),'method' => 'POST', 'role' =>'form', 'class' =>'form create-job', 'files' => true)) }}
        {{ Field::text('name') }}
        {{ Field::textarea('description', null, array('row' => '8')) }}
        {{ Field::select('executable_id', $executables) }}
        {{ Form::hidden('project_id', $project_id) }}
        <div class="form-actions">
            {{ Form::submit('Crear', array('class' => 'btn btn-success')) }}
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
    {{ Form::close() }}
  </div>

</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->