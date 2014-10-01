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
        <article class="bs-callout bs-callout-info col-md-12">
        <h2>{{ $job->name }} <small>{{ $job->type }}</small></h2>
        <p>{{ $job->description }}</p>
        <p style="text-align: right;">
        <a class="btn btn-link" href="{{ route('jobs.show', array('id' => $job->id)) }}"><i class="glyphicon glyphicon-eye-open"></i> Ver</a>
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

                $('#modal').on('shown.bs.modal', function (e) {
                    UIForm.init('#modal form');
                    UIForm.validate(CreateProjectFields.rules, CreateProjectFields.messages)
                });
            });
        }(jQuery, window));
    </script>
@stop