@extends('layouts.master')

@section('content')
<section class=" row">
    <div class="inner col-md-12">
        <div class="page-header">
            <h1>Projectos</h1>
            <button id="create-project" data-url="{{ route('projects.create') }}" class=" pull-right btn btn-primary header-button-h1"><i class="glyphicon glyphicon-plus-sign"></i> Crear Proyecto</button>
        </div>
    </div>
</section>
<section class="row content">
    <div class="header-notifications col-md-12">
        @if(Session::has('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <strong>Felicidaes!!</strong> has creado un nuevo <a href="{{{ Session::get('success') }}}" class="alert-link">proyecto</a> con éxito
        </div>
        @endif
        @if(Session::has('updated'))
        <div class="alert alert-success alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <strong>Felicidaes!!</strong> has actualizado con éxito el proyecto {{{ Session::get('updated') }}}
        </div>
        @endif
    </div>
    <div class="content col-md-12">
        @foreach($projects as $project)
            <article class="bs-callout bs-callout-info project-information">
            <h2 class="text-info">{{{ $project->name }}}</h2>
            <p>{{{ $project->description }}}</p>
            <p style="text-align: right;">
                <button class="btn btn-danger delete-project" data-url="{{{ route('projects.destroy', array($project->id)) }}}" data-method="DELETE"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>
                <button class="btn btn-success edit-project" data-url="{{{ route('projects.edit', array($project->id)) }}}"><i class="glyphicon glyphicon-edit"></i> Editar</button>
                <button class="btn btn-info view-project" data-url="{{ route('projects.show', array($project->id)) }}"><i class="glyphicon glyphicon-eye-open"></i> Ver</button>
            </p>
            </article>
        @endforeach
    </div>
</section>
<div id="modal" class="modal fade"></div>
@stop
@section('scripts')
    {{ HTML::script(asset("assets/jquery.validation/dist/jquery.validate.min.js")) }}
    {{ HTML::script(asset("assets/jquery.validation/dist/additional-methods.min.js")) }}
    {{ HTML::script(asset("js/ui.modal.js")) }}
    {{ HTML::script(asset("js/ui.form.js")) }}
    {{ HTML::script(asset("js/form.components.js")) }}
    <script>
        (function($, window){
            $('document').ready(function(){
                UIModal.init('#modal');
                UIModal.showCreateModal('#create-project');
                UIModal.showEditModal('button.edit-project','section.content');


                $('#modal').on('shown.bs.modal', function (e) {
                console.log('hola');
                    UIForm.init('#modal form');
                    UIForm.validate(ProjectFields.rules, ProjectFields.messages)
                });

                $('section.content').on('click', 'button.view-project', function(){
                    window.location.href = $(this).data('url');
                });

                $('section.content').on('click', 'button.delete-project', function(){
                    $.ajax({
                        url: $(this).data('url'),
                        method: $(this).data('method')
                    })
                    .done(function(data) {
                        if(data === true){
                            document.location.reload(true);
                        }
                    });
                });
            });
        }(jQuery, window));
    </script>
@stop