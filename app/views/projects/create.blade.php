
<div class="modal-dialog">
<div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <h4 class="modal-title">Crear Proyecto</h4>
  </div>
  <div class="modal-body">
    {{ Form::open(array('route' => 'projects.store','method' => 'POST', 'role' =>'form', 'class' =>'form')) }}
        {{ Field::name('name') }}
        {{ Field::textarea('description') }}
        <div class="form-actions">
            {{ Form::submit('Crear', array('class' => 'btn btn-success')) }}
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
    {{ Form::close() }}
  </div>

</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->


