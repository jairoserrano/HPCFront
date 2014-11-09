@extends('layouts.master')

@section('page_title')
Lista de proyectos
@stop
@section('styles')
    {{ HTML::style(asset("assets/jasny-bootstrap/dist/css/jasny-bootstrap.min.css")) }}
    {{ HTML::style(asset("assets/bootstrap-select/dist/css/bootstrap-select.min.css")) }}
@stop
@section('content')

    <section class="row">
        <div class="inner col-md-12">
            <ol class="breadcrumb">
              <li><a href="{{{ route('projects.index') }}}">Todos los proyectos</a></li>
            </ol>
        </div>
    </section>

    <section class="jumbotron">
        <div class="container">
            <h1>{{{ $project->name }}}</h1>
            <p>{{{ $project->description }}}</p>
        </div>
    </section>

    <section class="row">
        <div class="inner col-md-12">
            <button id="create-job" class="btn btn-default" data-url="{{ route('project.jobs.create', array('id' => $project->id)) }}" style="float: right;margin-top: 8px;"><i class="glyphicon glyphicon-plus"></i> Crear trabajo</button>
            <h1 class="page-header">Trabajos</h1>
        </div>
    </section>

<section class="content col-md-12">
    <div class="inner row">
        @foreach($project->jobs as $job)
        <article class="bs-callout bs-callout-info job" style="margin: 20px 0px;">
        <h2>{{ $job->name }} <small>{{ $job->type }}</small></h2>
        <p>{{ $job->description }}</p>
        <p style="text-align: right;">
            <button class="btn btn-danger delete-job" data-url="{{{ route('project.jobs.destroy', array($project->id, $job->id)) }}}" data-method="DELETE"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>
            <button class="btn btn-success edit-job" data-url="{{{ route('project.jobs.edit', array($project->id, $job->id)) }}}"><i class="glyphicon glyphicon-edit"></i> Editar</button>
            <button class="btn btn-info view-job" data-url="{{ route('project.jobs.show', array($project->id, $job->id)) }}"><i class="glyphicon glyphicon-eye-open"></i> Ver</button>
        </p>
        </article>
        @endforeach
    </div>
</section>
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

                UIModal.init('#modal');
                UIModal.showCreateModal('#create-job');
                UIModal.showEditModal('button.edit-job', 'section.content');

                $('#modal').on('shown.bs.modal', function (e) {
                    UIForm.init('#modal form');
                    UIForm.validate(JobFields.rules, JobFields.messages);

                });

                $('section.content').on('click', 'button.view-job', function(){
                    window.location.href = $(this).data('url');
                });

                $('section.content').on('click', 'button.delete-job', function(){
                    $.ajax({
                        url: $(this).data('url'),
                        method: $(this).data('method')
                    })
                    .done(function(data) {
                        if(Boolean(data) === true){
                            location.reload(true);
                        }
                    });
                });
            });
        }(jQuery, window));
    </script>
@stop