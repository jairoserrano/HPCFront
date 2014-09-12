@extends('layouts.master')
@section('page_title')
Usuarios de la plataforma
@stop

@section('content')
{{-- dd($users)  --}}
<table class="table-bordered">
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