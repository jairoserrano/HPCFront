@extends('layouts.master')
@section('page_title')
Lista de ejecutables
@stop
@section('styles')
    {{ HTML::style(asset("assets/jasny-bootstrap/dist/css/jasny-bootstrap.min.css")) }}
    {{ HTML::style(asset("assets/bootstrap-select/dist/css/bootstrap-select.min.css")) }}
@stop
@section('content')
<section class="page-header row">
    <div class="buttons pull-right">
        <button id="create-executable" data-url="{{ route('executables.create') }}" class="btn btn-primary"><i class="glyphicon glyphicon-plus-sign"></i> Añadir ejecutable</button>
    </div>
</section>
<section class="row content">
<div class="inner col-md-12">
    @if(Session::has('success'))
    <div class="alert alert-success alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <strong>Felicidaes!!</strong> has añadido un nuevo ejecutable con éxito
    </div>
    @endif
    @if(Session::has('updated'))
    <div class="alert alert-success alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <strong>Felicidaes!!</strong> has actualizado con éxito el ejecutable {{{ Session::get('updated') }}}
    </div>
    @endif
    <section class="row executables">
        @foreach($executables as $executable)
            <article class="bs-callout bs-callout-info executable-information">
            <h3 class="text-info">{{{ $executable->name }}}</h3>
            <p>{{{ $executable->description }}}</p>
            <p class="text-muted">{{{ $executable->file_name }}} - {{{ $executable->file_size }}} Mb</p>
            <div class="">
                <button class="btn btn-danger btn-sm delete-executable" data-url="{{{ route('executables.destroy', array($executable->id)) }}}" data-method="DELETE"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>
                <button class="btn btn-success btn-sm edit-executable" data-url="{{{ route('executables.edit', array($executable->id)) }}}" data-toggle="tooltip" data-placement="top" title="Editar ejecutable"><i class="glyphicon glyphicon-edit"></i> Editar</button>
                <a href="{{ route('download_executable', array($executable->id)) }}" class="btn btn-primary btn-sm download-executable"><i class="glyphicon glyphicon-save"></i> Descargar</a>
            </div>
            </article>
        @endforeach
    </section>
</div>
</section>
<div id="modal" class="modal fade"></div>
@stop
@section('scripts')
    {{ HTML::script(asset("assets/jasny-bootstrap/dist/js/jasny-bootstrap.min.js")) }}
    {{ HTML::script(asset("assets/bootstrap-select/dist/js/bootstrap-select.min.js")) }}
    {{ HTML::script(asset("assets/jquery.validation/dist/jquery.validate.min.js")) }}
    {{ HTML::script(asset("assets/jquery.validation/dist/additional-methods.min.js")) }}
    {{ HTML::script(asset("js/ui.modal.js")) }}
    {{ HTML::script(asset("js/ui.form.js")) }}
    {{ HTML::script(asset("js/form.components.js")) }}
    <script>
        (function($, window){
            $('document').ready(function(){

                $.validator.addMethod("valueNotEquals", function(value, element, arg){
                    return arg != value;
                }, "Debe escojer una opción.");
                UIModal.init('#modal');
                UIModal.showCreateModal('#create-executable');
                UIModal.showEditModal('button.edit-executable','section.executables');


                $('#modal').on('shown.bs.modal', function (e) {
                    var $modal = $(this);
                    UIForm.init('#modal form');
                    if($modal.find('form').hasClass('create-executable')){
                        UIForm.validate(CreateExecutableFields.rules, CreateExecutableFields.messages);
                    }
                    if($modal.find('form').hasClass('edit-executable')){
                        UIForm.validate(EditExecutableFields.rules, EditExecutableFields.messages);
                    }
                });


                $('section.executables').on('click', 'button.delete-executable', function(){
                    $.ajax({
                        url: $(this).data('url'),
                        method: $(this).data('method')
                    })
                    .done(function(data) {
                        if(Boolean(data) === true){
                            document.location.reload(true);
                        }
                    });
                });
            });
        }(jQuery, window));
    </script>
@stop