<div class="modal-dialog">
<div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <h4 class="modal-title">Crear Entrada</h4>
  </div>
  <div class="modal-body">
{{ Form::open(array('route' => array('exec_job', $job->id),'method' => 'POST', 'class' => 'form run-job', 'role' => 'form')) }}
    <div class="checkbox">
        <label for="no_entry">
            {{ Form::checkbox('no_entry') }} Sin entradas
        </label>
    </div>
    {{ Field::select('entry_id', $entries) }}
    {{ Form::submit('Correr Trabajo', array('class' => 'btn btn-success submit')) }}
{{ Form::close() }}
  </div>

</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->