@extends('layouts.master')
@section('styles')
    {{ HTML::style(asset("assets/jasny-bootstrap/dist/css/jasny-bootstrap.min.css")) }}
@stop
@section('content')
<section class="row jumbotron">
  <h1>{{{ $project->name }}}</h1>
  <p>{{{ $project->description }}}</p>
</section>
<button id="create-job" class="btn btn-default" data-url="{{ route('new_job', array('id' => $project->id)) }}" style="float: right;margin-top: 8px;">Crear trabajo</button>
<h1 class="page-header">Trabajos</h1>

<section class="content col-md-12">
    <div class="inner row">
        @foreach($project->jobs as $job)
        <article class="bs-callout bs-callout-info col-md-12 job">
        <h2>{{ $job->name }} <small>{{ $job->type }}</small></h2>
        <p>{{ $job->description }}</p>
        <p style="text-align: right;">
            <button class="btn btn-danger delete-job" data-url="{{{ route('jobs.destroy', array($job->id)) }}}" data-method="DELETE"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>
            <button class="btn btn-success edit-job" data-url="{{{ route('jobs.edit', array($job->id)) }}}"><i class="glyphicon glyphicon-edit"></i> Editar</button>
            <button class="btn btn-info view-job" data-url="{{ route('jobs.show', array('id' => $job->id)) }}"><i class="glyphicon glyphicon-eye-open"></i> Ver</button>
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
                    UIForm.validate(EditJobFields.rules, EditJobFields.messages)
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
                        if(data === true){
                            document.location.reload(true);
                        }
                    });
                });
            });
        }(jQuery, window));
    </script>
@stop