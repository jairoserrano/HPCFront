@extends('layouts.master')
@section('styles')
    {{ HTML::style(asset("assets/jasny-bootstrap/dist/css/jasny-bootstrap.min.css")) }}
    {{ HTML::style(asset("assets/bootstrap-select/dist/css/bootstrap-select.min.css")) }}
@stop
@section('content')
    <section class="row">
        <div class="inner col-md-12">
            <ol class="breadcrumb">
              <li><a href="{{{ route('projects.index') }}}">Todos los proyectos</a></li>
              <li><a href="{{{ route('project.jobs.show', array($job->project->id, $job->id)) }}}">{{{ $job->project->name }}}</a></li>
            </ol>
        </div>
    </section>
    <section class="jumbotron">
      <h1>{{ $job->name }} <small>{{ $job->type }}</small></h1>
      <p>{{ $job->description }}</p>
    </section>
    <section class="row">
        <div class="inner col-md-12">
        <div class="page-header row">
            <div class="buttons">
                <button id="run-job" class="pull-right btn btn-success" data-url="{{ route('run_job', array('id' => $job->id)) }}"><i class="glyphicon glyphicon-play"></i> Correr trabajo</button>
                <button id="edit-job" class="pull-right btn btn-primary" data-url="{{ route('project.jobs.edit', array($project_id, $job->id)) }}" style="margin-right: 8px;"><i class="glyphicon glyphicon-edit"></i> Editar información del trabajo</button>

            </div>
        </div>
        </div>
    </section>
    <section class="content-list row">
        <section class="col-md-4 entries">
            <button id="create-entry" class="btn btn-default btn-sm" data-url="{{ route('project.job.entries.create', array($project_id, $job->id)) }}" style="float: right;margin-top: 4px;"><i class="glyphicon glyphicon-plus"></i> Crear Entrada</button>
            <h2 class="page-header">Entradas</h2>

            <section class="entrie-list">
                @foreach($job->entries as $entry)
                    <div class="bs-callout bs-callout-primary" style>
                        <h3>{{ $entry->name }}<br><small>{{ $entry->file_name }} - {{ $entry->file_size }}MB</small></h3>
                        <p style="float: left;">
                        <a href="{{route('get_entry',array($entry->id))}}" class="btn btn-primary btn-sm" style="margin-right:6px;"><i class="glyphicon glyphicon-save"></i> Descargar entrada</a>
                        <button id="create-entry" class="btn btn-success btn-sm edit-entry" data-url="{{ route('project.job.entries.edit', array($project_id, $job->id, $entry->id)) }}"><i class="glyphicon glyphicon-edit"></i> Editar entrada</button>

                        {{ Form::open(array('method' => 'DELETE','route' => array('project.job.entries.destroy',$project_id, $job->id, $entry->id), 'class' => 'form-horizontal', 'role' => 'form')) }}
                            <button type="submit" class="btn btn-danger btn-sm" style="margin-left:6px;"><i class="glyphicon glyphicon glyphicon-trash"></i> Eliminar Entrada</button>
                        {{ Form::close() }}
                        </p>
                    </div>
                @endforeach
            </section>
        </section>
        <section class="col-md-4 results">
            <h2 class="page-header">Archivos de salida</h2>
            @if(array_key_exists('results', $files))
                @foreach($files['results'] as $files)
                    <article class="bs-callout bs-callout-success">
                        <h4><a href="{{{ route('download_result',array('result'=>$file['to_download'])) }}}">{{{ $file['name'] }}}</a> <small>{{{ $file['size'] }}} MB - {{{ $file['created_date'] }}}</small></h4>
                    </article>
                @endforeach
            @endif
        </section>
        <section class="col-md-4 logs">
            <h2 class="page-header">Logs de salida</h2>
            @if(array_key_exists('logs', $files))
                @foreach($files['logs'] as $file)
                    <article class="bs-callout bs-callout-success">
                        <h4><a href="{{{ route('download_result',array('result'=>$file['to_download'])) }}}">{{{ $file['name'] }}}</a> <small>{{{ $file['size'] }}} MB - {{{ $file['created_date'] }}}</small></h4>
                    </article>
                @endforeach
            @endif
        </section>
    </section>
    <section class="output row">
        <secttion id="show-output" class="col-md-12">
        </secttion>
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
                UIModal.showCreateModal('#create-entry');
                UIModal.showCreateModal('#edit-job');
                UIModal.showCreateModal('#run-job');
                UIModal.showEditModal('button.edit-entry','section.entries');

                $('#modal').on('shown.bs.modal', function () {
                    var $modal = $(this);
                    var $form = $modal.find('form');
                    UIForm.init('#modal form');

                    if($form.hasClass('edit-job')){
                        UIForm.validate(JobFields.rules, JobFields.messages);
                    }

                    if($form.hasClass('create-entry')){
                        UIForm.validate(CreateEntryFields.rules, CreateEntryFields.messages);
                    }

                    if($form.hasClass('edit-entry')){
                        UIForm.validate(CreateEntryFields.rules, CreateEntryFields.messages);
                    }

                    if($form.hasClass('run-job')){
                        var $select = $form.find('select[name="entry_id"]');

                        $form.find(':input[name="no_entry"]').on('change', function(e) {

                            if(this.checked){
                                $select.prop('disabled', true);
                                $select.selectpicker('refresh');
                            }else{
                                $select.prop('disabled', false);
                                $select.selectpicker('refresh');
                            }
                        });

                        $form.find(':input[type="submit"].submit').on('click', function(e){
                            e.preventDefault();
                            console.log('enviando');
                            $.ajax({
                                type : $form.prop('method'),
                                url : $form.prop('action'),
                                data : $form.serialize()
                            }).done(
                                function(data){
                                    console.log(data);
                                    $('#modal').modal('hide');
                                    setInterval(function() {
                                        $.get(location.origin + '/jobs/'+data.log+'/show', function(data){
                                            $('<p>'+data+'</p>').appendTo('#show-output');
                                        });
                                    }, 1000);
                                }
                            );
                        });

                    }

                });
            });
        }(jQuery, window));
    </script>
@stop
