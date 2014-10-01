@extends('layouts.master')

@section('content')
<section class="page-header row">
    <div class="buttons pull-right">
        <button id="create-project" data-url="{{ route('projects.create') }}" class="btn btn-primary"><i class="glyphicon glyphicon-plus-sign"></i> Crear Proyecto</button>
    </div>
</section>
<section class="row">
    @foreach($projects as $project)
        <article class="bs-callout bs-callout-info col-md-12">
        <h2 class="text-info">{{{ $project->name }}}</h2>
        <p>{{{ $project->description }}}</p>
        <p style="text-align: right;">
            <a href="{{ route('projects.show', $project->id) }}" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-eye-open"></i> Ver</a>
        </p>
        </article>
    @endforeach
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

                $('#modal').on('shown.bs.modal', function (e) {
                    UIForm.init('#modal form');
                    UIForm.validate(CreateProjectFields.rules, CreateProjectFields.messages)
                });
            });
        }(jQuery, window));
    </script>
@stop