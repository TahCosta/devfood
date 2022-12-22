@extends('adminlte::page')

@section('title', "Permissões disponíveis para o Perfil {$profile->name}")

@section('content_header')
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
		<li class="breadcrumb-item"><a href="{{ route('profiles.index') }}">Perfis</a></li>
		<li class="breadcrumb-item active"><a href="{{ route('profiles.permissions', $profile->id) }}" class="active">Permissões</a></li>
	</ol>
	<h1>Permissões disponíveis para o Perfil <strong>{{ $profile->name }}</strong></h1>
@stop

@section('content')
	<div class="card">
		<div class="card-header">
			<form action="{{ route('profiles.permissions.available', $profile->id) }}" method="POST" class="form form-inline float-right">
				@csrf
				<div class="form-group">
					<input type="text" name="filter" placeholder="Nome" class="form-control" value="{{ $filters['filter'] ?? '' }}">
					<button type="submit" class="btn btn-dark">Pesquisar</button>
				</div>
			</form>
		</div>
		<div class="card-body">
			@include('components.alerts')
			<table class="table table-condensed">
				<thead>
				<tr>
					<th width="50px"><input type="checkbox" id="checkAll"></th>
					<th>Nome</th>
					<th>Descrição</th>
				</tr>
				</thead>
				<tbody>

					<form action="{{ route('profiles.permissions.attach', $profile->id) }}" method="POST">
						@csrf

						@foreach ($permissions as $permission)
							<tr>
								<td>
									<input type="checkbox" name="permissions[]" value="{{ $permission->id }}">
								</td>
								<td>{{ $permission->name }}</td>
								<td>{{ $permission->description }}</td>
							</tr>
						@endforeach

						<tr>
							<td colspan="500">
								<button type="submit" class="btn btn-success">Vincular</button>
							</td>
						</tr>
					</form>
				</tbody>
			</table>

		</div>
		<div class="card-footer">
			@if (isset($filters))
				{!! $permissions->appends($filters)->links() !!}
			@else
				{!! $permissions->links() !!}
			@endif
		</div>
	</div>
@stop
