@extends('layouts.master')
@section('title')
Usuarios de la plataforma
@stop

@section('content_title')
Usuarios de la plataforma
@stop

@section('content')
{{-- dd($users)  --}}
<table class="table table-bordered">
<thead>
<tr>
<th>Nombre</th>
<th>email</th>
</tr>
</thead>
<tbody>
@foreach($users as $user)
<tr>
    <td>{{ $user->name  }}</td>
    <td>{{ $user->email  }}</td>
</tr>
@endforeach
</tbody>
</table>
@stop