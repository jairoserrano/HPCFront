<div class="modal-dialog">
<div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <h4 class="modal-title">Actualizar información del rabajo</h4>
  </div>
  <div class="modal-body">
    {{ Form::open(array('route' => array('project.jobs.update', $project_id, $job->id),'method' => 'PUT', 'role' =>'form', 'class' =>'form edit-job', 'files' => true)) }}
        {{ Field::name('name', $job->name) }}
        {{ Field::textarea('description', $job->description, array('rows' => 4)) }}
        {{ Field::select('executable_id', $executables, $job->executable_id) }}
        {{ Form::hidden('project_id', $project_id) }}
        <div class="form-actions">
            {{ Form::submit('Actualizar', array('class' => 'btn btn-success')) }}
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>

    {{ Form::close() }}
  </div>

</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->