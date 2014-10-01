@extends('layouts.master')
@section('styles')
    {{ HTML::style(asset("assets/jasny-bootstrap/dist/css/jasny-bootstrap.min.css")) }}
@stop
@section('content')
<section class="row jumbotron">
  <h1>{{ $job->name }} <small>{{ $job->type }}</small></h1>
  <p>{{ $job->description }}</p>
</section>
<section class="row page-header">
    <button id="run-job" class="btn btn-success" data-url="{{ route('run_job', array('id' => $job->id)) }}" style="float: right;">Correr trabajo</button>
    <button id="edit-job" class="btn btn-primary" data-url="{{ route('jobs.edit', array('id' => $job->id)) }}" style="float: right; margin-right: 8px;">Editar información del trabajo</button>
</section>
<section class="content row">
    <section class="col-md-6 entries">
    <button id="create-entry" class="btn btn-default btn-sm" data-url="{{ route('new_entry', array('id' => $job->id)) }}" style="float: right;margin-top: 4px;">Crear Entrada</button>
    <h2 class="page-header">Entradas</h2>

    @foreach($job->entries as $entry)
        <div class="bs-callout bs-callout-primary">
            <h4>{{ $entry->name }}</h4>
            <p style="float: left;">
                {{ link_to_action('EntriesController@getFile', 'Descargar Archivo', array('id' => $entry->id), array('class' => 'btn btn-primary btn-sm', 'style' => 'margin-right:6px;')) }}
                <button id="create-entry" class="btn btn-success btn-sm edit-entry" data-url="{{ route('entries.edit', array('id' => $entry->id)) }}">Editar Entrada</button>

                {{ Form::open(array('method' => 'DELETE','route' => array('entries.destroy', $entry->id), 'class' => 'form-horizontal', 'role' => 'form')) }}
                    {{ Form::hidden('job_id', $job->id) }}

                    <button type="submit" class="btn btn-danger btn-sm">Eliminar Entrada</button>
                {{ Form::close() }}
            </p>
        </div>
    @endforeach
    </section>
    <section class="col-md-6 results">
        <h2 class="page-header">Archivos de salida</h2>

        @foreach($results as $result)
            <article class="bs-callout bs-callout-success">
                {{ $result->name }}
                {{ Form::open(array('method' => 'DELETE','route' => array('results.destroy', $result->id), 'class' => 'form-horizontal', 'role' => 'form')) }}
                   {{ Form::hidden('job_id', $job->id) }}

                    <button type="submit" class="btn btn-danger">Eliminar Resultados</button>
                {{ Form::close() }}
            </article>
        @endforeach
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
                UIModal.showCreateModal('#create-entry');
                UIModal.showCreateModal('#edit-job');
                UIModal.showCreateModal('#run-job');
                UIModal.showEditModal('button.edit-entry','section.entries');
                $('#modal').on('shown.bs.modal', function () {
                    UIForm.init('#modal form');
                });
            });
        }(jQuery, window));
    </script>
@stop